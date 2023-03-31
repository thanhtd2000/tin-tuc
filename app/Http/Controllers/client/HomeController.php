<?php

namespace App\Http\Controllers\client;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $posts2 = Post::latest()->take(5)->get();
        $categories = Category::all();
        $latestPosts = Post::latest()->take(5)->get();
        return view('client.index', compact('posts', 'categories', 'latestPosts'));
    }
    // 
    public function showCategory(Request $request)
    {
        $posts = Post::where('categories_id', $request->id)->get();
        $categories = Category::all();
        $latestPosts = Post::latest()->take(5)->get();
        return view('client.category', compact('posts', 'categories', 'latestPosts'));
    }
    public function showPostDetail(Request $request)
    {
        $post_id = Post::find($request->id);
        $categories = Category::all();
        $latestPosts = Post::latest()->take(5)->get();
        $comments = Comment::where('post_id', $request->id)
            ->with('user')
            ->get();
        return view('client.post_detail', compact('post_id', 'categories', 'latestPosts', 'comments'));
    }
    public function searchPost(Request $request)
    {
        $query = $request->input('search_post');
        $search_posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(5);
        $categories = Category::all();
        return view('client.search_post', compact('categories', 'search_posts'));
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
            $rule = [
                'title' => 'required',
                'content' => 'required',
                'user_id' => 'required',
                'categories_id' => 'required',
                'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'status' => 'required',
            ];
            $message = [
                'required' => 'Trường bắt buộc phải nhập'
            ];
            $post = $request->validate($rule, $message);
            if ($request->hasFile('image')) {
                $file = $request->image;
                $fileName = $file->getClientOriginalName();
                $path = 'uploads/posts/';
                $file->move($path, $fileName);
                $pt = new Post();
                $pt->image = $path . $fileName;
                $pt->title = $post['title'];
                $pt->content = $post['content'];
                $pt->status = $post['status'];
                $pt->user_id = $post['user_id'];
                $pt->categories_id = $post['categories_id'];
                $pt->created_at = Carbon::now();
            }
            $pt->save();
        }
        return redirect()->route('client.home')->with('message', 'Thêm bài viết thành công');
    }
}
