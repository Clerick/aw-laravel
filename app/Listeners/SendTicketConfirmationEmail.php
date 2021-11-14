<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCreated as TicketCreatedMail;
use Illuminate\Support\Facades\Log;

class SendTicketConfirmationEmail implements ShouldQueue
{
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
        Mail::to($ticket->user_email)->send(new TicketCreatedMail($ticket));
    }

    public function failed(TicketCreated $event, \Throwable $exception)
    {
        Log::error(__('Send ticket confirmation email failed:') . ' ' . $exception->getMessage());
    }
}
