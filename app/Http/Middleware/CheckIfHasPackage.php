<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfHasPackage
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
        if (auth()->user()->package1_id) {
            return redirect()->action('HomeController@getIndex');
        }

        return $next($request);
    }
}
