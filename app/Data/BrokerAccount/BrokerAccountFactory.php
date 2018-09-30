<?php

declare(strict_types=1);


namespace App\Data\BrokerAccount;


/**
 * Class AccountFactory
 * @package App\Data\Account
 */
final class BrokerAccountFactory
{
    /**
     * @param array $payload
     * @return BrokerAccount
     */
    public function create(array $payload): BrokerAccount
    {
        $brokerAccount = new BrokerAccount();

        $brokerAccount->user_id = $payload['user_id'];
        $brokerAccount->code = $payload['code'];
        $brokerAccount->buy_commission = $payload['buy_commission'];
        $brokerAccount->sell_commission = $payload['sell_commission'];
        $brokerAccount->margin_interest = $payload['margin_interest'];

        return $brokerAccount;
    }

    /**
     * @param BrokerAccount $brokerAccount
     * @param array $payload
     * @return BrokerAccount
     */
    public function update(BrokerAccount $brokerAccount, array $payload): BrokerAccount
    {
        $brokerAccount->user_id = $payload['user_id'] ?? $brokerAccount->user_id;
        $brokerAccount->code = $payload['code'] ?? $brokerAccount->code;
        $brokerAccount->buy_commission = $payload['buy_commission'] ?? $brokerAccount->buy_commission;
        $brokerAccount->sell_commission = $payload['sell_commission'] ?? $brokerAccount->sell_commission;
        $brokerAccount->margin_interest = $payload['margin_interest'] ?? $brokerAccount->margin_interest;

        return $brokerAccount;
    }
}