<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_logs';

    // ⬅ allow mass assignment to avoid your error
    protected $fillable = [
        'user_id',
        'role',
        'action',
        'description',
        'ip_address',
    ];

    public $timestamps = true; // created_at & updated_at auto handled
}
