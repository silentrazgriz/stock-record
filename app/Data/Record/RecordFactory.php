<?php

declare(strict_types=1);


namespace App\Data\Record;

use App\Component\Value\DateParser;
use App\Component\Value\RecordType;
use App\Data\UserAccount\UserAccountRepository;

/**
 * Class RecordFactory
 * @package App\Data\Record
 */
final class RecordFactory
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * RecordFactory constructor.
     * @param UserAccountRepository $userAccountRepository
     */
    public function __construct(
        UserAccountRepository $userAccountRepository
    ) {
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * @param array $payload
     * @return Record
     */
    public function create(array $payload): Record
    {
        $record = new Record();
        $userAccount = $this->userAccountRepository->findById($payload['user_account_id']);
        $totalPrice = $payload['price'] * $payload['total_shares'];

        if (isset($payload['transaction_date'])) {
            $payload['transaction_date'] = DateParser::parse($payload['transaction_date']);
        }

        $record->user_account_id = $payload['user_account_id'];
        $record->quote_id = $payload['quote_id'];
        $record->price = $payload['price'];
        $record->total_shares = $payload['total_shares'];
        $record->broker_fee = $payload['type'] == RecordType::BUY ?
            $totalPrice * ($userAccount->brokerAccount->buy_commission / 100):
            $totalPrice * ($userAccount->brokerAccount->sell_commission / 100);
        $record->type = $payload['type'];
        $record->transaction_date = $payload['transaction_date'];

        return $record;
    }

    /**
     * @param Record $record
     * @param array $payload
     * @return Record
     */
    public function update(Record $record, array $payload): Record
    {
        $userAccount = $this->userAccountRepository->findById($payload['user_account_id'] ?? $record->user_account_id);
        $totalPrice = ($payload['price'] ?? $record->price) * ($payload['total_shares'] ?? $record->total_shares);

        if (isset($payload['transaction_date'])) {
            $payload['transaction_date'] = DateParser::parse($payload['transaction_date']);
        }

        $record->user_account_id = $payload['user_account_id'] ?? $record->user_account_id;
        $record->quote_id = $payload['quote_id'] ?? $record->quote_id;
        $record->price = $payload['price'] ?? $record->price;
        $record->total_shares = $payload['total_shares'] ?? $record->total_shares;
        $record->broker_fee = ($payload['type'] ?? $record->type) == RecordType::BUY ?
            $totalPrice * ($userAccount->brokerAccount->buy_commission / 100):
            $totalPrice * ($userAccount->brokerAccount->sell_commission / 100);
        $record->type = $payload['type'] ?? $record->type;
        $record->transaction_date = $payload['transaction_date'] ?? $record->transaction_date;

        return $record;
    }
}