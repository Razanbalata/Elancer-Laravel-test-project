<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
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
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    }
 
    public function category():BelongsTo{
        return $this->belongsTo(Category::class,'category_id','id')
        ->withDefault([
            'name' => 'Uncategorized',
        ]);
    }
    public function comments():HasMany{
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'post-tag','post_id','tag_id');

    }
}
