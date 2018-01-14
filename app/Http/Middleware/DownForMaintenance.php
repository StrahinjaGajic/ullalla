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


        // app()->environment() == 'production' && !in_array($_SERVER['REMOTE_ADDR'], $ipAddresses)
        if (!$user) {
            if ($request->isMethod('post')) {
                if (Auth::attempt($request->only(['username', 'password']))) {
                    $user = Auth::user();
                    if ($user->activated == '0') {
                        Auth::logout();
                        return redirect()->back()->with('error', __('messages.error_activate_account'));
                    }

                    return redirect('/');
                }
            }


            if ($request->path() != 'polarna_kobra') {
                return redirect()->route('countdown');
            } else {
                return redirect()->route('tempLogin');
            }

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
