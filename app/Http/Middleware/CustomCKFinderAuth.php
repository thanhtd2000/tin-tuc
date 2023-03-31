<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomCKFinderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            config(['ckfinder.authentication' => function () use ($request) {
                return true;
            }]);
        } else {
            config(['ckfinder.authentication' => function () use ($request) {
                return false;
            }]);
        }

        return $next($request);
    }
}
