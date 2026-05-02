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
        if (DeadlineService::isExpired() && request()->routeIs(DeadlineService::preservedRoutes())){
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
