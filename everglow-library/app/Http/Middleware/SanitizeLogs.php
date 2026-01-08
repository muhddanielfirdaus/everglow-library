<?php

namespace App\Http\Middleware;

use Closure;

class SanitizeLogs
{
    public function handle($request, Closure $next)
    {
        // Remove sensitive data before logging
        if ($request->has('password')) {
            $request->merge(['password' => '[REDACTED]']);
        }

        return $next($request);
    }
}
