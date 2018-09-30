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
                ['key' => 'quote.code', 'type' => 'text'],
                ['key' => 'type', 'type' => 'text'],
                ['key' => 'price', 'type' => 'number'],
                ['key' => 'total_shares', 'type' => 'number'],
                ['key' => 'sub_total', 'type' => 'number'],
                ['key' => 'broker_fee', 'type' => 'number'],
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