<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = DB::table('audit_logs')
            ->orderBy('id','desc')
            ->paginate(15); // better for UI

        return view('admin.audit_logs.index', compact('logs'));

    }
}

