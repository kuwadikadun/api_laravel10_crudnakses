<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1 Host
        // if($request->getHost() != 'localhost') {

        // Lebih dari 1 Host
        if(!in_array($request->getHost(), ['localhost', '127.0.0.1', '127.2.4.14'])) {
            return response()->json([
                'status' => false,
                'message' => 'Akses Ditolak!'
            ]);
        }
        return $next($request);
    }
}
