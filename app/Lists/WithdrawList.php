<?php

declare(strict_types=1);


namespace App\Lists;

use Gaia\Chiron\Component\CollectionList;

final class WithdrawList extends CollectionList
{
    public function __construct()
    {
        parent::__construct(
            'All Withdraw',
            [
                ['key' => 'transaction_at', 'label' => 'Transaction Date', 'type' => 'date'],
                ['key' => 'net_amount', 'label' => 'Withdraw Amount', 'type' => 'number'],
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => false,
                    'destroy' => true
                ],
                'route' => 'withdraws'
            ]
        );
    }
}