<?php

declare(strict_types=1);


namespace App\Data\UserAccount;

use Auth;

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

        return $userAccount;
    }
}