<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate([
            'body' => ['required', 'min:8', 'max:2000'],
        ]);

        $comment = new Comment();
        $comment->body = request()->body;
        $comment->is_approved = false;
        $comment->user_id = auth()->user()->id;
        $comment->post()->associate($post->id);

        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('warning', 'Your comment is waiting approve!');
    }

    public function edit(Comment $comment)
    {
        if (auth()->user()->id != $comment->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Page!');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Comment $comment)
    {
        request()->validate([
            'body' => ['required', 'min:8', 'max:2000'],
        ]);

        $comment->body = request()->body;

        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment successfully updated!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment successfully deleted!');
    }
}
