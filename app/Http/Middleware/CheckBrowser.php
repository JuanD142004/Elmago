<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class CheckBrowser
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
        $agent = new Agent();

        // Especifica el navegador permitido
        $allowedBrowser = 'Microsoft Bing'; // Cambia esto al navegador que desees permitir

        if (!$agent->is($allowedBrowser)) {
            // Redirige al usuario a la página de inicio de sesión si no usa el navegador permitido
            return redirect('/login');
        }

        return $next($request);
    }
}
