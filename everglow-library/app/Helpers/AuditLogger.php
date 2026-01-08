<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogger
{
    /**
     * Secure Audit Logging (OWASP ASVS V7)
     * Logs actions without sensitive information.
     */
    public static function log($action, $description = null)
    {
        // 🔐 Sanitize description before saving
        $description = self::sanitize($description);

        AuditLog::create([
            'user_id'    => Auth::id(),
            'role'       => Auth::check() ? (Auth::user()->role ?? 'user') : 'guest',
            'action'     => $action,
            'description'=> $description,
            'ip_address' => Request::ip(),
        ]);
    }

    /**
     * Remove sensitive data if detected
     */
    private static function sanitize($text)
    {
        if(!$text) return null;

        return preg_replace([
            '/password\s*=\s*.*/i',
            '/email\s*=\s*.*/i',
        ], [
            'password=[MASKED]',
            'email=[MASKED]',
        ], $text);
    }
}
