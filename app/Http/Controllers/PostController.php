<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Events\PostViewed;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected array $posts = [];

    public function __construct()
    {
        $this->posts = include resource_path("data/posts.php");
    }


    //
    public function index()
    {
        $posts = Post::query()->published()->get();
        return view('index', [
            'posts' => $posts,
        ]);
    }

    public function show(string $slug)
    {

        $post = Post::query()
            ->published()
            ->slug($slug)
            ->withBookmarkStatus()
            ->firstOrFail();
        
       // event('posts.viewed',$post);    
         broadcast(new PostViewed($post))->toOthers();
        return view("posts.show", [
            'post' => $post
        ]);
    }
}
