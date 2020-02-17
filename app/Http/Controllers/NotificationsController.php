<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function markAsRead()
    {
        \Auth::user()->unreadNotifications->markAsRead();
        Auth::user()

        return response(null, 200);
    }
}
