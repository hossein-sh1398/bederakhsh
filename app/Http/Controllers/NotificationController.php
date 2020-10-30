<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;
use App\User;

class NotificationController extends Controller
{
    public function email()
    {
        $user = User::find(39);
        Notification::send([$user, $user], new EmailNotification('Mohammad', 'Zahedi'));
    }

    public function getMessageNotification()
    {
        auth()->loginUsingId(39);
        return auth()->user()->notifications;
        return auth()->user()->readNotifications;
        return auth()->user()->unReadNotifications;
    }

    //
    public function notifications()
    {
        return [ 'name', 'family', 'age', 'address', 'mobile'];
    }
}
