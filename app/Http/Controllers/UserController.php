<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileRequests;


class UserController extends Controller
{
    public $roles;
    public function __construct()
    {
        $this->roles = [
            0 => 'Quản trị viên',
            1 => 'Thành viên',
            2 => 'Bị khoá',
            3 => 'Kiểm duyệt viên',

        ];
    }
    public function index()
    {
        return view('admin.index');
    }
    public function home()
    {
        $categories = Category::all();
        $posts = Post::latest()->where('status', '!=', 0)->paginate(5);
        $latestPosts = Post::latest()->take(5)->get();
        return view('client.index', compact('posts', 'categories', 'latestPosts'));
    }
    public function show()
    {
        $user = User::latest()->paginate(5);
        return view('admin.user.index', [
            'user' => $user,
            'roles' => $this->roles,
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $user = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('role', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('admin.user.index', [
            'user' => $user,
            'roles' => $this->roles,
        ]);
    }
    public function delete(Request $request)
    {

        $user = User::find($request->id);
        if ($user && $user->role != 0 && $user->delete()) {
            return redirect('admin/users/index')->with('message', 'Xoá thành công');
        } else {
            return redirect('admin/users/index')->with('message', 'Không thể xoá quản trị viên');
        }
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        if (DB::table('users')->where('email', $request->email)->doesntExist()) {

            $newUser = $request;
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $fileExtension = $file->getClientOriginalExtension();
                $file->move("uploads", $request->email . "." . $fileExtension);
            }
            $newUser['password'] = bcrypt($request->password);
            $newUser['avatar'] = $request->email . "." . $fileExtension;

            User::create($newUser);
            return redirect()->route('users.show')->with('message', 'Đã thêm mới thành công');
        } else {
            return redirect()->route('users.create')->with('message', 'Tài khoản đã tồn tại xin mời tạo lại');
        }
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(ProfileRequests $request)
    {

        $user = User::find($request->id);
        $newUser = $request;
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileExtension = $file->getClientOriginalExtension();
            $file->move("uploads", $request->email . "." . $fileExtension);
            $user->avatar = $newUser['email'] . "." . $fileExtension;
            $user->name = $newUser['name'];
            $user->email = $newUser['email'];
            $user->role = $newUser['role'];
            $user->password = bcrypt($newUser['password']);
            $user->save();
        } else {
            $user->name = $newUser['name'];
            $user->email = $newUser['email'];
            $user->role = $newUser['role'];
            $user->password = bcrypt($newUser['password']);
            $user->save();
        }

        return redirect()->route('users.show')->with('message', 'Đã Sửa mới thành công');
    }
    public function permise()
    {
        $roles = [
            0 => 'Quản trị viên',
            1 => 'Thành viên',
            2 => 'Bị khoá',
            3 => 'Kiểm duyệt viên',

        ];
        $user = User::paginate(5);
        return view('admin.user.permise', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
    public function permise_admin(Request $request)
    {

        $user = User::find($request->id);
        if ($user) {
            $user->role = $request->stt;
            $user->save();
            return redirect()->route('users.permise')->with('message', 'Update thành công');
        }
    }
}
