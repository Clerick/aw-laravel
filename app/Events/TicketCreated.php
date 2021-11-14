<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;

class TicketCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Ticket
     */
    public $ticket;

    public function __construct(
        Ticket $ticket
    ) {
        $this->ticket = $ticket;
    }
}
