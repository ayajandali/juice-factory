<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $table = 'leaverequests';

    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'is_paid',
        'status',
    ];

    public $timestamps = false;
}

