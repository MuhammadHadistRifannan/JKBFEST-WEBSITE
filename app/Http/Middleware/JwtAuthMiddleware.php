<?php

namespace App\Http\Middleware;

use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //verifying Jwt token 
        $token = $request->bearerToken();
        if (!$token){
            return response()->json(['message' => 'request tidak mempunyai token' , 'status' => null] , 402);
        }
        
        $decode = JwtService::DecodeJwt($token);
        switch ($decode['type']) {
            case 'invalid':
                return response()->json(['message' => 'token tidak valid , akses ditolak' ,'status' => 'inv'],401);
                break;
            case 'expired':
                return response()->json(['message' => 'token kadaluarsa , akses ditolak' ,'status' => 'exp'],401);
                break;
            
        }

        return $next($request);
    }
}
