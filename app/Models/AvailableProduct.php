<?php

namespace App\Models;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;

class AvailableProduct extends Model
{
    protected $table = 'available_products';

    protected $fillable = ['product_id', 'quantity' , 'production_date' , 'expiry_date'];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');

    }

}
