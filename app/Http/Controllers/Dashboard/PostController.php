<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //    dd('store hit');

        $request->merge([
            'user_id'=>1,
            'slug'=>Str::slug($request->post('title'))
        ]) ;
        Post::create($request->all());
       
        #PRG => Post Redirect Get
        return redirect()->to('/dashboard/posts');

        // $post = Post::create([
        //     'title'=>$request['title'],
        //     'slug'=>$request['slug'],
        //     'excerpt'=>$request['excerpt'],
        //     'body'=>$request['body'],
        // ]);
        // $post->title = $request->post('title');
        // $post->body = $request->input('body');

        // $post->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $post = Post::find($id);
        // if(!$post){
        //     abort(404);
        // // } #  === abort_if(!$post,404) 

        $post = Post::findOrFail($id);
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->to("/dashboard/posts");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect()->to('/dashboard/posts');
    }
}
