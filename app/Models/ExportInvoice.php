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
        'tax',
        'description',
        'user_id',
    ];


}
