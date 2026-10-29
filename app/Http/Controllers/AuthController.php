<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $auth)
    {
    }

    public function loginView(): View|RedirectResponse
    {
        if($this->auth->isLoggedIn()){
            return to_route('dashboard.index');
        }

        return view('auth.login');
    }

    public function login(): RedirectResponse
    {
        
    }
}
