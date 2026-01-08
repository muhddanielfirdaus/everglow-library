<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    protected $timeout = 1800; // 30 minutes idle timeout

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            if (time() - session('last_activity') > $this->timeout) {
                Auth::logout();
                session()->flush();
                return redirect('/login')->with('error','Session expired. Please login again.');
            }

            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
