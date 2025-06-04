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

class SuperEmployeeController extends Controller
{
    public function index()
    {
        $rawMaterials = RawMaterial::all();
        $products = Products::all();

        return view('dashboards.super-employee', compact('rawMaterials', 'products'));
    }
}
