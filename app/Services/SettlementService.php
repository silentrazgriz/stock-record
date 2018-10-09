<?php

declare(strict_types=1);

namespace App\Services;

use App\Component\Value\DateParser;
use App\Component\Value\RecordType;
use App\Component\Value\SettlementType;
use App\Data\Margin\MarginRepository;
use App\Data\Record\Record;
use App\Data\Settlement\SettlementRepository;
use App\Data\UserAccount\UserAccountRepository;
use Carbon\Carbon;

/**
 * Class CalculateSettlementService
 * @package App\Services
 */
final class SettlementService
{
    /**
     * @var SettlementRepository
     */
    private $settlementRepository;

    /**
     * @var MarginRepository
     */
    private $marginRepository;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * SettlementService constructor.
     * @param SettlementRepository $settlementRepository
     * @param MarginRepository $marginRepository
     * @param UserAccountRepository $userAccountRepository
     */
    public function __construct(
        SettlementRepository $settlementRepository,
        MarginRepository $marginRepository,
        UserAccountRepository $userAccountRepository
    ) {
        $this->settlementRepository = $settlementRepository;
        $this->marginRepository = $marginRepository;
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * @param $userAccountId
     */
    public function calculateBalance($userAccountId)
    {
        $settlements = $this->settlementRepository->find([
            ['settled_at', '<=', Carbon::now()->toDateTimeString()],
            'user_account_id' => $userAccountId
        ]);

        $balance = 0;
        foreach ($settlements as $settlement) {
            $balance += $settlement['net_amount'];
        }

        $this->userAccountRepository->update($userAccountId, [
            'balance'               => $balance,
            'balance_updated_at'    => Carbon::now()
        ]);
    }

    /**
     * @param array $payload
     * @param string $type
     */
    public function deposit(array $payload, string $type)
    {
        $this->settlementRepository->create([
            'user_account_id'   => $payload['user_account_id'],
            'buy_amount'        => 0,
            'sell_amount'       => 0,
            'net_amount'        => $payload['amount'] * ($type == SettlementType::WITHDRAW ? -1 : 1),
            'done_at'           => $payload['done_at'],
            'settled_at'        => $payload['done_at'],
            'settlement_type'   => $type
        ]);

        $this->calculateBalance($payload['user_account_id']);
    }

    /**
     * @param $id
     */
    public function cancelDeposit($id)
    {
        $userAccountId = $this->settlementRepository->findById($id)->user_account_id;
        $this->settlementRepository->destroy($id);

        $this->calculateBalance($userAccountId);
    }

    /**
     * @param Record $record
     */
    public function storeOrder(Record $record)
    {
        $settlements = $this->settlementRepository->findByTransactionDateAndUserAccount(
            $record->transaction_date,
            $record->user_account_id
        );

        $detail = $this->getAmountDetails($record);

        if ($settlements->count() == 0) {
            $this->settlementRepository->create([
                'user_account_id'   => $record->user_account_id,
                'buy_amount'        => $detail['buy_amount'],
                'sell_amount'       => $detail['sell_amount'],
                'net_amount'        => $detail['net_amount'],
                'done_at'           => $record->transaction_date,
                'settled_at'        => $this->getSettlementDate($record->transaction_date),
                'settlement_type'   => SettlementType::ORDER
            ]);
        } else {
            $settlement = $settlements[0];
            $this->settlementRepository->update($settlement->id, [
                'buy_amount'    => $settlement->buy_amount + $detail['buy_amount'],
                'sell_amount'   => $settlement->sell_amount + $detail['sell_amount'],
                'net_amount'    => $settlement->net_amount + $detail['net_amount']
            ]);
        }

        $this->calculateBalance($record->user_account_id);
    }

    /**
     * @param Record $record
     */
    public function cancelOrder(Record $record)
    {
        $settlements = $this->settlementRepository->findByTransactionDateAndUserAccount(
            $record->transaction_date,
            $record->user_account_id
        );

        $detail = $this->getAmountDetails($record);

        if ($settlements->count() == 0) {
            return;
        } else {
            $settlement = $settlements[0];
            $this->settlementRepository->update($settlement->id, [
                'buy_amount'    => $settlement->buy_amount - $detail['buy_amount'],
                'sell_amount'   => $settlement->sell_amount - $detail['sell_amount'],
                'net_amount'    => $settlement->net_amount - $detail['net_amount']
            ]);
        }

        $this->calculateBalance($record->user_account_id);
    }

    /**
     * @param string $currentDate
     * @return string
     */
    public function getSettlementDate(string $currentDate)
    {
        $settlementDate = Carbon::parse($currentDate);
        $i = 0;
        while ($i < 3) {
            $settlementDate->addDay();
            if ($settlementDate->isWeekday()) {
                $i++;
            }
        }

        return DateParser::parse($settlementDate->toDateTimeString());
    }

    /**
     * @param string $startDate
     * @return array
     */
    public function getRecentSettlementDates(string $startDate): array
    {
        $result = [];
        $date = Carbon::parse($startDate)
            ->setTime(0, 0, 0);

        $i = 0;
        while ($i < 4) {
            if ($date->isWeekday()) {
                $result[$date->toDateString()] = [
                    'income' => 0,
                    'outcome' => 0,
                    'margin' => 0,
                    'net' => 0,
                    'total' => 0
                ];
                $i++;
            }
            $date->addDay();
        }

        return $result;
    }

    /**
     * @param Record $record
     * @return array
     */
    private function getAmountDetails(Record $record)
    {
        $result = [
            'buy_amount' => 0,
            'sell_amount' => 0,
            'net_amount' => 0
        ];

        if ($record->type == RecordType::BUY) {
            $result['buy_amount'] = ceil(($record->price * $record->total_shares) + $record->broker_fee);
        } else {
            $result['sell_amount'] = ceil(($record->price * $record->total_shares) - $record->broker_fee);
        }

        $result['net_amount'] = $result['sell_amount'] - $result['buy_amount'];

        return $result;
    }
}