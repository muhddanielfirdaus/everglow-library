<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display registration form
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Register new user
     */
    public function store(Request $request): RedirectResponse
    {
        // Secure Validation (OWASP Password Standard)
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',                       // length must be >= 8
                'regex:/[A-Z]/',               // at least one uppercase
                'regex:/[a-z]/',               // at least one lowercase
                'regex:/[0-9]/',               // at least one number
                'regex:/[@$!%*#?&]/'           // at least one symbol
            ],
        ], [
            'name.regex' => 'Name may only contain letters and spaces.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must include uppercase, lowercase, number & symbol.',
        ]);

        // Create user safely
        $user = User::create([
            'name' => e($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        event(new Registered($user));

        // 🔥 Do NOT auto login → redirect to Login page instead
        return redirect()
            ->route('login')
            ->with('success', 'Registration successful! Please login.');
    }
}
