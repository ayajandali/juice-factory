<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())->latest()->get();

        Notification::where('user_id', auth()->id())->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }
}
