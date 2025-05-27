<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Products extends Model
{
    protected $fillable = [
        'product_name', 
        'description',
        'production_date',
        'expiry_date',
        'quantity',
        'machine_id',
        'image',
        'size',
    ];

  public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
}