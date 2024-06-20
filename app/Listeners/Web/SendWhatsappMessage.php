<?php

namespace App\Listeners\Web;

use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class SendWhatsappMessage
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
            $response = Http::post('https://backend.api-wa.co/campaign/yokr/api', [
                "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0ZDM1YzQ3NTdiNDJkMTA0NzFhNjBlNSIsIm5hbWUiOiJwdXJuYSIsImFwcE5hbWUiOiJBaVNlbnN5IiwiY2xpZW50SWQiOiI2NGQzNWM0NzU3YjQyZDEwNDcxYTYwZTAiLCJhY3RpdmVQbGFuIjoiTk9ORSIsImlhdCI6MTY5MTU3MzMxOX0.4AkHFTfGMUn9AP4q7tDAIHH0C5QUuXcsLfUOOW71AIg",
                "campaignName" => "Grandtest2024",
                "destination" => "+91". $event->data['phone'],
                "userName" => $event->data['name'],
                "media" => [
                    "url" => $event->data['pdf_link'],
                    "filename" => "Admit Card.pdf",
                ],
                "templateParams" => [$event->data['admit_card_no'], $event->data['download_link']]
            ]);

            if ($response->successful()) {
                Log::info('WHATSAPP_MESSAGE_SENT');
                Log::info($response->json());
            } else {
                Log::info('WHATSAPP_MESSAGE_SENT');
                Log::info($response->body());
            }
        }
    }
}
