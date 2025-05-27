<?php

namespace App\Http\Controllers;
use App\Models\LeaveRequest;
use App\Models\Notification;
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
            return view('dashboards.hr_leaverequests', compact('pendingRequests'));
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

        return back()->with('success', 'Your leave request has been accepted');
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

        return back()->with('success', 'Your leave request has been rejected');

    }


    public function approvedRequests()
    {
            $approvedRequests = LeaveRequest::with('user')->where('status', 'accepted')->latest()->get();
            return view('dashboards.hr_acceptedRequests', compact('approvedRequests'));
    }

    public function rejectedRequests()
    {
            $rejectedRequests = LeaveRequest::with('user')->where('status', 'refused')->latest()->get();
            return view('dashboards.hr_rejectedRequests', compact('rejectedRequests'));
    }

  
}
