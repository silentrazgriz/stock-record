<?php

declare(strict_types=1);


namespace App\Data\Settlement;

final class SettlementFactory
{
    /**
     * @param array $payload
     * @return Settlement
     */
    public function create(array $payload): Settlement
    {
        $realization = new Settlement();

        $realization->user_account_id = $payload['user_account_id'];
        $realization->amount = $payload['amount'];
        $realization->transaction_at = $payload['transaction_at'];
        $realization->settled_at = $payload['settled_at'];
        $realization->settlement_type = $payload['settlement_type'];

        return $realization;
    }

    /**
     * @param Settlement $realization
     * @param array $payload
     * @return Settlement
     */
    public function update(Settlement $realization, array $payload): Settlement
    {
        $realization->user_account_id = $payload['user_account_id'] ?? $realization->user_account_id;
        $realization->amount = $payload['amount'] ?? $realization->amount;
        $realization->transaction_at = $payload['transaction_at'] ?? $realization->transaction_at;
        $realization->settled_at = $payload['settled_at'] ?? $realization->realization_at;
        $realization->settlement_type = $payload['settlement_type'] ?? $realization->settlement_type;

        return $realization;
    }
}