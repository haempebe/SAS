<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPin
{
    public function handle(Request $request, Closure $next): Response
    {
        $pin = $request->session()->get('pin');

        if (!$pin) {
            return redirect()->route('pin');
        }

        return $next($request);
    }
}
