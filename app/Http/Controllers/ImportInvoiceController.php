<?php

namespace App\Http\Controllers;
use App\Models\ImportInvoice;
use App\Models\RawMaterial;
use App\Models\ImportInvoiceItem;
use App\Models\ImportInvoiceSalary;
use App\Models\User;
use Illuminate\Http\Request;

class ImportInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexSalary()
    {
        $users = User::all();

        return view('accountant.import_salary' , compact('users'));
    }

    public function indexRaw()
    {
         $rawMaterials = RawMaterial::select('id', 'name')->distinct()->get();
         return view('accountant.import_raw' , compact('rawMaterials'));
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
    public function storeSalary(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',


            'salaries' => 'required_if:type,salary|array',
            'salaries.*.user_id' => 'required_if:type,salary|exists:user,id',
            'salaries.*.salary' => 'required_if:type,salary|numeric|min:0',
        ]);

        $totalAmount = 0;
        foreach ($request->salaries as $salaryData) {
            $totalAmount += $salaryData['salary'];
        }

        $invoice_type = 'salary';
        // إنشاء الفاتورة الواردة
        $importInvoice = ImportInvoice::create([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'description' => $request->description,
            'type' => $invoice_type,
            'total_amount'=>$totalAmount,
            'user_id' => auth()->id(),
        ]);

        
        foreach ($request->salaries as $salaryData) {
            ImportInvoiceSalary::create([
                'import_invoice_id' => $importInvoice->id,
                'user_id' => $salaryData['user_id'],
                'salary' => $salaryData['salary'],
            ]);
        }
        

        return redirect()->back()->with('success', 'Invoice added successfully!');
    }

    public function storeRaw()
    {
        $request->validate([

            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',

            'materials' => 'required|array',
            'materials.*.name' => 'required|string',
            'materials.*.quantity' => 'required|numeric|min:1',
            'materials.*.size' => 'nullable|in:small,medium,large',
            'materials.*.unit' => 'required|string',
            'materials.*.price' => 'required|numeric|min:0',
            'materials.*.subtotal' => 'nullable|numeric|min:0',
        ]);

        $request->validate([
            'materials' => 'required|array|min:1',
            'materials.*.name' => 'required|string|exists:raw_materials,name',
            'materials.*.quantity' => 'required|numeric|min:1',
            'materials.*.unit' => 'required|in:kg,piece',
        ]);

        $totalAmount = 0;
        foreach ($request->materials as $material) {
            $subtotal = $material['subtotal'] ?? ($material['price'] * $material['quantity']);
            $totalAmount += $subtotal;
        }

        $invoice_type = 'raw materials';
        // إنشاء الفاتورة الواردة
        $importInvoice = ImportInvoice::create([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'description' => $request->description,
            'type' => $invoice_type,
            'total_amount'=>$totalAmount,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->materials as $material) {
            // إضافة العنصر إلى جدول import_invoice_items
            $rawMaterial = RawMaterial::where('name', $material['name'])->first();
            if($rawMaterial){
                //dd($material);
                ImportInvoiceItem::create([
                'import_invoice_id' => $importInvoice->id,
                'raw_material_id' => $rawMaterial->id,
                'name' => $material['name'],
                'size' => $material['size'],
                'quantity' => $material['quantity'],
                'unit' => $material['unit'],
                'price' => $material['price'],
                'subtotal' => $material['subtotal'] ?? ($material['price'] * $material['quantity']),
            ]);

            // تحديث الكمية في جدول raw_materials
                $rawMaterial->quantity += $material['quantity'];
                $rawMaterial->save();
            
            }
            
        }

        return redirect()->back()->with('success', 'Invoice added successfully!');
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
