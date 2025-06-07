<?php
namespace App\Models;
use App\Models\availableProduct;
use Illuminate\Database\Eloquent\Model;
class Products extends Model
{
    protected $fillable = [
        'product_name', 
        'description',
        'machine_id',
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

    public function availableProduct()
    {
        return $this->hasOne(AvailableProduct::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(ExportInvoiceItem::class , 'product_id');
    }

}