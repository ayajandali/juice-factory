<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
