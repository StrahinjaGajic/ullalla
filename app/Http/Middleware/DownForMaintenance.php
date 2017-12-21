<?php

namespace App\Http\Middleware;

use Auth;
use Session;
use Closure;
use App\Models\User;
use App\Models\Local;

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
        $response = $next($request);

        if (app()->environment() == 'production' && $_SERVER['REMOTE_ADDR'] != '24.135.165.252') {
            return 'Temporarily Down For Maintenance';
        }

        // if (app()->environment() != 'production') {
        //     if (!Auth::guard('local')->user()) {                            
        //         return 'down'; 
        //     } elseif (!Auth::user()) {    
        //         return 'down';
        //     }
        // }

        return $response;
    }
}
