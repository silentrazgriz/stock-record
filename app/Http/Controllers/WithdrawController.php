<?php

namespace App\Http\Controllers;

use App\Component\Value\SettlementType;
use App\Data\Settlement\SettlementRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\Withdraw\CreateWithdrawForm;
use App\Lists\WithdrawList;
use App\Services\SettlementService;
use Illuminate\Http\Request;

class WithdrawController extends Controller
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
     * WithdrawController constructor.
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
        $list = new WithdrawList();
        $list->setCollection($this->settlementRepository->find(['settlement_type' => SettlementType::WITHDRAW]));
        return $list->render();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $createForm = new CreateWithdrawForm($this->userAccountRepository);
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->settlementService->deposit($request->all(), SettlementType::WITHDRAW);
        return redirect()->route('withdraws.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->settlementService->cancelDeposit($id);
        return redirect()->route('withdraws.index');
    }
}
