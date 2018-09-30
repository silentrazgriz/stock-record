<?php

declare(strict_types=1);


namespace App\Forms\UserAccount;


use App\Data\BrokerAccount\BrokerAccountRepository;
use Gaia\Tekton\component\ChoiceValueParser;
use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

/**
 * Class CreateUserAccountForm
 * @package App\Forms\UserAccount
 */
class CreateUserAccountForm extends Form
{
    /**
     * @var BrokerAccountRepository
     */
    private $brokerAccountRepository;

    /**
     * CreateUserAccountForm constructor.
     * @param BrokerAccountRepository $brokerAccountRepository
     */
    public function __construct(
        BrokerAccountRepository $brokerAccountRepository
    ) {
        parent::__construct(
            'POST',
            '/user-accounts',
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
            ->setChoiceValues(ChoiceValueParser::parse($brokerAccounts, 'name', 'id'));

        $this->addField('name', 'Account ID', FieldType::TEXT)
            ->setPlaceholder('Account ID');
    }
}