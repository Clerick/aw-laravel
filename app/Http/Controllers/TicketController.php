<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Http\Requests\CreateTicketRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Events\TicketCreated;

class TicketController extends Controller
{
    /**
     * @param CreateTicketRequest $request
     * @return mixed
     */
    public function create(CreateTicketRequest $request)
    {
        DB::beginTransaction();

        try {
            $ticket = Ticket::create($request->all());
            $message = $ticket->messages()->create($request->all());

            if ($request->hasCredentials()) {
                $message->serverCredentials()->create($request->all());
            }

            TicketCreated::dispatch($ticket);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return $this->getSaveErrorResponse($request->wantsJson());
        }

        return $this->getSuccessResponse($ticket->uid, $request->wantsJson());
    }

    /**
     * @param boolean $isWantsJson
     * @return Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function getSaveErrorResponse(bool $isWantsJson)
    {
        $saveErrorData = [
            'saveError' => __('Sorry, but something went wrong while saving your request. Please try again later.')
        ];
        
        return $isWantsJson 
            ? response()->json($saveErrorData, Response::HTTP_INTERNAL_SERVER_ERROR) 
            : back()->withInput()->withErrors($saveErrorData);
    }

    /**
     * @param string $uid
     * @param boolean $isWantsJson
     * @return Response|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    private function getSuccessResponse(string $uid, bool $isWantsJson = false)
    {
        return $isWantsJson
            ? response()->json(['message' => 'success', 'uid' => $uid], Response::HTTP_CREATED)
            : view('dashboard.ticket_submit_success', ['uid' => $uid]);
    }
}
