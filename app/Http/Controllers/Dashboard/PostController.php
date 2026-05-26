<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'published');
        $status_options =  array_map(function ($value) {
            return [
                'name' => ucfirst($value),
                'count' => Post::query()->where("status", $value)->count()
            ];
        }, [
            'published' => 'Published',
            'draft' => 'Draft',
            'archived' => 'Archived'
        ]);
        $posts = Post::query()->where("status", $status)
        ->where("user_id", Auth::id())
        ->latest()->get();
        return view('dashboard.posts.index', [
            'posts' => $posts,
            'status_options' => $status_options,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', [
            'post' => new Post(),
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, FileUpload $fileUpload)
    {
        // $cover_image_path = null;
        // if ($request->hasFile('cover')) {
        //     $image = $request->file('cover'); // uploadedfile instance
        //     $name = Str::random(20) . "-" . $image->getClientOriginalName();
        //     // $image->storeAs("covers",$name,[
        //     //   'disk'=>'public' // store in storage/app/public/covers
        //     // ]);  
        //     $cover_image_path = $image->store("covers", [
        //         'disk' => 'public' // store in storage/app/public/covers
        //     ]); // return covers/filename....
        //     // $image->getClientOriginalExtension(); // eg: jpg 
        //     // $image->getClientOriginalName(); // e.g : 'myphoto.jpg' the file name from user

        // }


        // $fileupload = app(FileUpload::class); // new way to use the class in the function
        $clean = $request->validated();

        // $clean = $request->validate(, [
        //     'required' => ':attribute is Required!',
        //     'title.required' => 'Please provide a title for the post',
        // ]);

        $data = array_merge($clean, [
            'user_id' => Auth::id(),
            'slug' => Str::slug($request->post('title')),
            'status' => "published",
            // 'cover_image' => $cover_image_path
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers')
        ]);
        
        Post::create($data);

        #PRG => Post Redirect Get
        return redirect()
        ->route("dashboard.posts.index")
        ->with('status', 'Post created successfully!');

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
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, FileUpload $fileUpload, string $id)
    {
        $post = Post::findOrFail($id);
        // $cover_image_path = $post->cover_image;
        // if ($request->hasFile('cover')) {
        //     $image = $request->file('cover');
        //     $cover_image_path = $image->storePublicly('covers', [
        //         'disk' => 'public'
        //     ]);
        // }
        // $request->merge([
        //     // 'cover_image' => $cover_image_path,
        //     'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers'),
        // ]);
        $clean = $request->validated();
        $data = array_merge($clean, [

            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers'),
        ]);

        $post->update($data);

        $previous = $post->getPrevious();
        $prev_cover_image = $previous['cover_image'] ?? null;
        if ($prev_cover_image !== $post->cover_image) {
            Storage::disk('public')->delete($previous['cover_image']);
        }

        return redirect()
        ->route("dashboard.posts.index")
        ->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Post::destroy($id); 
        $post = Post::findOrFail($id);
        $post->delete();
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        return redirect()
        ->route("dashboard.posts.index")
        ->with('status', 'Post deleted successfully!');
    }
}
