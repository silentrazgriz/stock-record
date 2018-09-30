<?php

namespace App\Http\Controllers;

use App\Data\BrokerAccount\BrokerAccountRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\UserAccount\CreateUserAccountForm;
use App\Forms\UserAccount\UpdateUserAccountForm;
use App\Lists\UserAccountList;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    private $userAccountRepository;

    private $brokerAccountRepository;

    public function __construct(
        UserAccountRepository $userAccountRepository,
        BrokerAccountRepository $brokerAccountRepository
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->brokerAccountRepository = $brokerAccountRepository;
    }

    public function index()
    {
        $list = new UserAccountList();
        $list->setCollection($this->userAccountRepository->all(['brokerAccount']));

        return $list->render();
    }

    public function create()
    {
        $createForm = new CreateUserAccountForm($this->brokerAccountRepository);

        return $createForm->render();
    }

    public function store(Request $request)
    {
        $this->userAccountRepository->create($request->all());
        return redirect()->route('user-accounts.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $updateForm = new UpdateUserAccountForm($this->brokerAccountRepository);
        $updateForm->setDefaultValues($this->userAccountRepository->findById($id)->toArray());

        return $updateForm->render();
    }

    public function update(Request $request, $id)
    {
        $this->userAccountRepository->update($id, $request->all());
        return redirect()->route('user-accounts.index');
    }

    public function destroy($id)
    {
        $this->userAccountRepository->destroy($id);
        return redirect()->route('user-accounts.index');
    }
}
