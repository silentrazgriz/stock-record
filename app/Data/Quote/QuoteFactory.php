<?php

declare(strict_types=1);


namespace App\Data\Quote;

/**
 * Class QuoteFactory
 * @package App\Data\Quote
 */
final class QuoteFactory
{
    /**
     * @param array $payload
     * @return Quote
     */
    public function create(array $payload): Quote
    {
        $quote = new Quote();

        $quote->sector = $payload['sector'];
        $quote->code = $payload['code'];
        $quote->name = $payload['name'];
        $quote->previous = $payload['previous'];
        $quote->close = $payload['close'];
        $quote->high = $payload['high'];
        $quote->low = $payload['low'];
        $quote->change = $payload['change'];
        $quote->listed_share = $payload['listed_share'];
        $quote->volume = $payload['volume'];
        $quote->foreign_buy = $payload['foreign_buy'];
        $quote->foreign_sell = $payload['foreign_sell'];

        return $quote;
    }

    /**
     * @param Quote $quote
     * @param array $payload
     * @return Quote
     */
    public function update(Quote $quote, array $payload): Quote
    {
        $quote->sector = $payload['sector'] ?? $quote->sector;
        $quote->code = $payload['code'] ?? $quote->code;
        $quote->name = $payload['name'] ?? $quote->name;
        $quote->previous = $payload['previous'] ?? $quote->previous;
        $quote->close = $payload['close'] ?? $quote->close;
        $quote->high = $payload['high'] ?? $quote->high;
        $quote->low = $payload['low'] ?? $quote->low;
        $quote->change = $payload['change'] ?? $quote->change;
        $quote->listed_share = $payload['listed_share'] ?? $quote->listed_share;
        $quote->volume = $payload['volume'] ?? $quote->volume;
        $quote->foreign_buy = $payload['foreign_buy'] ?? $quote->foreign_buy;
        $quote->foreign_sell = $payload['foreign_sell'] ?? $quote->foreign_sell;

        return $quote;
    }
}