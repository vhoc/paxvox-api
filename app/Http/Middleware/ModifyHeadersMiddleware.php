<?php

namespace App\Http\Middleware;

use Closure;

class ModifyHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action

        $response = $next($request);
        $response->header( 'Access-Control-Allow-Origin', '*' );
        $response->header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        $response->header( 'Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token' );

        // Post-Middleware Action

        return $response;
    }
}
