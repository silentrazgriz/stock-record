<?php

namespace App\Http\Controllers;

use App\Component\Value\RecordType;
use App\Component\Value\SettlementType;
use App\Data\Quote\QuoteRepository;
use App\Data\Record\RecordRepository;
use App\Data\Settlement\SettlementRepository;
use App\Data\Summary\SummaryRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\Record\CreateRecordForm;
use App\Forms\Record\UpdateRecordForm;
use App\Lists\RecordList;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class RecordController
 * @package App\Http\Controllers
 */
class RecordController extends Controller
{
    /**
     * @var RecordRepository
     */
    private $recordRepository;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * @var SummaryRepository
     */
    private $summaryRepository;

    private $settlementRepository;

    public function __construct(
        RecordRepository $recordRepository,
        UserAccountRepository $userAccountRepository,
        QuoteRepository $quoteRepository,
        SummaryRepository $summaryRepository,
        SettlementRepository $settlementRepository
    ) {
        $this->recordRepository = $recordRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->quoteRepository = $quoteRepository;
        $this->summaryRepository = $summaryRepository;
        $this->settlementRepository = $settlementRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = new RecordList();
        $list->setCollection($this->parseRecord($this->recordRepository->all(['quote'])));

        return $list->render();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $createForm = new CreateRecordForm($this->userAccountRepository, $this->quoteRepository);
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $record = $this->recordRepository->create($request->all());

        // Update Summary
        $summaries = $this->summaryRepository->find(['quote_id' => $record->quote_id]);

        if ($summaries->count() == 0) {
            $this->summaryRepository->create([
                'user_account_id'   => $record->user_account_id,
                'quote_id'          => $record->quote_id,
                'average_price'     => $record->price,
                'total_shares'      => $record->total_shares
            ]);
        } else {
            $summary = $summaries[0];
            $this->summaryRepository->update($summary->id, $this->getSummaryDetails($summary, $record));
        }

        // Update Settlement
        $today = Carbon::now();
        $todayDate = $today->toDateString();
        $settlements = $this->settlementRepository->find(['transaction_at' => $todayDate]);

        $buy_amount = $record->type == RecordType::BUY ? ($record->price * $record->total_shares) + $record->broker_fee : 0;
        $sell_amount = $record->type == RecordType::SELL ? ($record->price * $record->total_shares) - $record->broker_fee : 0;

        if ($settlements->count() == 0) {
            $this->settlementRepository->create([
                'user_account_id'   => $record->user_account_id,
                'buy_amount'        => $buy_amount,
                'sell_amount'       => $sell_amount,
                'net_amount'        => $sell_amount - $buy_amount,
                'transaction_at'    => $todayDate,
                'settled_at'        => $today->addDays(3)->toDateString(),
                'settlement_type'   => SettlementType::ORDER
            ]);
        } else {
            $settlement = $settlements[0];
            $this->settlementRepository->update($settlement->id, [
                'buy_amount'    => $settlement->buy_amount + $buy_amount,
                'sell_amount'   => $settlement->sell_amount + $sell_amount,
                'net_amount'    => $settlement->net_amount + $sell_amount - $buy_amount
            ]);
        }

        return redirect()->route('records.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $updateForm = new UpdateRecordForm($this->userAccountRepository, $this->quoteRepository, $id);
        $updateForm->setDefaultValues($this->recordRepository->findById($id)->toArray());

        return $updateForm->render();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->recordRepository->update($id, $request->all());
        return redirect()->route('records.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->recordRepository->destroy($id);
        return redirect()->route('records.index');
    }

    /**
     * @param $summary
     * @param $record
     * @return array
     */
    private function getSummaryDetails($summary, $record)
    {
        $result = [
            'summary' => $summary->average_price * $summary->total_shares,
            'record' => $record->price * $record->total_shares,
            'total_shares' => $summary->total_shares + $record->total_shares
        ];

        return [
            'average_price' => ($result['summary'] + $result['record']) / $result['total_shares'],
            'total_shares' => $result['total_shares']
        ];
    }

    /**
     * @param $records
     * @return mixed
     */
    private function parseRecord($records)
    {
        foreach($records as &$record) {
            $record['sub_total'] = $record['price'] * $record['total_shares'];
        }

        return $records;
    }
}
