<?php

declare(strict_types=1);


namespace App\Forms\OffDay;

use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

final class UpdateOffDayForm extends Form
{
    public function __construct($id) {
        parent::__construct(
            'PUT',
            '/user-accounts/' . $id,
            'user-account-form',
            'Change Account',
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
        $this->addField('off_date', 'Holiday', FieldType::DATE)
            ->setPlaceholder('Choose Holiday Date')
            ->setDefaultValue($values['off_date']);
    }
}