<?php

namespace App\Services;

use App\Actions\FileUpload;
use App\Actions\SyncPostTags;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected FileUpload $fileUpload, protected SyncPostTags $syncTags)
    {
        //
    }
    public function create(PostRequest $request): Post
    {
        $clean = $request->validated();
        $data = array_merge($clean, [
            // 'user_id' => Auth::id(),
            //  'slug' => Str::slug($request->post('title')),
            'status' => "published",
            // 'cover_image' => $cover_image_path
            'cover_image' => $this->fileUpload->handle(key: 'cover', path: 'covers')
        ]);
        DB::beginTransaction();
        try {
            $post = Post::create($data);
            $this->syncTags->handle($post, $clean['tags'] ?? '');
            DB::commit();
            return $post;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
