<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';  

    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'birth_date', 'gender', 'role',
        'phone', 'address', 'salary','machine_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',
            'start_date' => 'date',
            'salary' => 'float',
        ];
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }

    public function salaryInvoices()
    {
        return $this->hasMany(ImportInvoiceSalary::class);
    }

}
