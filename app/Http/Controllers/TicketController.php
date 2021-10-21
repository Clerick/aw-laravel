<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $ticket = Ticket::create($request->all());
            $ticket->save();
        } catch (QueryException $e) {
            Log::error($e->getMessage());

            return back()->withInput()->withErrors([
                'saveException' => __('Sorry, but something went wrong. Please try again later.'),
            ]);
        }  
    }
}
