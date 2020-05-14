<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4);

        return PostCollection::collection($posts);
    }

    public function getPostsUser($userId)
    {
        $posts = Post::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(4);

        return PostCollection::collection($posts);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required'
        ]);

        $post = Post::create([
            'description' => $request->description,
            'photo' => $request->photo,
            'user_id' => $request->user()->id
        ]);

        return $post;
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Eliminado con exito']);
    }

    public function storePhoto(Request $request)
    {
        $url = request()->file('photo')->store('files');

        return response()->json(['photo' => $url]);
    }

    public function destroyPhoto(Request $request)
    {
        File::delete('app'.$request->photo);

        return response()->json(['message' => 'post photo it was destroy']);
    }
}
