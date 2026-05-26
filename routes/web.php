<?php

use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
// Route::get("/posts/{id}/{slug}",[PostController::class,"show"])
//  ->where([
//     "slug"=>"[a-z0-9\-]+"
//  ])
// ;
// Route::get('/posts',function(){
//    $post = \App\Models\Post::all();
//    dd($post);
// });

// Route::get('dashboard/posts',[DashboardPostController::class,'index'])
// ->name('posts.index');
// Route::get('dashboard/posts/create',[DashboardPostController::class,'create'])
// ->name('posts.create');
// Route::post('dashboard/posts',[DashboardPostController::class,'store'])
// ->name('posts.store');
// Route::get('dashboard/posts/{id}',[DashboardPostController::class,'show'])
// ->name('posts.show');
// Route::get('dashboard/posts/{id}/edit',[DashboardPostController::class,'edit'])
// ->name('posts.edit');
// Route::put('dashboard/posts/{id}',[DashboardPostController::class,'update'])
// ->name('posts.update');
// Route::delete('dashboard/posts/{id}',[DashboardPostController::class,'destroy'])
// ->name('posts.destroy');

//  Route::resource('dashboard/posts',PostController::class)->names([
//     "index"=>"dashboard.posts.index",
//     "create"=>"dashboard.posts.create",
//     "store"=>"dashboard.posts.store",
//     "show"=>"dashboard.posts.show",
//     "edit"=>"dashboard.posts.edit",
//     "update"=>"dashboard.posts.update",
//     "destroy"=>"dashboard.posts.destroy"
//  ]);

Route::group([
    'as'=>'dashboard.',
    'prefix'=>'dashboard/'
], function () {
    Route::resource('posts', DashboardPostController::class);
});

Route::group([
    'as'=>'dashboard.',
    'prefix'=>'dashboard/',
    'middleware'=>'auth'
], function () {
    Route::resource('categories', DashboardCategoryController::class);
});