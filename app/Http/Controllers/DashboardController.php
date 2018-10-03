<?php
declare(strict_types=1);


namespace App\Http\Controllers;


use App\Data\Summary\SummaryRepository;
use App\Data\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    private $userRepository;

    private $summaryRepository;

    public function __construct(
        UserRepository $userRepository,
        SummaryRepository $summaryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->summaryRepository = $summaryRepository;
    }

    public function index()
    {
        if(Auth::guest()) {
            return redirect('login');
        }

        //dd($this->userRepository->findById(Auth::user()->id, ['userAccounts.records.quote'])->toArray());

        return view('dashboard');
    }
}