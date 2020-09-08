<?php

namespace App\Listeners;
use Illuminate\Events\Dispatcher;
use Log;
use App\Events\RegisterUserEvent;

class UserSubscriber
{
    public function subscribe( Dispatcher $events )
    {
        $events->listen(RegisterUserEvent::class, '\App\Listeners\UserSubscriber@sendEmailWellcome');
        $events->listen(RegisterUserEvent::class, '\App\Listeners\UserSubscriber@sendEmailVerificationCode');
        $events->listen(RegisterUserEvent::class, '\App\Listeners\UserSubscriber@foo');
    }

    public function sendEmailWellcome(RegisterUserEvent $event)
    {
        Log::info('send Email Wellcome');
    }

    public function sendEmailVerificationCode(RegisterUserEvent $event)
    {
        Log::info('send Email Verification Code');
    }

    public function foo(RegisterUserEvent $event)
    {
        Log::info('foo Register');
    }
}