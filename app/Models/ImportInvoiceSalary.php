<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportInvoiceSalary extends Model
{
    protected $table = 'import_invoice_salaries';
    protected $fillable = [
        'import_invoice_id',
        'user_id',
        'salary',
    ];

    // العلاقة مع جدول الفواتير
    public function importInvoice()
    {
        return $this->belongsTo(ImportInvoice::class);
    }

    // العلاقة مع جدول المستخدمين (الموظفين)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
