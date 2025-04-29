<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportInvoice;
use App\Models\ExportInvoice;

class AccountantController extends Controller
{
    public function index()
    {
        $importCount = ImportInvoice::count();
        $exportCount = ExportInvoice::count();
        $lastInvoice = ImportInvoice::latest()->first();

        return view('dashboards.accountant', [
            'importCount'       => $importCount,
            'exportCount'       => $exportCount,
            'lastInvoiceNumber' => $lastInvoice?->invoice_number,
            'lastInvoiceDate'   => $lastInvoice?->created_at?->format('d M Y'),
        ]);
    }
}
