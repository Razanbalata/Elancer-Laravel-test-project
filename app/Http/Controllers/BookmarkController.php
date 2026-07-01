<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookmarkController extends Controller
{
    public function store(Request $request, string $id)
    {
        $post = Post::query()->published()->findOrFail($id);
        $user = $request->user();

        if (!$user->bookmarkedPosts()->where('posts.id', $post->id)->exists()) {
            $user->bookmarkedPosts()->attach($post->id);
        }

        return Redirect::back();
    }

    public function destroy(Request $request, string $id)
    {
        $post = Post::query()->published()->findOrFail($id);
        $request->user()->bookmarkedPosts()->detach($post->id);

        return Redirect::back();
    }
}
