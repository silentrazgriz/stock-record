<?php

namespace App\Http\Controllers;

use App\Component\Value\SettlementType;
use App\Data\Settlement\SettlementRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\Deposit\CreateDepositForm;
use App\Lists\DepositList;
use App\Services\SettlementService;
use Illuminate\Http\Request;

/**
 * Class DepositController
 * @package App\Http\Controllers
 */
class DepositController extends Controller
{
    /**
     * @var SettlementRepository
     */
    private $settlementRepository;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var SettlementService
     */
    private $settlementService;

    /**
     * DepositController constructor.
     * @param SettlementRepository $settlementRepository
     * @param UserAccountRepository $userAccountRepository
     * @param SettlementService $settlementService
     */
    public function __construct(
        SettlementRepository $settlementRepository,
        UserAccountRepository $userAccountRepository,
        SettlementService $settlementService
    ) {
        $this->settlementRepository = $settlementRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->settlementService = $settlementService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = new DepositList();
        $list->setCollection($this->settlementRepository->find(['settlement_type' => SettlementType::DEPOSIT], ['userAccount']));
        return $list->render();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $createForm = new CreateDepositForm($this->userAccountRepository);
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->settlementService->deposit($request->all(), SettlementType::DEPOSIT);
        return redirect()->route('deposits.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->settlementService->cancelDeposit($id);
        return redirect()->route('deposits.index');
    }
}
