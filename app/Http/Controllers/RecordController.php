<?php

namespace App\Http\Controllers;

use App\Data\Quote\QuoteRepository;
use App\Data\Record\RecordRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\Record\CreateRecordForm;
use App\Forms\Record\UpdateRecordForm;
use App\Lists\RecordList;
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
     * RecordController constructor.
     * @param RecordRepository $recordRepository
     * @param UserAccountRepository $userAccountRepository
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        RecordRepository $recordRepository,
        UserAccountRepository $userAccountRepository,
        QuoteRepository $quoteRepository
    ) {
        $this->recordRepository = $recordRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->quoteRepository = $quoteRepository;
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
        $this->recordRepository->create($request->all());
        return redirect()->route('records.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $updateForm = new UpdateRecordForm($this->userAccountRepository, $this->quoteRepository);
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
