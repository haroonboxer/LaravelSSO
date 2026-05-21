<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SSOAuth
{
    public function handle(
        Request $request,
        Closure $next
    ) {

        if (!session('authenticated')) {

            return redirect(
                'https://localhost:7161/'
            );
        }

        return $next($request);
    }
}
