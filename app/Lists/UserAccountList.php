<?php

declare(strict_types=1);


namespace App\Lists;

use Gaia\Chiron\Component\CollectionList;

class UserAccountList extends CollectionList
{
    public function __construct()
    {
        parent::__construct(
            'Your Accounts',
            [
                ['key' => 'broker_account.code', 'label' => 'Broker Code', 'type' => 'text'],
                ['key' => 'name', 'label' => 'Account ID', 'type' => 'text'],
                ['key' => 'broker_account.buy_commission', 'label' => 'Buy Fee', 'type' => 'float'],
                ['key' => 'broker_account.sell_commission', 'label' => 'Sell Fee', 'type' => 'float'],
                ['key' => 'broker_account.margin_interest', 'label' => 'Margin Fee', 'type' => 'float'],
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