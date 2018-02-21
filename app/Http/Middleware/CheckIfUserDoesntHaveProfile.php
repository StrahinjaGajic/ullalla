<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserDoesntHaveProfile
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
        if (auth()->user()->has_profile == 0) {
            return redirect()->action('HomeController@getIndex');
        }

        return $next($request);
    }
}
