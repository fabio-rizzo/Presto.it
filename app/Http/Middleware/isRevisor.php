<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isRevisor
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == "revisor"){
            return $next($request);
        }

        return redirect('/')->with('access.denied', 'Attenzione, pagina accessibile solo ai revisori.');
    }
}
