<?php

declare(strict_types=1);


namespace App\Data\Settlement;

use Carbon\Carbon;

final class SettlementFactory
{
    /**
     * @param array $payload
     * @return Settlement
     */
    public function create(array $payload): Settlement
    {
        $realization = new Settlement();

        if (isset($payload['transaction_at'])) {
            $payload['transaction_at'] = Carbon::parse($payload['transaction_at'])
                ->setTime(0, 0, 0)
                ->toDateString();
        }
        if (isset($payload['settled_at'])) {
            $payload['settled_at'] = Carbon::parse($payload['settled_at'])
                ->setTime(0, 0, 0)
                ->toDateString();
        }

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
        if (isset($payload['transaction_at'])) {
            $payload['transaction_at'] = Carbon::parse($payload['transaction_at'])
                ->setTime(0, 0, 0)
                ->toDateString();
        }
        if (isset($payload['settled_at'])) {
            $payload['settled_at'] = Carbon::parse($payload['settled_at'])
                ->setTime(0, 0, 0)
                ->toDateString();
        }

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