<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';

    protected $fillable = [
        'name', 
        'status',
        'last_maintenance_date',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'machine_id');
    }

}
