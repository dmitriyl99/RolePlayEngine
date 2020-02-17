<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function markAsRead()
    {
        \Auth::user()->unreadNotifications->markAsRead();

        return response(null, 200);
    }
}
