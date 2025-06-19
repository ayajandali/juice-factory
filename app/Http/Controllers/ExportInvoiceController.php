<?php

namespace App\Http\Controllers;
use App\Models\ExportInvoice;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\AvailableProduct;


class ExportInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = AvailableProduct::with('product')->get();
        return view('accountant.export' , compact('products'));
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

        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:available_products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // تحقق من توفر الكميات المطلوبة في جدول available_products
        foreach ($request->products as $productData) {
            $availableQuantity = \DB::table('available_products')
                ->where('id', $productData['product_id'])
                ->value('quantity'); 
            if ($availableQuantity === null || $availableQuantity < $productData['quantity']) {
                return redirect()->back()->withErrors("Quantity isn't available for {$productData['product_id']}");
            }
        }

        // إذا الكميات متوفرة، ننشئ الفاتورة
        $invoice = ExportInvoice::create([
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'total_amount' => $request->total_amount,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        // تخزين كل منتج مع تحديث الكميات في available_products
        foreach ($request->products as $productData) {
            $price = $productData['price'];
            $quantity = $productData['quantity'];
            $subtotal = $price * $quantity;

            $availableProduct = AvailableProduct::find($productData['product_id']);
            $P_id = $availableProduct->product_id;


            $invoice->items()->create([
                'available_product_id' => $productData['product_id'],
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal,
            ]);

            // تحديث كمية المنتج في جدول available_products
            \DB::table('available_products')
                ->where('id', $productData['product_id'])
                ->decrement('quantity', $quantity);

        }

        return redirect()->back()->with('status', 'Invoice created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $invoices = ExportInvoice::latest()->paginate(10);
        return view('accountant.export_list' , compact('invoices'));
    }

    /**
     * Invoice details page 
     */
    public function Detail(ExportInvoice $invoice)
    {
        // جلب بيانات الفاتورة مع المنتجات المرتبطة
        $invoice->load('items.product', 'user'); 
        return view('accountant.export_details', compact('invoice'));
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
    public function destroy($id)
    {
        $invoice = ExportInvoice::with('items.product')->findOrFail($id);

        foreach ($invoice->items as $item) {
            $productId = $item->available_product_id;
            $quantity = $item->quantity;

            // نحاول نلاقي المنتج في جدول available_products
            $availableProduct = AvailableProduct::where('id', $productId)->first();
        
            //  نزيد الكمية
            $availableProduct->quantity += $quantity;
            $availableProduct->save();
            
            }

            // نحذف الفاتورة وبنودها
            $invoice->items()->delete();
            $invoice->delete();

            return redirect()->back()->with('export_delete', 'Invoice deleted and stock updated successfully.');
        }

}
