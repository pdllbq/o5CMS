<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (config('app.multilang')) {
            $locale = $request->segment(1);
            $availableLocales = explode(',', config('app.locales'));

            if (in_array($locale, $availableLocales)) {
                App::setLocale($locale);
            } else {
                // return redirect('/' . config('app.locale') . '/' . $request->path(), 301);
            }
        } else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}