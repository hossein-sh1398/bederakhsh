<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events\RegisterUserEvent;

class UserController extends Controller
{
    public function make($name)
    {
        $user = User::create( [
            'name' => $name,
            'email' => $name . '@gmail.com',
            'password' => bcrypt( 'abcdefjhigklmnopqrstuvwxyz')
        ] );

        event( new RegisterUserEvent() );

    }
}
