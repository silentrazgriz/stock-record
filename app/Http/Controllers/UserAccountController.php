<?php

namespace App\Http\Controllers;

use App\Data\BrokerAccount\BrokerAccountRepository;
use App\Data\UserAccount\UserAccountRepository;
use App\Forms\UserAccount\CreateUserAccountForm;
use App\Forms\UserAccount\UpdateUserAccountForm;
use App\Lists\UserAccountList;
use Illuminate\Http\Request;

/**
 * Class UserAccountController
 * @package App\Http\Controllers
 */
class UserAccountController extends Controller
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var BrokerAccountRepository
     */
    private $brokerAccountRepository;

    /**
     * UserAccountController constructor.
     * @param UserAccountRepository $userAccountRepository
     * @param BrokerAccountRepository $brokerAccountRepository
     */
    public function __construct(
        UserAccountRepository $userAccountRepository,
        BrokerAccountRepository $brokerAccountRepository
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->brokerAccountRepository = $brokerAccountRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = new UserAccountList();
        $list->setCollection($this->userAccountRepository->all(['brokerAccount']));

        return $list->render();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $createForm = new CreateUserAccountForm($this->brokerAccountRepository);
        return $createForm->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->userAccountRepository->create($request->all());
        return redirect()->route('user-accounts.index');
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
        $updateForm = new UpdateUserAccountForm($this->brokerAccountRepository, $id);
        $updateForm->setDefaultValues($this->userAccountRepository->findById($id)->toArray());

        return $updateForm->render();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->userAccountRepository->update($id, $request->all());
        return redirect()->route('user-accounts.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->userAccountRepository->destroy($id);
        return redirect()->route('user-accounts.index');
    }
}
