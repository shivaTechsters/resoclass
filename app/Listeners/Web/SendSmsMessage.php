<?php

namespace App\Listeners\Web;

use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class SendSmsMessage
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
        if ($event->data['phone'] != "") {
            $message = urlencode("Greetings from Resonance Hyderabad. Thank you for registering with us for Resonance NEET 2024 Free Grand Test. Your Reso admit card number is ".$event->data['admit_card_no']." and you can download your admit card with detailed guidelines from the following link ".$event->data['download_link']." Best wishes for the exam.");

            $url = "http://ngbulksms.com/v3/api.php?username=resonancetrans&apikey=b2314f40c0bba958a3da&senderid=RESOHY&mobile=".$event->data['phone']."&message=".$message;

            $response = Http::get($url);

            if ($response->successful()) {
                Log::info('SMS_MESSAGE_SENT');
                Log::info($response->json());
            } else {
                Log::info('SMS_MESSAGE_SENT');
                Log::info($response->body());
            }
        }
        
    }
}
