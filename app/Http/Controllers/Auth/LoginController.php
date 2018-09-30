<?php

namespace App\Http\Controllers\Auth;

use App\Forms\LoginForm;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = route('root');
    }

    /**
     * @return mixed
     */
    public function showLoginForm()
    {
        $loginForm = new LoginForm();
        return $loginForm->render();
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $byEmail = [
            'email' => $request->get('login_id'),
            'password' => $request->get('password')
        ];
        $byLoginId = [
            'login_id' => $request->get('login_id'),
            'password' => $request->get('password')
        ];

        $result = $this->guard()->attempt($byEmail, $request->filled('remember')) ||
            $this->guard()->attempt($byLoginId, $request->filled('remember'));

        return $result;
    }

    public function username()
    {
        return 'login_id';
    }
}
