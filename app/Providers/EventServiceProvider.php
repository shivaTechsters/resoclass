<?php

namespace App\Providers;

use App\Events\Web\Registred;
use App\Listeners\Web\SendEmailMessage;
use App\Listeners\Web\SendSmsMessage;
use App\Listeners\Web\SendWhatsappMessage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registred::class => [
            SendWhatsappMessage::class,
            SendEmailMessage::class,
            SendSmsMessage::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
