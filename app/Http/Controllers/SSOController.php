<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SSOController extends Controller
{
    public function login(Request $request)
    {

     
        if (!Auth::check()) {

            return "Invalid Token";
        }

        cookie()->queue(

            'access_token',

            $request->token,

            60
        );

        return redirect('/home');
    }
}
