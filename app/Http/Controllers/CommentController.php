<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(5);
        return view('admin.comment.index', compact('comments'));
    }

    public function delete(Request $request)
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
    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $comments = Comment::where('content', 'like', '%' . $query . '%')
            ->orWhere('user_id', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('admin.comment.index', compact('comments'));
    }
}
