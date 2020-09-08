<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function email()
    {
        // auth()->loginUsingId(1);

        $user = auth()->user();
        for ( $i = 0; $i < 10 ; $i++ ) { 
            $list[] = $user; //->notify(new EmailNotification('hossein'));
        }

        Notification::send( $list, new EmailNotification( 'hossein' ) );

    }

    public function getMessageNotification()
    {
        return auth()->user()->notifications;
    }

    //
    public function notifications()
    {
        return [ 'name', 'family', 'age', 'address', 'mobile'];
    }
}
