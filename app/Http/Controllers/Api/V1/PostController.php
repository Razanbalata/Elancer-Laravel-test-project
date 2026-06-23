<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostJsonApiResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Throwable;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware()
    { // to run middleware from controller not from routes
        return [
            new Middleware('auth:sanctum', [], ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::published()
            ->with(['category:id,name', 'user:id,name,username,avatar'])
            ->paginate();
         return $posts->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, PostService $postService): JsonResponse
    {
        try {
            /** 
             * @var \App\Models\User
             */
            $user = Auth::guard('sanctum')->user();
            if (!$user->currentAccessToken()->can('posts.create')) {
                return Response::json([
                    'status' => 'forbidden',
                    'message' => 'You are not allowed to create posts'
                ], 403);
            };


            $post = $postService->create($request);
            return Response::json([
                'data' => $post->refresh(),
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create post: ' . $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) // Route model binding
    {
        // with() use for qery builder but load use with the obj itself
        // Accept : application/json (requset header to show what data i need to recieve)
         $post->load(['category:id,name', 'user:id,name,username']);
         return $post->toResource(PostJsonApiResource::class);
         }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, PostService $service, Post $post)
    {
        try {
            $post = $service->update($post, $request);
            return Response::json([
                'data' => $post->refresh(),
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create post: ' . $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return Response::noContent(); // return 204 status mean that no body
    }
}
