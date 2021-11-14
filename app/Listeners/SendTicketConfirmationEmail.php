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
    use InteractsWithQueue;

    public $afterCommit = true;
    public $tries = 5;

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
        Log::error(__('Send ticket confirmation email queue failed:') . ' ' . $exception->getMessage());
    }
}
