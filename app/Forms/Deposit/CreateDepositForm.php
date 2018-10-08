<?php

declare(strict_types=1);


namespace App\Forms\Deposit;

use App\Data\UserAccount\UserAccountRepository;
use Carbon\Carbon;
use Gaia\Tekton\component\ChoiceValueParser;
use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;
use Illuminate\Support\Facades\Auth;

final class CreateDepositForm extends Form
{
    private $userAccountRepository;

    public function __construct(
        UserAccountRepository $userAccountRepository
    ) {
        parent::__construct(
            'POST',
            '/deposits',
            'deposit-form',
            'Add Deposit',
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

        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * @param array $values
     */
    protected function build(array $values = []): void
    {
        $userAccounts = $this->userAccountRepository->find(['user_id' => Auth::user()->id])
            ->toArray();

        $this->addField('user_account_id', 'Account', FieldType::SELECT)
            ->setChoiceValues(ChoiceValueParser::parse($userAccounts, 'name', 'id'));

        $this->addField('done_at', 'Transaction Date', FieldType::DATE)
            ->setPlaceholder('Transaction Date')
            ->setDefaultValue(Carbon::now()->toDateString());

        $this->addField('amount', 'Deposit Amount', FieldType::MONEY)
            ->setPlaceholder('Deposit Amount');
    }
}