<?php

namespace App\Http\Controllers;
use App\Models\ImportInvoice;
use Illuminate\Http\Request;

class ImportInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('accountant.import');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'invoice_number' => 'required|string|max:255|unique:export_invoice',
            'date' => 'required|date',
            'total_amount' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'type' => 'required|in:raw materials,salary,maintanance', 
            'description' => 'nullable|string',
        ]);

        // حفظ البيانات في قاعدة البيانات
        $invoice = ImportInvoice::create([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'total_amount' => $request->total_amount,
            'tax' => $request->tax ?? 0, // إذا كان tax فارغ نضع 0
            'type' => $request->type,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('accountant.import')->with('import_status', 'Invoice recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $invoices = ImportInvoice::latest()->paginate(10);
        return view('accountant.import_list' , compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = ImportInvoice::findOrFail($id);
        return view('accountant.import_edit', compact('invoice'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = ImportInvoice::findOrFail($id);
        $invoice->update($request->all());
    
        return redirect()->route('import.all.invoice')->with('invoice_update', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = ImportInvoice::findOrFail($id);
        $invoice->delete();
    
        return redirect()->route('import.all.invoice')->with('import_delete', 'Invoice deleted successfully!');
    }
}
