<?php

namespace App\Http\Controllers;

use App\Data\Settlement\SettlementRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\Deposit\CreateDepositForm;
use App\Lists\DepositList;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    private $settlementRepository;

    private $userAccountRepository;

    public function __construct(
        SettlementRepository $settlementRepository,
        UserAccountRepository $userAccountRepository
    ) {
        $this->settlementRepository = $settlementRepository;
        $this->userAccountRepository = $userAccountRepository;
    }

    public function index()
    {
        $list = new DepositList();
        $list->setCollection($this->settlementRepository->all());
        return $list->render();
    }

    public function create()
    {
        $createForm = new CreateDepositForm($this->userAccountRepository);
        return $createForm->render();
    }

    public function store(Request $request)
    {
        //
    }

    public function destroy($id)
    {
        $this->settlementRepository->destroy($id);
        return redirect()->route('deposits.index');
    }
}
