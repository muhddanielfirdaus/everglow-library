<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Helpers\AuditLogger;   // ← LOG
use Illuminate\Support\Facades\RateLimiter;  // ← NEW
use Illuminate\Support\Str;                  // ← NEW

class AuthenticatedSessionController extends Controller
{
    /**
     * Display login page
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login authentication
     * 🚨 Brute Force Protection Added Below
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // ---------------------- 🔥 Brute Force Protection Start ----------------------
        $this->checkRateLimit($request);  // Limit attempts before authenticate
        // ---------------------------------------------------------------------------

        // Attempt login
        try {
            $request->authenticate();
        } catch (\Exception $e) {
            RateLimiter::hit($this->rateKey($request), 60); // count failed attempt for 60 sec

            AuditLogger::log('LOGIN_FAILED', "Failed login attempt"); // log failed login
            return back()->withErrors(['email' => 'Invalid credentials. Try again.']);
        }

        RateLimiter::clear($this->rateKey($request)); // reset attempts after success
        $request->session()->regenerate();

        $user = auth()->user();

        AuditLogger::log('LOGIN_SUCCESS', "User logged in");  // ← LOG SUCCESS

        // If admin login → go admin dashboard
        if ($user->role === 'admin') {
            session([
                'admin_logged_in' => true,
                'admin_username'  => $user->name
            ]);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard'); // normal user
    }

    // ================= 🔐 Brute Force Protection Functions ==================

    private function rateKey(Request $request)
    {
        return Str::lower($request->email) . '|' . $request->ip();
    }

    private function checkRateLimit(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->rateKey($request), 5)) { // max 5 attempts
            $seconds = RateLimiter::availableIn($this->rateKey($request));

            AuditLogger::log('LOGIN_LOCKOUT', "Too many attempts — Locked $seconds sec");

            abort(429,"Too many attempts. Try again after $seconds seconds."); 
        }

        RateLimiter::hit($this->rateKey($request), 60); // per 60 seconds
    }

    /**
     * Logout session
     */
    public function destroy(Request $request): RedirectResponse
    {
        AuditLogger::log('LOGOUT', "User logged out"); // LOG

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
