<?php

declare(strict_types=1);


namespace App\Lists;

use Gaia\Chiron\Component\CollectionList;

final class OffDayList extends CollectionList
{
    public function __construct()
    {
        parent::__construct(
            'All Holidays',
            [
                ['key' => 'off_date', 'label' => 'Holidays', 'type' => 'date']
            ],
            [
                'actions' => [
                    'detail' => false,
                    'store' => true,
                    'update' => true,
                    'destroy' => true
                ],
                'route' => 'off-days'
            ]
        );
    }
}