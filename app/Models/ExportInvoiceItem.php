<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportInvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'export_invoice_items';

    protected $fillable = [
        'export_invoice_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function exportInvoice()
    {
         return $this->belongsTo(ExportInvoice::class, 'export_invoice_id');
    }
}
