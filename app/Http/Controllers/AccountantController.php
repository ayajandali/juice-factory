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
        

        return view('dashboards.accountant', [
            'importCount'       => $importCount,
            'exportCount'       => $exportCount,
        ]);
    }
}
