<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( session()->has('type') && session('type') == 'admin' )
        {
            return $next($request);
        }
        else
        {
            return response(['error' => 'Not authorized'], 403);
        }
    }
}
