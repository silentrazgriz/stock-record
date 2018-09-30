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
                ['key' => 'code', 'type' => 'text'],
                ['key' => 'name', 'type' => 'text'],
                ['key' => 'buy_commission', 'type' => 'float'],
                ['key' => 'sell_commission', 'type' => 'float'],
                ['key' => 'margin_interest', 'type' => 'float'],
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