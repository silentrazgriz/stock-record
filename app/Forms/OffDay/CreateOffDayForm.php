<?php

declare(strict_types=1);


namespace App\Forms\OffDay;

use Carbon\Carbon;
use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

final class CreateOffDayForm extends Form
{
    public function __construct()
    {
        parent::__construct(
            'POST',
            '/off-days',
            'off-day-form',
            'Add Holiday',
            [
                'button' => [
                    'placement' => [
                        'vertical' => ButtonPlacement::BOTTOM,
                        'horizontal' => ButtonPlacement::RIGHT
                    ],
                    'action' => [
                        'submit' => [
                            'text' => 'Save'
                        ]
                    ]
                ],
                'labelAlign' => ''
            ]
        );
    }

    /**
     * @param array $values
     */
    protected function build(array $values = []): void
    {
        $this->addField('off_date', 'Holiday', FieldType::DATE_RANGE)
            ->setDefaultValue(Carbon::now()->toDateString());
    }
}