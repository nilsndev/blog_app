<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user',[UserController::class,'user']);
    Route::post('logout',[UserController::class,'logout']);
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'getAllBlogs']);
    Route::get('/byuser/{uID}',[BlogController::class,'getAllBlogsByUID']);
    Route::get('/{id}', [BlogController::class, 'getOneBlog']);
    Route::post('/', [BlogController::class, 'addBlog']);
    route::delete('/{id}',[BlogController::class,'delete']);
    route::patch('/', [BlogController::class,'updateABlog']);
});


