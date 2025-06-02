<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableProduct extends Model
{
    protected $table = 'available_products';

    protected $fillable = ['product_id', 'quantity' , 'production_date' , 'expiry_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
