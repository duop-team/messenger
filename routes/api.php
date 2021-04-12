<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParticipantController;
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

    Route::get('/chats/{id}/participants', [ParticipantController::class, 'index']);

    Route::post('/chats/{id}/participants/create', [ParticipantController::class, 'store']);

    Route::delete('/chats/{id}/messages/delete', [MessageController::class, 'destroy']);

    Route::post('/chats/{id}/messages/send', [MessageController::class, 'store']);

    Route::get('/chats/{id}/messages', [MessageController::class, 'index']);

    Route::delete('/chats/{id}/delete', [ChatController::class, 'destroy']);

    Route::get('/chats/{id}', [ChatController::class, 'show']);

    Route::post('/chats/create', [ChatController::class, 'store']);
});
