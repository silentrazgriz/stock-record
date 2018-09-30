<?php

declare(strict_types=1);


namespace App\Lists;


use App\Component\CollectionRenderer;

class UserAccountList extends CollectionRenderer
{
    public function __construct()
    {
        parent::__construct(
            'Your Accounts',
            [
                ['key' => 'broker_account.code', 'type' => 'text'],
                ['key' => 'name', 'type' => 'text'],
                ['key' => 'broker_account.buy_commission', 'type' => 'float'],
                ['key' => 'broker_account.sell_commission', 'type' => 'float'],
                ['key' => 'broker_account.margin_interest', 'type' => 'float'],
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => true,
                    'destroy' => true
                ],
                'route' => 'user-accounts'
            ]
        );
    }
}