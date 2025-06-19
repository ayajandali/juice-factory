<?php
namespace App\Models;
use App\Models\AvailableProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_name', 
        'description',
        'machine_id',
        'price',
        'image',
        'size',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }

    public function dailyWorkProducts()
    {
        return $this->hasMany(DailyWorkProduct::class);
    }

    public function availableProducts()
    {
        return $this->hasMany(\App\Models\AvailableProduct::class , 'product_id'); 
    }


    

}