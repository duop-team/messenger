<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/chats', [ChatController::class, 'index']);

    Route::get('/user', [UserController::class, 'index']);

    Route::get('/users/{id}', function ($id) {
        return User::findOrFail($id);
    });

    Route::post('/chats/create', [ChatController::class, 'store']);

});
