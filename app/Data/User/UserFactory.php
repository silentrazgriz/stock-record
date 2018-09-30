<?php

declare(strict_types=1);


namespace App\Data\User;

final class UserFactory
{
    /**
     * @param array $payload
     * @return User
     */
    public function create(array $payload): User
    {
        $user = new User();

        $user->login_id = $payload['login_id'];
        $user->name = $payload['name'];
        $user->email = $payload['email'];
        $user->password = $payload['password'];

        return $user;
    }

    /**
     * @param User $user
     * @param array $payload
     * @return User
     */
    public function update(User $user, array $payload): User
    {
        $user->login_id = $payload['login_id'] ?? $user->login_id;
        $user->name = $payload['name'] ?? $user->name;
        $user->email = $payload['email'] ?? $user->email;
        $user->password = $payload['password'] ?? $user->password;

        return $user;
    }
}