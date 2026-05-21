<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AssingedTickets;
use App\Models\RejectTicketsLog;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\ZoneTicket;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }
}
