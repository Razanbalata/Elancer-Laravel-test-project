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
        $query = Post::query()
            ->published()
            ->with(['user', 'category']);


        // Ctegory Filter  
        if ($request->filled('category')) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        // Tag Filter  
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.slug', $request->tag);
            });
        }

        // Discover Filter
        if ($request->discover === 'popular') {
            $query->orderByDesc('views');
        } elseif ($request->discover === 'recent') {
            $query->latest();
        } else {
            $query->latest(); // Explore / Default
        }

        $featuredPost = (clone $query)->first();

        $posts = (clone $query)
            ->when($featuredPost, fn($q) => $q->where('id', '!=', $featuredPost->id))
            ->paginate(3)
            ->withQueryString();

        $trendingPosts = Post::query()
            ->published()
            ->with(['category'])
            ->orderByDesc('views')
            ->take(3)
            ->get();

        return view('home', [
            'featuredPost' => $featuredPost,
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $categories,
            'trendingPosts' => $trendingPosts,
        ]);
    }
}
