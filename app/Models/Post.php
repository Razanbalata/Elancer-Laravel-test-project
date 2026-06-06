<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Post extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'slug',
        'excerpt',
        'cover_image',
        'status',
        'views',
        'published_at',
        'meta'
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'meta' => 'json',
            'status' => PostStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->withDefault([
                'name' => 'Uncategorized',
            ]);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post-tag', 'post_id', 'tag_id');
    }
    public function content(): Attribute // mutator
    {
        return new Attribute(
            set: fn($value) => strip_tags($value, '<h2><h3></h3><h4></h4><h5></h5><h6></h6><a></a><p></p><ol></ol><ul></ul><li></li><br><strong></strong><em></em><img><video></video><audio></audio><h1>')
        );
    }
    public function title(): Attribute // accessor
    {
        return new Attribute(
            get: fn($value) => ucwords($value)
        );
    }
    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn() => $this->cover_image ? asset('storage/' . $this->cover_image) : asset('images/default-thumbnail.jpg')
            // get:fun()=>$this->cover_image ? Storage::disk('public')->url($this->cover_image):null)
        );
    }
    public function publishTime(): Attribute
    {
        return new Attribute(
            get: fn($value) => $this->published_at ?? $this->created_at,

        );
    }
}
