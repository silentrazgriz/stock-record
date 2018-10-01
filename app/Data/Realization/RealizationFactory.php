<?php

declare(strict_types=1);


namespace App\Data\Realization;

final class RealizationFactory
{
    /**
     * @param array $payload
     * @return Realization
     */
    public function create(array $payload): Realization
    {
        $realization = new Realization();

        $realization->user_account_id = $payload['user_account_id'];
        $realization->amount = $payload['amount'];
        $realization->transaction_at = $payload['transaction_at'];
        $realization->realization_at = $payload['realization_at'];

        return $realization;
    }

    /**
     * @param Realization $realization
     * @param array $payload
     * @return Realization
     */
    public function update(Realization $realization, array $payload): Realization
    {
        $realization->user_account_id = $payload['user_account_id'] ?? $realization->user_account_id;
        $realization->amount = $payload['amount'] ?? $realization->amount;
        $realization->transaction_at = $payload['transaction_at'] ?? $realization->transaction_at;
        $realization->realization_at = $payload['realization_at'] ?? $realization->realization_at;

        return $realization;
    }
}