<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PostsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/sitemap', [PostsController::class, 'sitemap'])->name('posts.sitemap');
    Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store')->middleware('origin');
    Route::patch('/posts/{post}', [PostsController::class, 'update'])->name('posts.update')->middleware('origin');
    Route::post('/auth/reg', [AuthController::class, 'register']);
    Route::get('/origin', function () {
        return request()->server('HTTP_REFERER');
    });
});
