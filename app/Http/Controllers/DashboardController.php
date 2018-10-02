<?php
declare(strict_types=1);


namespace App\Http\Controllers;


use App\Data\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
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