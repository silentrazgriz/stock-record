<?php

declare(strict_types=1);


namespace App\Lists;

use Gaia\Chiron\Component\CollectionList;

final class DepositList extends CollectionList
{
    public function __construct()
    {
        parent::__construct(
            'All Deposit',
            [
                ['key' => 'transaction_at', 'label' => 'Transaction Date', 'type' => 'date'],
                ['key' => 'user_account.name', 'label' => 'Account', 'type' => 'text'],
                ['key' => 'net_amount', 'label' => 'Deposit Amount', 'type' => 'number'],
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => false,
                    'destroy' => true
                ],
                'route' => 'deposits'
            ]
        );
    }
}