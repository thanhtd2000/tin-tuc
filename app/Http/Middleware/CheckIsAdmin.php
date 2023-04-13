<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();
        if (Auth::check() && Auth::user()->role == 3) {
            // Kiểm tra xem có xoá bài đăng hoặc bình luận của "admin" hay không
            if ($routeName == 'delete-post' && Post::find($request->route()->id)->user->role == 0) {
                return back()->with(['message' => 'Bạn không có quyền xóa bài đăng của Admin'], 403);
            }
            if ($routeName == 'posts.edit' && Post::find($request->route()->id)->user->role == 0) {
                return back()->with(['message' => 'Bạn không có quyền chỉnh sửa bình luận của Admin'], 403);
            }
            if ($routeName == 'delete.comments' && Comment::find($request->route()->id)->user->role == 0) {
                return back()->with(['message' => 'Bạn không có quyền xóa bình luận của Admin'], 403);
            }
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role == 0) {

            if ($routeName == 'delete-post' &&  Post::find($request->route()->id)->user_id == Auth::id()) {
                return $next($request);
            }
            if ($routeName == 'posts.edit' && Post::find($request->route()->id)->user_id == Auth::id()) {
                return $next($request);
            }

            if ($routeName == 'delete.comments' && Comment::find($request->route()->id)->user_id == Auth::id()) {
                return $next($request);
            }
            return back()->with('message', 'Bạn không thể xoá của ADMIN khác');
        }

        return back()->with(['message' => 'Bạn không có quyền truy cập'], 403);
    }
}
