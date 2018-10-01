<?php

declare(strict_types=1);


namespace App\Data\UserAccount;

use Auth;
use Carbon\Carbon;

/**
 * Class UserAccountFactory
 * @package App\Data\UserAccount
 */
final class UserAccountFactory
{
    /**
     * @param array $payload
     * @return UserAccount
     */
    public function create(array $payload): UserAccount
    {
        $userAccount = new UserAccount();

        $userAccount->user_id = $payload['user_id'] ?? Auth::user()->id;
        $userAccount->broker_account_id = $payload['broker_account_id'];
        $userAccount->name = $payload['name'];
        $userAccount->balance = $payload['balance'];
        $userAccount->balance_updated_at = Carbon::now();

        return $userAccount;
    }

    /**
     * @param UserAccount $userAccount
     * @param array $payload
     * @return UserAccount
     */
    public function update(UserAccount $userAccount, array $payload): UserAccount
    {
        $userAccount->user_id = $payload['user_id'] ?? $userAccount->user_id;
        $userAccount->broker_account_id = $payload['broker_account_id'] ?? $userAccount->broker_account_id;
        $userAccount->name = $payload['name'] ?? $userAccount->name;
        $userAccount->balance = $payload['balance'] ?? $userAccount->balance;
        $userAccount->balance_updated_at = $payload['balance_updated_at'] ?? $userAccount->balance_updated_at;

        return $userAccount;
    }
}