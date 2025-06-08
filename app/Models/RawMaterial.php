<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $table = 'raw_materials';

    protected $fillable = ['name', 'type' , 'size' , 'quantity', 'unit'];

    public function dailyWorkRawMaterials()
    {
        return $this->hasMany(DailyWorkRawMaterial::class);
    }


    public function importItems()
    {
        return $this->hasMany(ImportInvoiceItem::class);
    }

}
