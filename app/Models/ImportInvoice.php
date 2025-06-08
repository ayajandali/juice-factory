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
        'type',
        'description',
        'user_id',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ImportInvoiceItem::class);
    }

    public function salaries()
    {
        return $this->hasMany(ImportInvoiceSalary::class);
    }

}
