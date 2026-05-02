<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // KALO USER UDAH PUNYA TEAM DAN MASIH NEMBAK ROUTE ADD_TEAM ARAHKAN KE TEAMPESERTA
        if (auth()->user()->team && request()->routeIs('addTeam')){
            return redirect()->route('teamPeserta');
        }
        return $next($request);
    }
}
