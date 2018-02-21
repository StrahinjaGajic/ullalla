<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Carbon\Carbon;

class RedirectIfPackageExpired
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
        // if(Auth::guard('local')->user()){
        //     $user = Auth::guard('local')->user();
        //     if ($user->is_active_d_package == 0) {
        //         return redirect()->action('LocalController@getPackages', ['username' => $user->username])
        //             ->with('expired_package_info', __('messages.error_default_package_expired'));
        //     }
        // } elseif (Auth::user()) {
        //     $user = Auth::user();
        //     if ($user->is_active_d_package == 0) {
        //         return redirect()->action('ProfileController@getPackages', ['private_id' => $user->id])
        //             ->with('expired_package_info', __('messages.error_default_package_expired'));
        //     }
        // }

        return $next($request);
    }
}
