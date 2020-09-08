<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\RegisterUserEvent;
use App\Listeners\SendWellcomeEmailToUserListener;
use App\Listeners\UserSubscriber;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // RegisterUserEvent::class => [
        //     SendWellcomeEmailToUserListener::class,
        // ]`
    ];

    protected $subscribe = [
        //UserSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        // به این صورت هم میشه برای یک رویداد شنود نوشت
        // Event::listen( RegisterUserEvent::class, function( RegisterUserEvent $event ) {
        //     \Log::info( 'Send Email to Wellcome User' );
        // } );
    }
}
