<?php

namespace App\Http\Controllers;
use App\Models\DailyWorkStatus;
use Illuminate\Http\Request;
use App\Models\RawMaterial;
use App\Models\Products;
use App\Models\DailyWorkRawMaterial;
use App\Models\DailyWorkProduct;
use App\Models\AvailableProduct;
use Illuminate\Support\Facades\DB;


class DailyWorkStatusController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        // ✅ التحقق من المدخلات
        $request->validate([
            'notes' => 'nullable|string',
            'raw_materials' => 'required|array|min:1',
            'raw_materials.*.id' => 'required|exists:raw_materials,id',
            'raw_materials.*.quantity' => 'required|numeric|min:1',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.expiry_date' => 'date|after_or_equal:today',  
        ]);


        foreach ($request->raw_materials as $item) {
                $material = RawMaterial::find($item['id']);

                if ($item['quantity'] > $material->quantity) {
                    // يرجع مع حفظ البيانات المدخلة (old input) ورسالة خطأ مخصصة
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['raw_materials' => 'The quantity used for ' . $material->name . ' exceeds available stock.']);
                }
        }




        DB::transaction(function () use ($request) {

            // 1. إنشاء سجل daily_work_status
            $status = DailyWorkStatus::create([
                'user_id' => auth()->id(),
                'date' => now()->toDateString(),
                'notes' => $request->notes,
            ]);

            // 2. تخزين المواد الخام المستخدمة
            foreach ($request->raw_materials as $material) {
                DailyWorkRawMaterial::create([
                    'daily_work_status_id' => $status->id,
                    'raw_material_id' => $material['id'],
                    'quantity_used' => $material['quantity'],
                ]);

                // تحديث الكمية من جدول raw_materials
                $raw = RawMaterial::find($material['id']);
                $raw->quantity -= $material['quantity'];
                $raw->save();
            }

            // 3. تخزين المنتجات المصنعة
            foreach ($request->products as $product) {
                DailyWorkProduct::create([
                    'daily_work_status_id' => $status->id,
                    'product_id' => $product['id'],
                    'quantity_produced' => $product['quantity'],
                ]);

                // تحديث أو إنشاء المنتج في جدول available_products
                $available = AvailableProduct::firstOrNew(['product_id' => $product['id']]);
                $available->quantity = ($available->quantity ?? 0) + $product['quantity'];
                $available->production_date = now()->toDateString(); 
                $available->expiry_date = $product['expiry_date'] ?? $available->expiry_date;
                $available->save();
            }
        });

        return redirect()->back()->with('success', 'Work status recorded successfully.');
    }



}
