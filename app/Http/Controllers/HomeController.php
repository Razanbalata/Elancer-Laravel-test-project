<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::query()
            ->published()
            ->with(['user', 'category']);


        // Ctegory Filter  
        if ($request->filled('category')) {
            $posts->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        // Tag Filter  
        if ($request->filled('tag')) {
            $posts->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.slug', $request->tag);
            });
        }

        // Discover Filter
        if ($request->discover === 'popular') {
            $posts->orderByDesc('views');
        } elseif ($request->discover === 'recent') {
            $posts->latest();
        } else {
            $posts->latest(); // Explore
        }

        $posts = $posts->get();
        //dd(\DB::table('post_tag')->get());
        $featuredPost = $posts->first();
        $regularPosts = $posts->skip(1);
     
      return view('home', [
            'featuredPost' => $featuredPost,
            'posts' => $regularPosts,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }
}
