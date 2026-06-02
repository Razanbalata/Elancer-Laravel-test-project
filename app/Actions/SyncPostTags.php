<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Str;

class SyncPostTags
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function handle(Post $post, string|array $tags): void
    {
        $tags = is_string($tags) ? explode(',', $tags) : $tags;
        $tags_ids = [];
        foreach ($tags as $tag_name) {
            $tag_name = trim($tag_name);
            if (empty($tag_name)) {
                continue;
            }
            $tag = \App\Models\Tag::firstOrCreate([
                'name' => $tag_name,
                'slug' => Str::slug($tag_name),
            ]);
            $tags_ids[] = $tag->id;
        }
        $post->tags()->syncWithoutDetaching($tags_ids);
    }
}
