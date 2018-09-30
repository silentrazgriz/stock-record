<?php

declare(strict_types=1);


namespace App\Forms\BrokerAccount;


use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

class CreateBrokerAccountForm extends Form
{
    public function __construct()
    {
        parent::__construct(
            'POST',
            '/broker-accounts',
            'broker-account-form',
            'Add Broker Account',
            [
                'button' => [
                    'placement' => [
                        'vertical' => ButtonPlacement::BOTTOM,
                        'horizontal' => ButtonPlacement::RIGHT
                    ],
                    'action' => [
                        'submit' => [
                            'text' => 'Add'
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
        $this->addField('code', 'Code', FieldType::TEXT)
            ->setPlaceholder('Broker Account Code (ex: PD-Reguler)');

        $this->addField('name', 'Name', FieldType::TEXT)
            ->setPlaceholder('Broker Account Name');

        $this->addField('buy_commission', 'Buy Fee', FieldType::NUMBER)
            ->setPlaceholder('Buy Fee')
            ->setDefaultValue(0.15);

        $this->addField('sell_commission', 'Sell Fee', FieldType::NUMBER)
            ->setPlaceholder('Sell Fee')
            ->setDefaultValue(0.25);

        $this->addField('margin_interest', 'Margin Interest', FieldType::NUMBER)
            ->setPlaceholder('Margin Daily Interest')
            ->setDefaultValue(0.2);
    }
}