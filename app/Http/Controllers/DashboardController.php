<?php
declare(strict_types=1);


namespace App\Http\Controllers;


use App\Data\Summary\SummaryRepository;
use App\Data\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var SummaryRepository
     */
    private $summaryRepository;

    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     * @param SummaryRepository $summaryRepository
     */
    public function __construct(
        UserRepository $userRepository,
        SummaryRepository $summaryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->summaryRepository = $summaryRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(Auth::guest()) {
            return redirect('login');
        }

        $user = $this->userRepository->findById(Auth::user()->id, ['userAccounts.summaries.quote', 'userAccounts.brokerAccount'])
            ->toArray();

        return view('dashboard', [
            'user' => $user
        ]);
    }
}