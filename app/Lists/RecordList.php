<?php

declare(strict_types=1);


namespace App\Lists;

use Gaia\Chiron\Component\CollectionList;

class RecordList extends CollectionList
{
    public function __construct()
    {
        parent::__construct(
            'Your Transaction Records',
            [
                ['key' => 'quote.code', 'label' => 'Stock', 'type' => 'text'],
                ['key' => 'type', 'label' => 'Type', 'type' => 'text'],
                ['key' => 'price', 'label' => 'Price', 'type' => 'number'],
                ['key' => 'total_shares', 'label' => 'Shares', 'type' => 'number'],
                ['key' => 'sub_total', 'label' => 'Sub Total', 'type' => 'number'],
                ['key' => 'broker_fee', 'label' => 'Fee', 'type' => 'number'],
                ['key' => 'transaction_date', 'label' => 'Date', 'type' => 'date']
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => false,
                    'destroy' => true
                ],
                'route' => 'records'
            ]
        );
    }
}