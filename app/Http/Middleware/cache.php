<?php

namespace App\Http\Middleware;

use Closure;

class cache
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
        return $next($request)
            ->header("Cache-control", "no-cache, no-store, must-revalidate, max-age=0")
            ->header("Pragma", "no-cache");
    }
}
