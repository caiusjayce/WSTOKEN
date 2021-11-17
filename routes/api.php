<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AirPlaneFlightControllerAPI;
use App\Http\Controllers\API\PostController;

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

Route::get('test-query', [UsersController::class, 'testQuery']);
Route::post('login', [AirPlaneFlightControllerAPI::class, 'login']);
Route::post('register', [AirPlaneFlightControllerAPI::class, 'register']);

//POSTS
Route::get('get-all-posts', [PostController::class, 'getAllPosts']);
Route::get('get-post', [PostController::class, 'getPost']);
Route::get('search-post', [PostController::class, 'searchPost']);