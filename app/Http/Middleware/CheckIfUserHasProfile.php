<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserHasProfile
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
        if (auth()->user()->has_profile == 1) {
            return redirect()->action('HomeController@getIndex');
        }
        
        return $next($request);
    }
}
