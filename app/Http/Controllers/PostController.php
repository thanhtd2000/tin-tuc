<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhere('user_id', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }
    public function store(Request $request)
    {
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
            $pt->status = $post['status'];
            $pt->content = $post['content'];
            $pt->user_id = $post['user_id'];
            $pt->categories_id = $post['categories_id'];
            $pt->created_at = Carbon::now();
        }
        $pt->save();
        return redirect('admin/posts/index')->with('message', 'Thêm thành công');
    }
    public function delete(Request $request)
    {

        $Post = Post::find($request->id);
        if ($Post && $Post->delete()) {
            return redirect('admin/posts/index')->with('message', 'Xoá thành công');
        }
    }
    public function edit(Request $request)
    {
        $categories = Category::all();
        $post = Post::find($request->id);

        return view('admin.post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }
    public function update(Request $request)
    {
        $rule = [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'categories_id' => 'required',
            'id' => 'required',
        ];
        $message = [
            'required' => 'Trường bắt buộc phải nhập'
        ];

        $post = $request->validate($rule, $message);
        $pt = Post::find($post['id']);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $path = 'uploads/posts/';
            $file->move($path, $fileName);
            $pt->image = $path . $fileName;
        }
        $pt->title = $post['title'];
        $pt->content = $post['content'];
        $pt->user_id = $post['user_id'];
        $pt->categories_id = $post['categories_id'];
        $pt->created_at = Carbon::now();
        $pt->save();
        return redirect()->route('posts.show')->with('message', 'Sửa thành công');
    }
    public function updatestt(Request $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            $post->status = 1;
            $post->save();
            return redirect()->route('posts.show')->with('message', 'Update trạng thái thành công');
        }
    }

    public function like(Post $post)
    {
        $user = Auth::user();
        if (!$post->hasLikedPost($user)) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();
        } else {
            $like = Like::where('user_id', $user->id);
            $like->delete();
        };

        return back();
    }
}
