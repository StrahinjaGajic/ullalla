<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class FrontAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {

        if (Auth::guard('local')->guest() && Auth::guard('web')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {                
                return response('Unauthorized.', 401);
            } elseif (Auth::guard('local')->guest() && Auth::guard('web')->guest()) {
                return $next($request);
            } else {
                return redirect()->guest('/signin');
            }
        }
        return $next($request);
    }
}
