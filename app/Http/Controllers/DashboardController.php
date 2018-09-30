<?php
declare(strict_types=1);


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {
        if(Auth::guest()) {
            return redirect('login');
        }

        return view('dashboard');
    }

    public function summary()
    {
        return view('dashboard');
    }
}