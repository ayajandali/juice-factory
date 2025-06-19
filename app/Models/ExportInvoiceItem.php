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
        'available_product_id',
        'quantity',
        'price',
        'subtotal',
    ];


    public function product()
    {
        return $this->belongsTo(AvailableProduct::class, 'available_product_id');
    }


    public function exportInvoice()
    {
         return $this->belongsTo(ExportInvoice::class, 'export_invoice_id');
    }
}
