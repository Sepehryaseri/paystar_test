<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Services\User\AuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {
    }

    public function login(UserLoginRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $data = $request->validated();
        $result = $this->authService->login($data);
        if ($result['status'] != 200) {
            return redirect()->back()->withErrors(['message' => $result['message']]);
        }
        return redirect(route('profile'));
    }
}
