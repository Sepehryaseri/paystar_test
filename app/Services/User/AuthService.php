<?php

namespace App\Services\User;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\Exceptionable;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use Exceptionable;

    public function __construct(public UserRepositoryInterface $userRepository)
    {
    }

    public function login(array $data): array
    {
        try {
            $user = $this->userRepository->findBy('username', $data['username']);
            if (empty($user)) {
                return ['status' => 404, 'message' => __('user.not_found')];
            }

            if (!auth()->attempt($data)) {
                return ['status' => 400, 'message' => __('user.credential_error')];
            }

            return ['status' => 200];

        } catch (Exception $exception) {
            return $this->getException($exception);
        }
    }
}
