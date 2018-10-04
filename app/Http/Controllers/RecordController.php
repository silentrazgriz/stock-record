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
use App\Services\CalculateSettlementService;
use App\Services\CalculateSummaryService;
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
     * @var CalculateSummaryService
     */
    private $calculateSummaryService;

    /**
     * @var CalculateSettlementService
     */
    private $calculateSettlementService;

    /**
     * RecordController constructor.
     * @param RecordRepository $recordRepository
     * @param UserAccountRepository $userAccountRepository
     * @param QuoteRepository $quoteRepository
     * @param SummaryRepository $summaryRepository
     * @param CalculateSummaryService $calculateSummaryService
     * @param CalculateSettlementService $calculateSettlementService
     */
    public function __construct(
        RecordRepository $recordRepository,
        UserAccountRepository $userAccountRepository,
        QuoteRepository $quoteRepository,
        SummaryRepository $summaryRepository,
        CalculateSummaryService $calculateSummaryService,
        CalculateSettlementService $calculateSettlementService
    ) {
        $this->recordRepository = $recordRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->quoteRepository = $quoteRepository;
        $this->summaryRepository = $summaryRepository;
        $this->calculateSummaryService = $calculateSummaryService;
        $this->calculateSettlementService = $calculateSettlementService;
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

        $this->calculateSummaryService->store($record);
        $this->calculateSettlementService->store($record);

        return redirect()->route('records.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $record = $this->recordRepository->findById($id);

        $this->calculateSummaryService->destroy($record);
        $this->calculateSettlementService->destroy($record);

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
