<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperEmployeeController extends Controller
{
    public function index()
    {
        return view('dashboards.super-employee');
    }
}
