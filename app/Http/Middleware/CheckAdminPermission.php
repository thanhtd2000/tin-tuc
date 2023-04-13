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
        if (Auth::check() && Auth::user()->role == 0||Auth::check() &&Auth::user()->role == 3) {
            return $next($request);
        } else if (Auth::check() && Auth::user()->role == 2) {
            Auth::logout();
            return redirect()->route('login')->with('message', 'Tài khoản đã bị khoá không thể sử dụng các tính năng của website , hãy liên hệ
            admin để nhận trợ giúp');
        } else if (Auth::check()) {
            return redirect('/');
        } else {
            return redirect('/login')->with('message', 'Yêu cầu đăng nhập');
        }
    }
}
