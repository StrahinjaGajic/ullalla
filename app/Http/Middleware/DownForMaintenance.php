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

        $ipAddresses = [
            '109.122.99.8',
            '24.135.165.252'
        ];

        if (app()->environment() == 'production' && in_array($_SERVER['REMOTE_ADDR'], $ipAddresses)) {
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
