<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;

class TicketCreated extends Mailable
{
    use SerializesModels;

    /**
     * @var Ticket
     */
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Ticket $ticket
    ) {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.ticket_created');
    }
}
