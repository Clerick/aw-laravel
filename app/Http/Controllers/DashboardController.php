<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showTicketForm(Request $request)
    {
        return view('dashboard', ['messageAuthors' => Message::AUTHORS]);
    }
}
