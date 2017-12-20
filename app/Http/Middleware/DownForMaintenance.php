<?php

namespace App\Http\Middleware;

use Closure;

class DownForMaintenance
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
        if (app()->environment() == 'production' && $_SERVER['REMOTE_ADDR'] != '24.135.165.252') {
            return 'Temporarily Down For Maintenance';
        }
        return $next($request);
    }
}
