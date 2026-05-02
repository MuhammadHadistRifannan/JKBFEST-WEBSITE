<?php

namespace App\Http\Middleware;

use App\Services;
use App\Services\DeadlineService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeadlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (DeadlineService::isExpiredTeam() && request()->routeIs(DeadlineService::teamRoute())){
            return redirect()->route('dashboard');
        }

        if (DeadlineService::isExpiredKarya() && request()->routeIs(DeadlineService::karyaRoute())){
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
