<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $comments = Comment::paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Comment $comment)
    {
        request()->validate([
            'body' => ['required', 'min:8', 'max:2000'],
            'is_approved' => 'required',
        ]);

        $comment->body = request()->body;
        $comment->is_approved = request()->is_approved;

        $comment->save();

        return redirect()->route('admin.comments.index')->with('success', 'Comment successfully updated!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comment successfully deleted!');
    }
}
