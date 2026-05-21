<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckTestController extends Controller
{
    public function Index()
    {
        return view('CheckView.Index');
    }
}
