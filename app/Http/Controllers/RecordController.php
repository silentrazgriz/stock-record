<?php

namespace App\Http\Controllers;

use App\Data\Quote\QuoteRepository;
use App\Data\Record\RecordRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\Record\CreateRecordForm;
use App\Lists\RecordList;
use App\Services\SettlementService;
use App\Services\SummaryService;
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
     * @var SummaryService
     */
    private $summaryService;

    /**
     * @var SettlementService
     */
    private $settlementService;

    /**
     * RecordController constructor.
     * @param RecordRepository $recordRepository
     * @param UserAccountRepository $userAccountRepository
     * @param QuoteRepository $quoteRepository
     * @param SummaryService $summaryService
     * @param SettlementService $settlementService
     */
    public function __construct(
        RecordRepository $recordRepository,
        UserAccountRepository $userAccountRepository,
        QuoteRepository $quoteRepository,
        SummaryService $summaryService,
        SettlementService $settlementService
    ) {
        $this->recordRepository = $recordRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->quoteRepository = $quoteRepository;
        $this->summaryService = $summaryService;
        $this->settlementService = $settlementService;
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
        $createForm->setDefaultValues(['user_account_id' => session()->get('user-account-id')]);
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $record = $this->recordRepository->create($request->all());

        $this->summaryService->store($record);
        $this->settlementService->storeOrder($record);

        return redirect()->route('records.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $record = $this->recordRepository->findById($id);

        $this->summaryService->destroy($record);
        $this->settlementService->cancelOrder($record);

        $this->recordRepository->destroy($id);
        return redirect()->route('records.index');
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
