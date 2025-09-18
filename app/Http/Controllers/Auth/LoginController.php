<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login sesuai role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role ?? null;

        return match ($role) {
            'admin' => '/admin/dashboard',
            'guru'  => '/guru/dashboard',
            'kepsek'=> '/kepsek/dashboard',
            default => '/home',
        };
    }

    /**
     * Tampilkan form login.
     * Logout otomatis jika user masih login agar tidak ter-redirect ke /redirect.
     */
    public function showLoginForm()
    {
        if (auth()->check()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        return view('auth.login');
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
