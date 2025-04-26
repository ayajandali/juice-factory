<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::where('user_id', auth()->id())->get();
        return view('dashboards.requests' , compact('leaveRequests'));
    }

    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_paid' => 'required',
        ]);

        // التحقق إذا كان هناك طلب إجازة بنفس التاريخ
        $existingLeaveRequest = LeaveRequest::where('user_id', auth()->id())
            ->where('start_date', $request->start_date)
            ->exists();

        if ($existingLeaveRequest) {
            // إذا كان هناك طلب إجازة بنفس التاريخ، ارجع برسالة خطأ
            return back()->withErrors(['start_date' => 'You already have a leave request for this start date.'])->withInput();
        }

        // إذا لم يكن هناك طلب مكرر، يتم تخزين الطلب
        LeaveRequest::create([
            'user_id' => auth()->id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_paid' => $request->is_paid,
        ]);

        return redirect()->back()->with('leave_success', 'Leave request submitted successfully.');
    }
}
