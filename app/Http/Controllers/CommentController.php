<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentCollection;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id
        ]);

        return $comment;
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }

    public function commentPost($postId)
    {
        $comments = Comment::where('post_id', $postId)->orderBy('created_at', 'desc')->get();

        return CommentCollection::collection($comments);
    }
}
