<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Machine;;

class ProductController extends Controller
{
    public function index()
    {
        $products=Products::all();
        return view('dashboards.allproducts',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()-> role !=='Manager')
        {
            abort(403);
        }
        $machines=Machine::all();
        return view('dashboards.partials.add-product-form',compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
{
    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'machine_id' => 'required|exists:machines,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'size' => 'nullable|string|max:50',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
    }

    Products::create($validated);

    return redirect()->route('manager.product.index')->with('success', 'Product added successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $product=Products::findOrFail($id);
       $machines=Machine::all();
       return view('dashboards.partials.edit-product-form',compact('product','machines'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'machine_id' => 'required|exists:machines,id',
        'size' => 'required|in:small,medium,large',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'price' => 'required|numeric',
    ]);

    $product = Products::findOrFail($id);

    $data = $request->only([
        'product_name',
        'description',
        'price',
        'machine_id',
        'size',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $data['image'] = $imagePath;
    }

    $product->update($data);

    return redirect()->route('manager.product.index')->with('success', 'Product updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()-> route('manager.product.index')
        ->with('success','Product deleted successfully');
    }
}
