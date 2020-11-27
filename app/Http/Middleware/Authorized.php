<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Zend\Diactoros\Request;

class Authorized
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
        if (Auth::guest())
            return redirect('/');

        if(Auth::user()->hasPermission(explode('/',$request->path())[0]))
        return $next($request);

        return abort(403);

    }
}
