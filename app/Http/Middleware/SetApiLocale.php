<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetApiLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = config('locales.supported', []);
        $locale = $request->query('lang');

        if (! is_string($locale) || ! array_key_exists($locale, $supported)) {
            $preferred = $request->getPreferredLanguage(array_keys($supported));
            $locale = is_string($preferred) && array_key_exists($preferred, $supported)
                ? $preferred
                : config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
