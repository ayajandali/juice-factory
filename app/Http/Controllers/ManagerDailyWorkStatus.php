<?php

namespace App\Http\Controllers;
use App\Models\DailyWorkStatus;
use App\Models\Products;
use App\Models\DailyWorkProduct;
use App\Models\DailyWorkRawMaterial;
use App\Models\AvailableProduct;
use Illuminate\Http\Request;

class ManagerDailyWorkStatus extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyworkstatus=DailyWorkStatus::latest()->paginate(10);
        return view('dashboards.alldailyworkstatus',compact('dailyworkstatus'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $status = DailyWorkStatus::with([
            'user',
            'rawMaterials.rawMaterial',
            'products.product.availableProducts' // نجيب المنتج مع available_products
        ])->findOrFail($id);

        return view('dashboards.partials.dailyworkstatus_show', compact('status'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
