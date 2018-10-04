<?php

declare(strict_types=1);

namespace App\Services;

use App\Component\Value\RecordType;
use App\Component\Value\SettlementType;
use App\Data\Record\Record;
use App\Data\Settlement\SettlementRepository;
use Carbon\Carbon;

/**
 * Class CalculateSettlementService
 * @package App\Services
 */
final class CalculateSettlementService
{
    /**
     * @var SettlementRepository
     */
    private $settlementRepository;

    /**
     * CalculateSettlementService constructor.
     * @param SettlementRepository $settlementRepository
     */
    public function __construct(
        SettlementRepository $settlementRepository
    ) {
        $this->settlementRepository = $settlementRepository;
    }

    /**
     * @param Record $record
     */
    public function store(Record $record)
    {
        $settlements = $this->settlementRepository->findToday();

        $detail = $this->getAmountDetails($record);

        if ($settlements->count() == 0) {
            $this->settlementRepository->create([
                'user_account_id'   => $record->user_account_id,
                'buy_amount'        => $detail['buy_amount'],
                'sell_amount'       => $detail['sell_amount'],
                'net_amount'        => $detail['net_amount'],
                'transaction_at'    => Carbon::now()->toDateString(),
                'settled_at'        => $this->getSettlementDate(),
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
    }

    /**
     * @param Record $record
     */
    public function destroy(Record $record)
    {
        $settlements = $this->settlementRepository->findToday();

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
    }

    /**
     * @return string
     */
    private function getSettlementDate()
    {
        $settlementDate = Carbon::now();
        $i = 0;
        while ($i < 3) {
            $settlementDate->addDay();
            if (!$settlementDate->isWeekend()) {
                $i++;
            }
        }

        return $settlementDate->toDateString();
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
            $result['buy_amount'] = ($record->price * $record->total_shares) + $record->broker_fee;
        } else {
            $result['sell_amount'] = ($record->price * $record->total_shares) - $record->broker_fee;
        }

        $result['net_amount'] = $result['sell_amount'] - $result['buy_amount'];

        return $result;
    }
}