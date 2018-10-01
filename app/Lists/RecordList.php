<?php

declare(strict_types=1);


namespace App\Lists;


use App\Component\CollectionRenderer;

class RecordList extends CollectionRenderer
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
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => true,
                    'destroy' => true
                ],
                'route' => 'records'
            ]
        );
    }
}