<?php

namespace App\Http\Controllers;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::where('user_id', auth()->id())->latest()->paginate(5);
        return view('dashboards.requests' , compact('leaveRequests'));
    }

    public function store(Request $request)
{
    // التحقق من المدخلات
    $request->validate([
        'leave_type' => 'required|string',
        'date_range' => 'required|string',
        'is_paid' => 'required',
    ]);

    // فصل تاريخ البداية والنهاية من حقل التاريخ الواحد
    $range = explode(" to ", $request->date_range);
    $start_date = $range[0];
    $end_date = isset($range[1]) ? $range[1] : $range[0]; // إذا اختار يوم واحد فقط

    // التحقق من الصيغة الصحيحة للتواريخ
    if (!strtotime($start_date) || !strtotime($end_date)) {
        return back()->withErrors(['date_range' => 'Invalid date format.'])->withInput();
    }

    // التحقق من أن التواريخ لا تقع في الماضي
    if ($start_date < date('Y-m-d')) {
        return back()->withErrors(['date_range' => 'Start date cannot be in the past.'])->withInput();
    }

    // التحقق إذا كان هناك طلب إجازة بنفس تاريخ البداية
    $existingLeaveRequest = LeaveRequest::where('user_id', auth()->id())
        ->where('start_date', $start_date)
        ->exists();

    if ($existingLeaveRequest) {
        return back()->withErrors(['date_range' => 'You already have a leave request for this start date.'])->withInput();
    }

    // حفظ الطلب
    LeaveRequest::create([
        'user_id' => auth()->id(),
        'leave_type' => $request->leave_type,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'is_paid' => $request->is_paid,
    ]);

    return redirect()->back()->with('leave_success', 'Leave request submitted successfully.');
}

}
