<?php

namespace App\Models;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailableProduct extends Model
{
    protected $table = 'available_products';

    protected $fillable = ['product_id', 'quantity' , 'production_date' , 'expiry_date'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class , 'product_id');
    }

    public function invoiceItems()
    {
        return $this->hasMany(ExportInvoiceItem::class , 'available_product_id');
    }

}
