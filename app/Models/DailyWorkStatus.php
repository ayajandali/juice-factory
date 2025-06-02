<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorkStatus extends Model
{

    use HasFactory;
    protected $table = 'daily_work_statuses';
    public $timestamps = false;

    protected $fillable = ['user_id' , 'notes'];

    public function rawMaterials()
    {
        return $this->hasMany(DailyWorkRawMaterial::class);
    }

    public function products()
    {
        return $this->hasMany(DailyWorkProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
