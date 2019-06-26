<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index')
            ->withNotifications(Notification::simplePaginate(25));
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->status = 1;
        $notification->save();

        return redirect($notification->link);
    }
}
