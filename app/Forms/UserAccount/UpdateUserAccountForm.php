<?php

declare(strict_types=1);


namespace App\Forms\UserAccount;


use App\Data\BrokerAccount\BrokerAccountRepository;
use Gaia\Tekton\component\ChoiceValueParser;
use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

/**
 * Class UpdateUserAccountForm
 * @package App\Forms\UserAccount
 */
class UpdateUserAccountForm extends Form
{
    /**
     * @var BrokerAccountRepository
     */
    private $brokerAccountRepository;

    /**
     * UpdateUserAccountForm constructor.
     * @param BrokerAccountRepository $brokerAccountRepository
     * @param $id
     */
    public function __construct(
        BrokerAccountRepository $brokerAccountRepository,
        $id
    ) {
        parent::__construct(
            'PUT',
            '/user-accounts/' . $id,
            'user-account-form',
            'Add Account',
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

        $this->brokerAccountRepository = $brokerAccountRepository;
    }

    /**
     * @param array $values
     */
    protected function build(array $values = []): void
    {
        $brokerAccounts = $this->brokerAccountRepository->all()
            ->toArray();

        $this->addField('broker_account_id', 'Broker Account', FieldType::SELECT)
            ->setChoiceValues(ChoiceValueParser::parse($brokerAccounts, 'name', 'id'))
            ->setDefaultValue($values['broker_account_id']);

        $this->addField('name', 'Account ID', FieldType::TEXT)
            ->setPlaceholder('Account ID')
            ->setDefaultValue($values['name']);
    }
}