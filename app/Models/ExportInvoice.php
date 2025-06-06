<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportInvoice extends Model
{
    use HasFactory;
    protected $table = 'export_invoice';

    protected $fillable = [
        'invoice_number',
        'date',
        'total_amount',
        'description',
        'user_id',
    ];


    public function items()
    {
        return $this->hasMany(ExportInvoiceItem::class, 'export_invoice_id');
    }

}
