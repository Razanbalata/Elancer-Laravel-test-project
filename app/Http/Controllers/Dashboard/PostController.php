<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\FileUpload;
use App\Actions\SyncPostTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

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

        $user = Auth::user();
        //$posts = $user->posts; // use magic methods by __get() to search if there is a function with the name posts() in the User model and call it to get the posts of the user

        $posts = $user->posts()
            ->with('category') // to solve N+1 problem by eager loading the category relationship for all posts in one query instead of querying for each post separately when accessing $post->category in the view
            ->select('posts.*')
            //  ->addSelect(
            //     DB::raw('(Select COUNT(*) from comments where comments.post_id = posts.id ) AS comments_count
            //  '))
            ->withCount('comments') // aggregate function to count the number of comments for each post and add it as a new attribute comments_count to the post model so we can access it in the view as $post->comments_count without needing to load all comments and count them in PHP which would cause N+1 problem 
            ->where("status", $status)
            ->get();
        // ->where("user_id", Auth::id())
        // ->latest()->get();
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
    public function store(PostRequest $request, FileUpload $fileUpload, SyncPostTags $syncPostTags)
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
       // $post = Post::create($data);
        // Transaction to ensure data integrity when creating a post and its associated tags, so if any error occurs during the process, the transaction will be rolled back and no partial data will be saved to the database
        DB::beginTransaction();
        try {
            $post = Post::create($data);
            $syncPostTags->handle($post, $clean['tags'] ?? '');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return back()
                ->withInput() // for old input values to be available in the form fields after redirecting back to the form
                ->withErrors(['msg' => 'Error creating post: ' . $e->getMessage()]); // for the error message to be available in the view after redirecting back to the form
        }

        // Create tags and associate with the post
        // $tags = explode(',', $clean['tags'] ?? '');
        // $tags_ids = [];
        // foreach ($tags as $tag_name) {
        //     $tag_name = trim($tag_name);
        //     if (empty($tag_name)) {
        //         continue;
        //     }
        //     $tag = \App\Models\Tag::firstOrCreate([
        //         'name' => $tag_name,
        //         'slug' => Str::slug($tag_name),
        //     ]);
        //     $tags_ids[] = $tag->id;
        // }
        // $post->tags()->sync($tags_ids);

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
    public function update(PostRequest $request, FileUpload $fileUpload, string $id, SyncPostTags $syncPostTags)
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
         DB::transaction(function () use ($post, $data, $syncPostTags, $clean) {
                $post->update($data);
                $syncPostTags->handle($post, $clean['tags'] ?? '');
            });
      
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
