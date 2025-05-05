<?php

namespace App\Http\Controllers;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HrleaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
            $pendingRequests = LeaveRequest::with('user')->where('status', 'pending')->latest()->get();
            $approvedRequests = LeaveRequest::with('user')->where('status', 'accepted')->latest()->get();
            $rejectedRequests = LeaveRequest::with('user')->where('status', 'refused')->latest()->get();
        
            return view('dashboards.hr_leaverequests', compact('pendingRequests', 'approvedRequests', 'rejectedRequests'));
    }

    public function approve($id)
{
    $leave = LeaveRequest::findOrFail($id);
    $leave->status = 'accepted';
    $leave->save();

    Notification::create([
        'user_id' => $leave->user_id,
        'message' => 'Your leave request has been accepted',
    ]);

    return back()->with('success', 'تم قبول الطلب.');
}

public function reject($id)
{
    $leave = LeaveRequest::findOrFail($id);
    $leave->status = 'refused';
    $leave->save();

    Notification::create([
        'user_id' => $leave->user_id,
        'message' => 'Your leave request has been rejected',
    ]);

    return back()->with('success', 'تم رفض الطلب.');
}
  
}
