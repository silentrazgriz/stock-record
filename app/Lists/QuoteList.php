<?php

declare(strict_types=1);


namespace App\Lists;


use App\Component\CollectionRenderer;

class QuoteList extends CollectionRenderer
{
    public function __construct()
    {
        parent::__construct(
            'All Quotes',
            [
                ['key' => 'code', 'label' => 'Stock', 'type' => 'text'],
                ['key' => 'name', 'label' => 'Name', 'type' => 'text'],
                ['key' => 'previous', 'label' => 'Prev', 'type' => 'number'],
                ['key' => 'close', 'label' => 'Close', 'type' => 'number'],
                ['key' => 'low', 'label' => 'Low', 'type' => 'number'],
                ['key' => 'high', 'label' => 'High', 'type' => 'number'],
                ['key' => 'change', 'label' => 'Change', 'type' => 'number'],
                ['key' => 'volume', 'label' => 'Volume', 'type' => 'number'],
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => false,
                    'update' => false,
                    'destroy' => false
                ],
                'route' => 'quotes'
            ]
        );
    }
}