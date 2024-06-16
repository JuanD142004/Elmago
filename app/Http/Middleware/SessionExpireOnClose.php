<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionExpireOnClose
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
        if (Auth::check()) {
            // Check if the browser session cookie exists
            if (!$request->hasCookie('browser_session')) {
                // If the cookie does not exist, log the user out
                Auth::logout();
                return redirect('/login');
            }
        }

        // Create or refresh the browser session cookie
        cookie()->queue(cookie('browser_session', true, 0)); // '0' sets the cookie to expire when the browser closes

        return $next($request);
    }
}
