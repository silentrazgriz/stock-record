<?php

declare(strict_types=1);


namespace App\Data\Summary;

final class SummaryFactory
{
    /**
     * @param array $payload
     * @return Summary
     */
    public function create(array $payload): Summary
    {
        $summary = new Summary();

        $summary->user_account_id = $payload['user_account_id'];
        $summary->quote_id = $payload['quote_id'];
        $summary->average_price = $payload['average_price'];
        $summary->total_shares = $payload['total_shares'];

        return $summary;
    }

    /**
     * @param Summary $summary
     * @param array $payload
     * @return Summary
     */
    public function update(Summary $summary, array $payload): Summary
    {
        $summary->user_account_id = $payload['user_account_id'] ?? $summary->user_account_id;
        $summary->quote_id = $payload['quote_id'] ?? $summary->quote_id;
        $summary->average_price = $payload['average_price'] ?? $summary->average_price;
        $summary->total_shares = $payload['total_shares'] ?? $summary->total_shares;

        return $summary;
    }
}