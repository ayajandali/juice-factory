<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorkStatus extends Model
{

    use HasFactory;
    protected $table = 'daily_work_statuses';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'work_status',
        'notes',
        'date',
    ];
    
}
