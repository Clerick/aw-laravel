<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Http\Requests\CreateTicketRequest;

class TicketController extends Controller
{
    /**
     * @param CreateTicketRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateTicketRequest $request)
    {
        DB::beginTransaction();

        try {
            $ticket = Ticket::create($request->all());
            $message = $ticket->messages()->create($request->all());
            $message->serverCredentials()->create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->withInput()->withErrors([
                'saveException' => __('Sorry, but something went wrong while saving your request. Please try again later.'),
            ]);
        }

        return view('dashboard.ticket_submit_success', ['uid' => $ticket->uid]);
    }
}
