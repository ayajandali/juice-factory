<?php

namespace App\Http\Controllers;
use App\Models\ExportInvoice;
use Illuminate\Http\Request;

class ExportInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('accountant.export');
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
            'description' => 'nullable|string',
        ]);

        // حفظ البيانات في قاعدة البيانات
        $invoice = ExportInvoice::create([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'total_amount' => $request->total_amount,
            'tax' => $request->tax ?? 0, // إذا كان tax فارغ نضع 0
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('accountant.export')->with('status', 'Invoice recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $invoices = ExportInvoice::all();
        return view('accountant.export_list' , compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = ExportInvoice::findOrFail($id);
        return view('accountant.export_edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = ExportInvoice::findOrFail($id);
        $invoice->update($request->all());
    
        return redirect()->route('export.all.invoice')->with('export_update', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
