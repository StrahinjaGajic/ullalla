<?php

namespace App\Http\Middleware;

use Auth;
use Cookie;
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
            '24.135.165.252',
            '212.41.97.214',
            '77.243.22.147',
            '212.41.121.52',
            '192.168.10.1',
        ];

        $user = auth()->check();

        if (Cookie::get('temp_login') == true) {
            return $next($request);
        } else {
            return redirect('/home');
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
