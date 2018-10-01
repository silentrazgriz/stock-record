<?php

declare(strict_types=1);


namespace App\Data\Margin;

final class MarginFactory
{
    /**
     * @param array $payload
     * @return Margin
     */
    public function create(array $payload): Margin
    {
        $margin = new Margin();

        $margin->user_account_id = $payload['user_account_id'];
        $margin->total_margin = $payload['total_margin'];
        $margin->total_interest = $payload['total_interest'];

        return $margin;
    }

    /**
     * @param Margin $margin
     * @param array $payload
     * @return Margin
     */
    public function update(Margin $margin, array $payload): Margin
    {
        $margin->user_account_id = $payload['user_account_id'] ?? $margin->user_account_id;
        $margin->total_margin = $payload['total_margin'] ?? $margin->total_margin;
        $margin->total_interest = $payload['total_interest'] ?? $margin->total_interest;

        return $margin;
    }
}