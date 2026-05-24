<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class apirequestController extends Controller
{
    public function getProjects()
    {

        
        $token = request()->cookie('access_token');
       
        $response = Http::withToken($token)->get('http://localhost:7161/Project/LoadProjectAPI');

        if ($response->successful()) {

            $projects = $response->json();

            return $projects;
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to fetch projects'
        ]);
    }
}
