<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckTestController extends Controller
{
    public function Index()
    {

        return view('CheckView.Index');
    }
    public function getProject()
    {

        // $token = request()->cookie('access_token');


        // $response = Http::withToken($token)->get('http://localhost:7161/Project/LoadProjectAPI');

        // if ($response->successful()) {

        //     $projects = $response->json();

        //     return $projects;
        // }

        // return response()->json([
        //     'status' => false,
        //     'message' => 'Unable to fetch projects'
        // ]);
        $token = request()->cookie('access_token');

        $response = Http::withoutVerifying()->withToken($token)->withBody(json_encode(auth()->id()), 'application/json')->post('https://localhost:7161/Project/LoadProjectAPI');

        return $response->json();
    }
}
