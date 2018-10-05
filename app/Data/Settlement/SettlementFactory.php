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
        $realization->buy_amount = $payload['buy_amount'];
        $realization->sell_amount = $payload['sell_amount'];
        $realization->net_amount = $payload['net_amount'];
        $realization->transaction_at = $payload['transaction_at'];
        $realization->settled_at = $payload['settled_at'];
        $realization->settlement_type = $payload['settlement_type'];
        $realization->is_realized = $payload['is_realized'] ?? false;

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
        $realization->buy_amount = $payload['buy_amount'] ?? $realization->buy_amount;
        $realization->sell_amount = $payload['sell_amount'] ?? $realization->sell_amount;
        $realization->net_amount = $payload['net_amount'] ?? $realization->net_amount;
        $realization->transaction_at = $payload['transaction_at'] ?? $realization->transaction_at;
        $realization->settled_at = $payload['settled_at'] ?? $realization->realization_at;
        $realization->settlement_type = $payload['settlement_type'] ?? $realization->settlement_type;
        $realization->is_realized = $payload['is_realized'] ?? $realization->is_realized;

        return $realization;
    }
}