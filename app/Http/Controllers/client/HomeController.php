<?php

namespace App\Http\Controllers\client;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Notify;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendMailNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProfileRequests;
use App\Http\Resources\CategoryResource;

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
        $posts = Post::where('categories_id', $request->id)->paginate(5);
        $category_id = $posts->pluck('categories_id')->first(); // Lấy giá trị của categories_id từ bản ghi đầu tiên
        $category = Category::find($category_id);
        $category_name = $category->category_name;
        return view('client.category', [
            'posts' => $posts,
            'category_name' => $category_name
        ])->with($this->data);
    }
    public function showPostDetail(Request $request)
    {
        $request['post_id'] = Post::find($request->id);
        $post_category_id = Post::find($request->id)->categories_id;
        $comments = Comment::where('post_id', $request->id)
            ->with('user')
            ->get();
        $post_categories = Post::where('categories_id', $post_category_id)->paginate(3);
        return view('client.post_detail', [

            'post_id' => $request['post_id'],
            'comments' => $comments,
            'post_categories' => $post_categories,
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
                $fileName = Str::random(4) . $file->getClientOriginalName();
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
    public function storeComment(Request $request)
    {
        $cmt = new Comment();
        $cmt->content = $request['content_comment'];
        $cmt->user_id = $request['user_id'];
        $cmt->post_id = $request['post_id'];
        $cmt->status = $request['status'];
        if ($request['parent_id']) {
            $cmt->parent_id = $request['parent_id'];
        } else {
            $cmt->parent_id = 0;
        }
        $cmt->created_at = Carbon::now();
        $cmt->save();
        if ($request['parent'] != 0) {
            if (Post::find($request['id'])) {
                $emailUser = Post::find($request['id'])->user->email;
                $User_id = Post::find($request['id'])->user->id;
            } else if (Comment::Where('parent_id', $request['id'])) {
                $emailUser = Comment::find($request['id'])->user->email;
                $User_id = Comment::find($request['id'])->user->id;
            }
            $userName = Auth::user()->name;
            $linkPost = route('client.postDetail', $cmt->post_id);
            Mail::to($emailUser)->send(new SendMailNotification($userName, $cmt->content, $cmt->created_at, $linkPost));
            $noti = new Notify();
            $noti->userComment = $userName;
            $noti->commentContent = $cmt->content;
            $noti->dateComment = $cmt->created_at;
            $noti->reply = $request['reply'];
            $noti->linkPost = $linkPost;
            $noti->user_id = $User_id;
            $noti->save();
        }
        return back()->with('message', 'Thêm thành công');
    }
    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->id);
        $delete_child_comment = Comment::Where('parent_id', $request->id)->get();
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
            $fileName = Str::random(4) . $file->getClientOriginalName();
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
    public function showProfile(Request $request)
    {
        $user_profile = User::find(Auth::user()->id);

        return view('client.show_profile', compact('user_profile'));
    }
    public function editProfile(Request $request)
    {
        $user_profile = User::find($request->id);
        return view('client.edit_profile', compact('user_profile'));
    }
    public function updateProfile(ProfileRequests $request)
    {

        $user = User::find($request->id);
        $newUser = $request;
        if ($request->password) {
            $user->password = bcrypt($newUser['password']);
        }
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileExtension = $file->getClientOriginalExtension();
            $file->move("uploads", $request->email . "." . $fileExtension);
            $user->avatar = $newUser['email'] . "." . $fileExtension;
        }

        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->role = $newUser['role'];
        $user->save();


        return redirect()->route('client.showProfile')->with('message', 'Đã cập nhật thành công');
    }
    public function updateNotification(Request $request)
    {
        $notify = Notify::find($request->id);
        $notify->watched = 1;
        $notify->save();
        return redirect($notify->linkPost);
    }

    public function updateAllNotification(Request $request)
    {
        Notify::where('user_id', $request->user_id)->update(['watched' => 1]);
        return redirect()->back();
    }

    public function contact()
    {
        return view('client.contact')->with($this->data);
    }
    public function introduce()
    {
        return view('client.introduce')->with($this->data);
    }
    public function dashboard()
    {
        $users = User::withCount('Post')->orderBy('post_count', 'desc')->take(5)->get();
        $posts = Post::withCount('likes')->orderBy('likes_count', 'desc')->take(5)->get();
        $data = [];
        $data2 = [];
        foreach ($users as $user) {
            $data['labels'][] = $user->name;
            $data['data'][] = $user->post_count;
        }
        foreach ($posts as $post) {
            $data2['labels'][] = $post->title;
            $data2['data'][] = $post->likes_count;
        }
        return view('client.dashboard', compact('data', 'data2'))->with($this->data);
    }

    // api categories
    public function category()
    {
        $arr = [
            'status' => 200,
            'data' => CategoryResource::collection($this->categories),
        ];
        return response()->json($arr);
    }
}
