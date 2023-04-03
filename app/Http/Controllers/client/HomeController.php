<?php

namespace App\Http\Controllers\client;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\SendMailNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public $latestPosts;
    public $categories;
    public $top_posts_outstanding;
    public $top_users;
    public $data;
    public function __construct()
    {
        $this->categories = Category::all();
        $this->latestPosts = Post::latest()->take(3)->get();
        $this->top_posts_outstanding = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(5)
            ->get();
        $this->top_users = Post::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        $this->data = [
            'top_users' => $this->top_users,
            'categories' => $this->categories,
            'top_posts_outstanding' => $this->top_posts_outstanding,
            'latestPosts' => $this->latestPosts,
        ];
    }
    //
    public function home()
    {
        $posts = Post::latest()->where('status', '!=', 0)->paginate(5);
        //dd($this->top_posts_outstanding);
        return view('client.index', [
            'posts' => $posts,
        ])->with($this->data);
    }
    public function index()
    {
        $posts2 = Post::latest()->take(5)->get();
        return view('client.index', [
            'posts2' => $posts2,
        ])->with($this->data);
    }
    // 
    public function showCategory(Request $request)
    {
        $posts = Post::where('categories_id', $request->id)->get();
        return view('client.category', [
            'posts' => $posts,
        ])->with($this->data);
    }
    public function showPostDetail(Request $request)
    {
        $post_id = Post::find($request->id);
        $comments = Comment::where('post_id', $request->id)
            ->with('user')
            ->get();
        return view('client.post_detail', [
            'post_id' => $post_id,
            'comments' => $comments,
        ])->with($this->data);
    }
    public function searchPost(Request $request)
    {
        $query = $request->input('search_post');
        $search_posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('client.search_post', [
            'search_posts' => $search_posts,
        ])->with($this->data);
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
    public function storeComment(Request $request, $post_id)
    {
        //$emailUserPost = Post::find($post_id)->user->email;


        $cmt = new Comment();
        $cmt->content = $request['content_comment'];
        $cmt->user_id = $request['user_id'];
        $cmt->post_id = $request['post_id'];
        if ($request['parent_id']) {
            $cmt->parent_id = $request['parent_id'];
        } else {
            $cmt->parent_id = 0;
        }
        $cmt->created_at = Carbon::now();

        $cmt->save();
        if (Post::find($post_id)) {
            $emailUser = Post::find($post_id)->user->email;
        } else if (Comment::Where('parent_id', $post_id)) {
            $emailUser = Comment::find($post_id)->user->email;
        }
        $userName = Auth::user()->name;
        $linkPost = route('client.postDetail', $cmt->post_id);
        Mail::to($emailUser)->send(new SendMailNotification($userName, $cmt->content, $cmt->created_at, $linkPost));
        return back()->with('message', 'Thêm thành công');
    }
    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->id);
        $delete_child_comment = Comment::Where('parent_id', $request->id)->get();
        //dd($delete_child_comment);
        if ($comment) {
            $delete_child_comment->each->delete();
            $comment->delete();
            return back()->with('message', 'Xóa bình luận thành công');
        }
        return back()->with('message', 'Không tìm thấy bình luận');
    }
    public function showPostCreated()
    {

        $postCreateds  = Post::Where('user_id', Auth::user()->id)->get();
        return view('client.showPostCreated', [
            'postCreateds' => $postCreateds,
        ])->with($this->data);
    }
    public function editPostCreated(Request $request)
    {

        $post_created  = Post::find($request->id);
        return view('client.editPostCreated', [
            'post_created' => $post_created,
        ])->with($this->data);
    }
    public function updatePostCreated(Request $request)
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
        return redirect()->route('client.postCreated')->with('message', 'Sửa bài viết thành công');
    }
    public function deletePostCreated(Request $request)
    {

        $Post = Post::find($request->id);
        if ($Post && $Post->delete()) {
            return redirect()->route('client.postCreated')->with('message', 'Xóa bài viết thành công');
        }
    }
}
