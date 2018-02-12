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
        if (Cookie::get('temp_login') == true) {
            return $next($request);
        } else {
            return redirect('/home');
        }
    }
}
