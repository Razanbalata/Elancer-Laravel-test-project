<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::query()
            ->published()
            ->with(['user', 'category'])
            ->latest()
            ->get();

         $featuredPost = $posts->first();
         $reqularPosts = $posts->skip(1);   

        return view('home', [
            'featuredPost'=>$featuredPost,
            'posts' => $reqularPosts,
        ]);
    }
}