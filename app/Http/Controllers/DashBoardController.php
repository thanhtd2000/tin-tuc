<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
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
        return view('admin.index', [
            'data' => $data, 'data2' => $data2
        ]);
    }
}
