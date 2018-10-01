<?php

declare(strict_types=1);


namespace App\Forms\Record;


use App\Component\Value\RecordType;
use App\Data\Quote\QuoteRepository;
use App\Data\UserAccount\UserAccountRepository;
use Carbon\Carbon;
use Gaia\Tekton\component\ChoiceValueParser;
use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;
use Auth;

/**
 * Class CreateRecordForm
 * @package App\Forms\Record
 */
class CreateRecordForm extends Form
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * CreateRecordForm constructor.
     * @param UserAccountRepository $userAccountRepository
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        UserAccountRepository $userAccountRepository,
        QuoteRepository $quoteRepository
    ) {
        parent::__construct(
            'POST',
            '/records',
            'record-form',
            'Add Transaction Record',
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
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param array $values
     */
    protected function build(array $values = []): void
    {
        $userAccounts = $this->userAccountRepository->find(['user_id' => Auth::user()->id])
            ->toArray();

        $quotes = $this->quoteRepository->all()
            ->toArray();

        $this->addField('user_account_id', 'Account', FieldType::SELECT)
            ->setChoiceValues(ChoiceValueParser::parse($userAccounts, 'name', 'id'));

        $this->addField('transaction_date', 'Transaction Date', FieldType::DATE)
            ->setDefaultValue(Carbon::now()->toDateString());

        $this->addField('type', 'Transaction Type', FieldType::SELECT)
            ->setChoiceValues([
                ['text' => 'BUY', 'value' => RecordType::BUY],
                ['text' => 'SELL', 'value' => RecordType::SELL],
            ]);

        $this->addField('quote_id', 'Stock Quote', FieldType::SELECT)
            ->setChoiceValues(ChoiceValueParser::parse($quotes, 'code', 'id'));

        $this->addField('price', 'Price', FieldType::MONEY)
            ->setPlaceholder('Price');

        $this->addField('total_shares', 'Total shares', FieldType::MONEY)
            ->setPlaceholder('Total shares');
    }
}