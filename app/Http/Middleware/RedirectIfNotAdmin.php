<?php

namespace Horus\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;


class RedirectIfNotAdmin
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
        $user = $request->user();
        dd(  $user );
        return $next($request);
    }
}
