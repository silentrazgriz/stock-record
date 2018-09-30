<?php

namespace App\Http\Controllers;

use App\Data\BrokerAccount\BrokerAccountRepository;
use App\Forms\BrokerAccount\CreateBrokerAccountForm;
use App\Forms\BrokerAccount\UpdateBrokerAccountForm;
use App\Lists\BrokerAccountList;
use Illuminate\Http\Request;

/**
 * Class BrokerAccountController
 * @package App\Http\Controllers
 */
class BrokerAccountController extends Controller
{
    /**
     * @var BrokerAccountRepository
     */
    private $brokerAccountRepository;

    /**
     * BrokerAccountController constructor.
     * @param BrokerAccountRepository $brokerAccountRepository
     */
    public function __construct(
        BrokerAccountRepository $brokerAccountRepository
    ) {
        $this->brokerAccountRepository = $brokerAccountRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = new BrokerAccountList();
        $list->setCollection($this->brokerAccountRepository->all());

        return $list->render();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $createForm = new CreateBrokerAccountForm();
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->brokerAccountRepository->create($request->all());
        return redirect()->route('broker-accounts.index');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $brokerAccount = $this->brokerAccountRepository->findById($id)->toArray();

        $updateForm = new UpdateBrokerAccountForm();
        $updateForm->setDefaultValues($brokerAccount);

        return $updateForm->render();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->brokerAccountRepository->update($id, $request->all());
        return redirect()->route('broker-accounts.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->brokerAccountRepository->destroy($id);
        return redirect()->route('broker-accounts.index');
    }
}
