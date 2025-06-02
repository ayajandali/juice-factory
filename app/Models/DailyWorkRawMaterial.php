<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyWorkRawMaterial extends Model
{
     protected $table = 'daily_work_raw_material';

    protected $fillable = ['daily_work_status_id', 'raw_material_id', 'quantity_used'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function workStatus()
    {
        return $this->belongsTo(DailyWorkStatus::class, 'daily_work_status_id');
    }
}
