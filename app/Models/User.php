<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Specify the custom table name
    protected $table = 'user';  // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'birth_date', 'gender', 'role',
        'phone', 'address', 'salary','machine_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',  // Cast birth_date as a date
            'start_date' => 'date',  // Cast start_date as a date
            'salary' => 'float',      // Cast salary as a float
        ];
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id'); // Define the relationship
    }
}
