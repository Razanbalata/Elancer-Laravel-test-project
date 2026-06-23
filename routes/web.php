<?php

use App\Http\Controllers\AdminDashboard\UserController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\EnsureUserType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::get('/', HomeController::class)->name('home');
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

// Route::group([
//     'as'=>'dashboard.',
//     'prefix'=>'dashboard/'
// ], function () {
//     Route::put('posts/{post}/restore', [DashboardPostController::class, 'restore'])->name('posts.restore');
//     Route::delete('posts/{post}/force', [DashboardPostController::class, 'forceDelete'])->name('posts.forceDelete');

//     Route::resource('posts', DashboardPostController::class);

//     Route::group([
//         'as'=>'notifications.',
//     'prefix'=>'notifications/',
//     'controller'=>NotificationController::class
//     ],function(){
//         Route::get('/','index')->name('index');
//         Route::patch('/{id}/read','read')->name('read'); // make it get to test the route if it is running but the right way is patch
//         Route::patch('/{id}/unread','unread')->name('unread');
//         Route::delete('/{id}/delete','destroy')->name('delete');
//     });
// });
// Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
// Route::get('/u/{username}',function(){})->name('users.profile');
// Route::post('user/{id}/follow',[FollowController::class,'store'])->name('users.follow')->middleware('auth:web');
// Route::delete('users/{id}/unfollow',[FollowController::class,'destroy'])->name('users.unfollow')->middleware('auth:web');
// Route::group([
//     'as'=>'dashboard.',
//     'prefix'=>'dashboard/',
//     'middleware'=>['auth', 'active']
// ], function () {
//     Route::resource('categories', DashboardCategoryController::class);
// });

// Route::resource('admin/users',UserController::class)
// ->middleware(['auth','active','type:super-admin,admin']);

// Route::get('/account-inactive', function () {
//     return view('account-inactive');
// })->name('account.inactive');


// Route::middleware(['auth', 'active'])
//     ->prefix('dashboard')
//     ->name('dashboard.')
//     ->group(function () {

//         Route::resource('categories', DashboardCategoryController::class);

//         Route::resource('posts', DashboardPostController::class);

//         Route::get('/', function () {
//             return view('home');
//         })->name('home');
// });



/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', HomeController::class)->name('home');


/*
|--------------------------------------------------------------------------
| Public Posts
|--------------------------------------------------------------------------
*/
Route::get('/posts/{slug}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('/u/{username}', function () {
    // profile page
})->name('users.profile');


/*
|--------------------------------------------------------------------------
| Follow System (Web only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:web'])->group(function () {

    Route::post('user/{id}/follow', [FollowController::class, 'store'])
        ->name('users.follow');

    Route::delete('users/{id}/unfollow', [FollowController::class, 'destroy'])
        ->name('users.unfollow');
});


/*
|--------------------------------------------------------------------------
| Dashboard (User Panel)
| auth + active users only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        Route::get('/', function () {
            return view('dashboard.home');
        })->name('home');

        Route::resource('categories', DashboardCategoryController::class);

        Route::resource('posts', DashboardPostController::class);

        /*
        | Notifications
        */
        Route::prefix('notifications')
            ->name('notifications.')
            ->controller(NotificationController::class)
            ->group(function () {

                Route::get('/', 'index')->name('index');

                Route::patch('{id}/read', 'read')->name('read');

                Route::patch('{id}/unread', 'unread')->name('unread');

                Route::delete('{id}/delete', 'destroy')->name('delete');
            });
    });


/*
|--------------------------------------------------------------------------
| Admin Panel (Users Management)
| Only super-admin or admin
|--------------------------------------------------------------------------
*/
Route::resource('admin/users', UserController::class)
    ->middleware(['auth', 'active', 'type:super-admin,admin']);


/*
|--------------------------------------------------------------------------
| Account Inactive Page
|--------------------------------------------------------------------------
*/
Route::get('/account-inactive', function () {
    return view('account-inactive');
})->name('account.inactive');


Route::resource('roles', RoleController::class);
