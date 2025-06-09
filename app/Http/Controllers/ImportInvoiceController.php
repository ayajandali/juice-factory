<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

    public function storeRaw(Request $request)
    {
         $validated = $request->validate([

            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'materials' => 'required|array|min:1',
            'materials.*.material_id' => 'required|exists:raw_materials,id',
            'materials.*.size' => 'nullable|in:small,medium,large',
            'materials.*.quantity' => 'required|numeric|min:0',
            'materials.*.unit' => 'required|in:kg,piece',
            'materials.*.price' => 'required|numeric|min:0',
            ]);


        $totalAmount = 0;
        foreach ($validated['materials'] as $material) {
            $totalAmount += $material['quantity'] * $material['price'];
        }

        $invoice_type = 'raw materials';
         // إنشاء الفاتورة
        $invoice = ImportInvoice::create([
            'invoice_number' => $validated['invoice_number'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'type' => $invoice_type, 
            'total_amount' => $totalAmount,
            'user_id'=>auth()->id(),
        ]);

        

            // حفظ تفاصيل المواد الخام
            foreach ($validated['materials'] as $material) {
                ImportInvoiceItem::create([
                    'import_invoice_id' => $invoice->id,
                    'raw_material_id' => $material['material_id'],
                    'size' => $material['size'],
                    'quantity' => $material['quantity'],
                    'unit' => $material['unit'],
                    'price' => $material['price'],
                    'subtotal' => $material['quantity'] * $material['price'],
                ]);
            

            // تحديث الكمية في جدول raw_materials
                $rawMaterial = RawMaterial::find($material['material_id']);
                $rawMaterial->quantity += $material['quantity'];
                $rawMaterial->save();

            }
            
            

        return redirect()->back()->with('success', 'Invoice added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $salaryInvoices = ImportInvoice::where('type', 'salary')->latest()->get();
        $rawMaterialInvoices = ImportInvoice::where('type', 'raw materials')->latest()->get();
        return view('accountant.import_list' , compact('salaryInvoices' , 'rawMaterialInvoices'));
    }

    public function details($id)
    {
        $invoice = ImportInvoice::with('salaries.user')->findOrFail($id);
        return view('accountant.salary_invoices_detail', compact('invoice'));
    }

    public function rawDetails($id)
    {
        $invoice = ImportInvoice::with(['items.rawMaterial']) 
                ->where('type', 'raw materials')
                ->findOrFail($id);

        return view('accountant.raw_invoices_detail', compact('invoice'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = ImportInvoice::with('salaries.user')->findOrFail($id);
        $users = User::all();
        return view('accountant.import_edit', compact('invoice' , 'users'));

    }

    public function rawEdit(string $id)
    {
           $invoice = ImportInvoice::with('items.rawMaterial')->findOrFail($id);
            $rawMaterials = RawMaterial::all(); 

            return view('accountant.import_rawEdit', compact('invoice', 'rawMaterials'));
    }

public function rawUpdate(Request $request, $id)
{
    $request->validate([
        'invoice_number' => 'required|string',
        'date' => 'required|date',
        'description' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.raw_material_id' => 'required|exists:raw_materials,id',
        'items.*.quantity' => 'required|numeric|min:0',
        'items.*.unit' => 'required|string',
        'items.*.price' => 'required|numeric|min:0',
        'items.*.id' => 'nullable|exists:import_invoice_items,id',
    ]);

    DB::transaction(function () use ($request, $id) {
        $invoice = ImportInvoice::findOrFail($id);

        // تحديث بيانات الفاتورة الأساسية
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'date'           => $request->date,
            'description'    => $request->description,
        ]);

        $itemsData = $request->items;
        $submittedIds = collect($itemsData)->pluck('id')->filter()->all();

        // 1) حذف العناصر التي أُلغيت في الفورم
        $toDelete = $invoice->items()->whereNotIn('id', $submittedIds)->get();
        foreach ($toDelete as $oldItem) {
            // إنقاص الكمية من جدول raw_materials
            $material = RawMaterial::findOrFail($oldItem->raw_material_id);
            $material->quantity -= $oldItem->quantity;
            $material->save();
            $oldItem->delete();
        }

        $totalAmount = 0;

        // 2) تحديث العناصر الموجودة وإضافة الجديدة
        foreach ($itemsData as $itemData) {
            $qty  = $itemData['quantity'];
            $price= $itemData['price'];
            $subtotal = $qty * $price;
            $totalAmount += $subtotal;

            if (!empty($itemData['id'])) {
                // موجود: حدثّي وكيّفي الكمية في المخزون
                $item     = ImportInvoiceItem::findOrFail($itemData['id']);
                $oldQty   = $item->quantity;
                $item->update([
                    'raw_material_id' => $itemData['raw_material_id'],
                    'quantity'        => $qty,
                    'unit'            => $itemData['unit'],
                    'price'           => $price,
                    'subtotal'        => $subtotal,
                ]);
                $diff = $qty - $oldQty;
                $material = RawMaterial::findOrFail($itemData['raw_material_id']);
                $material->quantity += $diff;
                $material->save();
            } else {
                // جديد: أنشئي العنصر وزوّدي الكمية في المخزون
                $new = $invoice->items()->create([
                    'raw_material_id' => $itemData['raw_material_id'],
                    'quantity'        => $qty,
                    'unit'            => $itemData['unit'],
                    'price'           => $price,
                    'subtotal'        => $subtotal,
                ]);
                $material = RawMaterial::findOrFail($itemData['raw_material_id']);
                $material->quantity += $qty;
                $material->save();
            }
        }

        // 3) حفظ المجموع الكلي بعد تعديل كل العناصر
        $invoice->update(['total_amount' => $totalAmount]);
    });

    return redirect()
        ->route('import.all.invoice', $id)
        ->with('success', 'Invoice updated successfully!');
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'salaries' => 'required|array|min:1',
            'salaries.*.user_id' => 'required|exists:user,id',
            'salaries.*.salary' => 'required|numeric|min:0',
            'salaries.*.id' => 'nullable|exists:import_invoice_salaries,id',
        ]);

        // تحديث بيانات الفاتورة الأساسية
        $invoice = ImportInvoice::findOrFail($id);
        $invoice->invoice_number = $request->invoice_number;
        $invoice->date = $request->date;
        $invoice->description = $request->description;

        // IDs الموجودين في الطلب (لتحديد من يجب حذفه)
        $submittedSalaryIds = collect($request->salaries)->pluck('id')->filter()->all();

        // حذف الموظفين الغير موجودين في الطلب
        ImportInvoiceSalary::where('import_invoice_id', $invoice->id)
            ->whereNotIn('id', $submittedSalaryIds)
            ->delete();

        $totalAmount = 0;

        // تحديث أو إضافة الموظفين + حساب المجموع
        foreach ($request->salaries as $salaryData) {
            if (!empty($salaryData['id'])) {
                // تحديث سجل موجود
                $entry = ImportInvoiceSalary::findOrFail($salaryData['id']);
                $entry->user_id = $salaryData['user_id'];
                $entry->salary = $salaryData['salary'];
                $entry->save();
            } else {
                // إضافة سجل جديد
                $entry = ImportInvoiceSalary::create([
                    'import_invoice_id' => $invoice->id,
                    'user_id' => $salaryData['user_id'],
                    'salary' => $salaryData['salary'],
                ]);
            }

            $totalAmount += $salaryData['salary'];
        }

        // تحديث قيمة total_amount في الفاتورة
        $invoice->total_amount = $totalAmount;
        $invoice->save();

        return redirect()->route('import.all.invoice')
                        ->with('success', 'Salary invoice updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoice = ImportInvoice::findOrFail($id);

        // حذف الرواتب المرتبطة أولاً
        $invoice->salaries()->delete();

        // ثم حذف الفاتورة نفسها
        $invoice->delete();

        return redirect()->route('import.all.invoice')
            ->with('success', 'Salary invoice deleted successfully.');
    }

    public function rawDestroy($id)
    {
            DB::transaction(function () use ($id) {
            $invoice = ImportInvoice::findOrFail($id);

            // استرجاع العناصر المرتبطة بالفاتورة
            $items = $invoice->items;

            foreach ($items as $item) {
                // خصم الكمية من جدول المواد الخام
                $material = RawMaterial::findOrFail($item->raw_material_id);
                $material->quantity -= $item->quantity;
                $material->save();

                // حذف العنصر من جدول import_invoice_items
                $item->delete();
            }

            // حذف الفاتورة نفسها
            $invoice->delete();
        });

        return redirect()->route('import.all.invoice')
            ->with('success', 'Raw materials invoice deleted successfully!');

    }

}
