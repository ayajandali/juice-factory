<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
