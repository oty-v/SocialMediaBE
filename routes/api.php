<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => '/posts'], function () {
        Route::get('/', [PostController::class, 'taggedPosts']);
        Route::post('/', [PostController::class, 'store']);
        Route::get('/{post}', [PostController::class, 'show']);
        Route::put("/{post}", [PostController::class, 'update'])->middleware('can:update,post');
        Route::delete("/{post}", [PostController::class, 'destroy'])->middleware('can:delete,post');
        Route::group(['prefix' => '/{post}/comments'], function () {
            Route::get("/", [CommentController::class, 'index']);
            Route::post('/', [CommentController::class, 'store']);
        });
    });
    Route::group(['prefix' => '/comments'], function () {
        Route::get('/{comment}', [CommentController::class, 'show']);
        Route::put("/{comment}", [CommentController::class, 'update'])->middleware('can:update,comment');
        Route::delete("/{comment}", [CommentController::class, 'destroy'])->middleware('can:delete,comment');
    });
    Route::group(['prefix' => '/users'], function () {
        Route::get("/", [UserController::class, 'index']);
        Route::get("/{user:username}", [UserController::class, 'show']);
        Route::get("/{user:username}/posts", [PostController::class, 'index']);
    });
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profiles/{profile}', [ProfileController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
