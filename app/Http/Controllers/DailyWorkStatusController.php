<?php

namespace App\Http\Controllers;
use App\Models\DailyWorkStatus;
use Illuminate\Http\Request;

class DailyWorkStatusController extends Controller
{
    public function index()
    {
        return view('dashboards.super-employee'); // مسار صفحة الفورم
    }

    public function store(Request $request)
{

    // التحقق من المدخلات
    $request->validate([
        'notes' => 'nullable|string',
    ]);

    // تخزين البيانات
    DailyWorkStatus::create([
        'user_id' => auth()->id(),
        'notes' => $request->notes,
        'date' => now()->toDateString(),
    ]);

    // إعادة توجيه مع رسالة نجاح
    return redirect()->back()->with('success', 'Work status recorded successfully.');
}


}
