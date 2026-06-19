<?php

use App\Http\Controllers\Api\V1\AccessTokenController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Support\Facades\Route;

Route::post('auth/access-tokens',[AccessTokenController::class,'store'])
->middleware('guest:sanctum'); 

Route::post('auth/access-tokens/{token?}',[AccessTokenController::class,'destroy'])
->middleware('guest:sanctum'); 


Route::apiResource('posts',PostController::class)
->middlewareFor(['store','update','destroy'],['auth:sanctum']);

