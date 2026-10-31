<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(private StatefulGuard $guard)
    {
    }

    public function isLoggedIn(): bool
    {
        return $this->guard->check();
    }

    /**
     * @param array $data
     * @return array{success: bool, message: string, user: User|null}
     */
    public function attempt(array $data): array
    {
        if(! array_key_exists('username', $data)) {
            return ['success' => false, 'message' => 'Username missing', 'user' => null];
        }

        if(! array_key_exists('password', $data)) {
            return ['success' => false, 'message' => 'Password missing', 'user' => null];
        }

        if(! array_key_exists('secret', $data)) {
            return ['success' => false, 'message' => 'Secret missing', 'user' => null];
        }

        $username = $data['username'];
        $password = $data['password'];
        $secret = $data['secret'];

        if(config('auth.secret') !== $secret) {
            return ['success' => false, 'message' => 'Invalid secret', 'user' => null];
        }

        $user = User::query()
            ->where('username', $username)
            ->first();

        if(! $user || ! Hash::check($password, $user->getHashedPassword())) {
            return ['success' => false, 'message' => 'Invalid credentials', 'user' => null];
        }

        $this->guard->login($user);
        return ['success' => true, 'message' => 'Success', 'user' => $user];
    }

    public function logout(): void
    {
        $this->guard->logout();
    }

}
