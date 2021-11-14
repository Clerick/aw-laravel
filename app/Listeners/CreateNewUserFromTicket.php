<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CreateNewUserFromTicket implements ShouldQueue
{
    use InteractsWithQueue;

    public const CREATE_USER_API_URL = 'api/users';
    public $afterCommit = true;
    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        $ticket = $event->ticket;
        $apiResponse = Http::post(config('app.api_url') . self::CREATE_USER_API_URL,  $ticket->toArray());
        Log::info(
            __('Create new user api response for the ticket with uid:') . ' ' . $ticket->uid . PHP_EOL
            . print_r($apiResponse->json(), true)
        );
    }

    public function failed(TicketCreated $event, \Throwable $exception)
    {
        Log::error(__('Create user queue failed:') . ' ' . $exception->getMessage());
    }
}
