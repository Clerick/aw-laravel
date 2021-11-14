<?php

namespace App\Http\Controllers;

use App\Models\Message;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showTicketForm()
    {
        return view('dashboard', ['messageAuthors' => Message::AUTHORS]);
    }
}
