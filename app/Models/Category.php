<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    // protected static function booted(){
    //     static::deleted(function(Category $category){
    //         $category->posts()->delete();
    //     });
    //     static::restored(function(Category $category){
    //         $category->posts->update([
    //             'deleted_at'=>null,
    //         ]);
    //     });
    // }
}