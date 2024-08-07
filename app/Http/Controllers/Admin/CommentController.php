<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('product', 'user')->paginate(10);
        return view('admins.comments.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::with('product', 'user')->findOrFail($id);
        return view('admins.comments.show', compact('comment'));
    }



    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admins.comments.index')->with('success', 'Xóa thành công');
    }
}
