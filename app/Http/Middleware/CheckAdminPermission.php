<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 0) {
            return $next($request);
        } else if (Auth::check() &&Auth::user()->role == 2) {
            Auth::logout();
            return redirect('/login')->with('message', 'Tài khoản đã bị khoá');
        } else if (Auth::check()) {
            return redirect('/');
        } else {
            return redirect('/login')->with('message', 'Yêu cầu đăng nhập');
        }
    }
}
