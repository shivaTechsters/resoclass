<?php

namespace App\Listeners\Web;

use App\Mail\Web\SendRegistrationMail;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmailMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        try {
            Mail::to($event->registration->email)->send(new SendRegistrationMail($event->registration));
        } catch (Exception $exception) {
            Log::info("MAIL_ERROR");
            Log::info(json_encode($exception));
        }
    }
}
