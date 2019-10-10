<?php

namespace App\Http\Middleware;

use Closure;

class CustomSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (array_key_exists('user_session', $_SESSION)) {
            if ($_SESSION['user_session']) {
                return $next($request);
            } else {
                return \redirect()->guest('/');
            }
        } else {
            return \redirect()->guest('/');
        }
    }
}
