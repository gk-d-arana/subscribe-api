<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//add route for subscribing
Route::post('/subscribe', [WebsiteController::class, 'subscribe']);

//add route for adding post
Route::post('/posts', [PostController::class, 'store']);

//route to show post based on id
Route::get('/posts/{id}', [PostController::class, 'show']);

//route for getting website posts
Route::get('/websites/{id}/posts', [WebsiteController::class, 'getPosts']);




