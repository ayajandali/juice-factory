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
    // التحقق من وجود حالة عمل بنفس التاريخ
    $existingWorkStatus = DailyWorkStatus::where('date', $request->date)
                                         ->where('user_id', auth()->id()) // تأكد من أنه للمستخدم نفسه
                                         ->exists();

    if ($existingWorkStatus) {
        // إذا كان هناك حالة عمل بنفس التاريخ، ارجع برسالة خطأ
        return back()->withErrors(['date_duplicate' => 'You already have a work status recorded for this date.'])->withInput();
    }

    // التحقق من المدخلات
    $request->validate([
        'work_status' => 'required|in:Completed,Pending,Delayed',
        'notes' => 'nullable|string',
        'date' => 'required|date|after_or_equal:today', // تحقق من أن التاريخ لا يكون في الماضي
    ], [
        'date.after_or_equal' => 'The date cannot be in the past.',
        'date.date' => 'The date must be a valid date.',
    ]);

    // تخزين البيانات
    DailyWorkStatus::create([
        'user_id' => auth()->id(),
        'work_status' => $request->work_status,
        'notes' => $request->notes,
        'date' => $request->date,
    ]);

    // إعادة توجيه مع رسالة نجاح
    return redirect()->back()->with('success', 'Work status recorded successfully.');
}


}
