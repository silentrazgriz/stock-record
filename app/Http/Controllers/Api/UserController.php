<?php

namespace App\Http\Controllers\Api;

use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request) {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->create($data);
    }

    public function me() {
        return $this->userRepository->findById(Auth::id());
    }

    public function index()
    {
        return $this->userRepository->all();
    }

    public function show($id)
    {
        return $this->userRepository->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->userRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }
}
