<?php

namespace App\Http\Controllers;

use App\Http\Resources\Likes;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = Like::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id
        ]);

        $post = Post::find($like->post_id);

        return response()->json([
            'userPost' => $post->user->id,
            'user' => User::find($like->user_id)
        ]);
    }

    public function destroy($like)
    {
        $likePost = Like::where('post_id', $like)->first();

        $likePost->delete();

        return response()->json(['message' => 'Elminado']);
    }

    public function likePost($postId)
    {
        $likes = Like::where('post_id', $postId)->orderBy('created_at', 'desc')->get();

        return Likes::collection($likes);
    }
}
