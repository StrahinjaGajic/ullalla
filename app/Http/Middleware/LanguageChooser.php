<?php

namespace App\Http\Middleware;

use Closure;

class LanguageChooser
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
        $locale = null;
        
        if (session()->has('locale')) {
            $newLocale = session()->get('locale');
            if (in_array($newLocale, config()->get('app.locales'))) {
                $locale = $newLocale;
            }
        }

        if (!$locale) {
            $locale = config()->get('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
