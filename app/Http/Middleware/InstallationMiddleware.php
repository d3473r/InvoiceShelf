<?php

namespace InvoiceShelf\Http\Middleware;

use Closure;
use InvoiceShelf\Models\Setting;

class InstallationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! \Storage::disk('local')->has('database_created')) {
            return redirect('/installation');
        }

        if (\Storage::disk('local')->has('database_created')) {
            if (Setting::getSetting('profile_complete') !== 'COMPLETED') {
                return redirect('/installation');
            }
        }

        return $next($request);
    }
}
