<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function isLoggedIn(): bool
    {
        return Auth::check();
    }

}
