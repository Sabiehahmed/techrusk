<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }


        if (\Auth::user()->role_type != 1) {

            if ($request->ajax()) {
                return response('Not Admin.', 401);
            } else {
                abort(401, 'You\'re not an admin!');
            }

        }
        return $next($request);
    }
}
