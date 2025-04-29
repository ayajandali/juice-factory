<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportInvoice extends Model
{
    use HasFactory;
    protected $table = 'import_invoice';

    protected $fillable = [
        'invoice_number',
        'date',
        'total_amount',
        'tax',
        'type',
        'description',
        'user_id',
    ];
}
