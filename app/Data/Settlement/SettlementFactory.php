<?php

declare(strict_types=1);


namespace App\Data\Settlement;

use App\Component\Value\DateParser;

final class SettlementFactory
{
    /**
     * @param array $payload
     * @return Settlement
     */
    public function create(array $payload): Settlement
    {
        $settlement = new Settlement();

        if (isset($payload['done_at'])) {
            $payload['done_at'] = DateParser::parse($payload['done_at']);
        }
        if (isset($payload['settled_at'])) {
            $payload['settled_at'] = DateParser::parse($payload['settled_at']);
        }

        $settlement->user_account_id = $payload['user_account_id'];
        $settlement->buy_amount = $payload['buy_amount'];
        $settlement->sell_amount = $payload['sell_amount'];
        $settlement->net_amount = $payload['net_amount'];
        $settlement->done_at = $payload['done_at'];
        $settlement->settled_at = $payload['settled_at'];
        $settlement->settlement_type = $payload['settlement_type'];
        $settlement->is_realized = $payload['is_realized'] ?? false;

        return $settlement;
    }

    /**
     * @param Settlement $settlement
     * @param array $payload
     * @return Settlement
     */
    public function update(Settlement $settlement, array $payload): Settlement
    {
        if (isset($payload['done_at'])) {
            $payload['done_at'] = DateParser::parse($payload['done_at']);
        }
        if (isset($payload['settled_at'])) {
            $payload['settled_at'] = DateParser::parse($payload['settled_at']);
        }
        
        $settlement->user_account_id = $payload['user_account_id'] ?? $settlement->user_account_id;
        $settlement->buy_amount = $payload['buy_amount'] ?? $settlement->buy_amount;
        $settlement->sell_amount = $payload['sell_amount'] ?? $settlement->sell_amount;
        $settlement->net_amount = $payload['net_amount'] ?? $settlement->net_amount;
        $settlement->done_at = $payload['done_at'] ?? $settlement->done_at;
        $settlement->settled_at = $payload['settled_at'] ?? $settlement->settled_at;
        $settlement->settlement_type = $payload['settlement_type'] ?? $settlement->settlement_type;
        $settlement->is_realized = $payload['is_realized'] ?? $settlement->is_realized;

        return $settlement;
    }
}