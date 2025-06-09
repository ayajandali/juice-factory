<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyWorkProduct extends Model
{
     protected $table = 'daily_work_product';

    protected $fillable = ['daily_work_status_id', 'product_id', 'quantity_produced'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function workStatus()
    {
        return $this->belongsTo(DailyWorkStatus::class, 'daily_work_status_id');
    }
}
