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
                ['key' => 'code', 'type' => 'text'],
                ['key' => 'name', 'type' => 'text'],
                ['key' => 'previous', 'type' => 'number'],
                ['key' => 'close', 'type' => 'number'],
                ['key' => 'low', 'type' => 'number'],
                ['key' => 'high', 'type' => 'number'],
                ['key' => 'change', 'type' => 'number'],
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