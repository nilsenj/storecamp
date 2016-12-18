<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (\Auth::user()) {

            if ($request->user()->isAdmin() || $request->user()->isManager()) {

                return $next($request);

            }
            return redirect("/");

        }
    }
}
