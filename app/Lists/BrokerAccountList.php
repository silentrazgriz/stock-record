<?php

declare(strict_types=1);


namespace App\Lists;


use App\Component\CollectionRenderer;

class BrokerAccountList extends CollectionRenderer
{
    public function __construct()
    {
        parent::__construct(
            'All Broker Account',
            [
                ['key' => 'code', 'label' => 'Broker Code', 'type' => 'text'],
                ['key' => 'name', 'label' => 'Account Type', 'type' => 'text'],
                ['key' => 'buy_commission', 'label' => 'Buy Fee', 'type' => 'float'],
                ['key' => 'sell_commission', 'label' => 'Sell Fee', 'type' => 'float'],
                ['key' => 'margin_interest', 'label' => 'Margin Fee', 'type' => 'float'],
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => true,
                    'destroy' => true
                ],
                'route' => 'broker-accounts'
            ]
        );
    }
}