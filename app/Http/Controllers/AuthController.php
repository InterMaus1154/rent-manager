<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $auth, private LoggerInterface $logger)
    {
    }

    public function loginView(): View|RedirectResponse
    {
        if($this->auth->isLoggedIn()){
            return to_route('dashboard.index');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $result = $this->auth->attempt($validated);

        $success = $result['success'];
        $message = $result['message'];
        $user = $result['user'] ?? null;

        if(! $success) {
            $this->logger->info($message);
            return redirect()->back()->withErrors(['login_invalid' => 'Invalid credentials']);
        }

        if($user) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors(['login_invalid' => 'Invalid credentials']);
    }

    public function logout(): RedirectResponse
    {
        $this->auth->logout();
        return redirect()->intended('/');
    }
}
