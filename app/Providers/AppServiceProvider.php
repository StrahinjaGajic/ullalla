<?php

namespace App\Providers;

use Stripe\Stripe;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('local')) {
            Stripe::setApiKey(config('development.stripe.secret_key'));
        } elseif (app()->environment('production')) {
            Stripe::setApiKey(config('stripe.secret_key'));
        }
        // Validator::extend('no_spaces', function($attr, $value){
        //     return preg_match('/^\S*$/u', $value);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
