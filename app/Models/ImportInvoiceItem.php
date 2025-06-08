<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportInvoiceItem extends Model
{
    protected $fillable = ['import_invoice_id', 'raw_material_id', 'quantity', 'unit', 'price' , 'subtotal'];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(ImportInvoice::class, 'import_invoice_id');
    }

    public function rawMaterial(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }
}
