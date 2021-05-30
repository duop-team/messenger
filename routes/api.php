<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Broadcast;
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


Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);

    Route::patch('/user', [UserController::class, 'edit']);

    Route::post('/user/search', [UserController::class, 'search']);

    Route::get('/user/chats', [ChatController::class, 'index']);

    Route::get('/user/{user_id}', [UserController::class, 'show']);

    Route::post('/user/{user_id}/media', [MediaController::class, 'userUploadImage']);

    Route::get('/user/{user_id}/media', [MediaController::class, 'userUnloadImage']);

    Route::post('/chats', [ChatController::class, 'store']);

    Route::patch('/chat/{chat_id}', [ChatController::class, 'edit']);

    Route::get('/chat/{chat_id}', [ChatController::class, 'show']);

    Route::delete('/chat/{chat_id}', [ChatController::class, 'destroy']);

    Route::get('/chat/{chat_id}/participants', [ParticipantController::class, 'index']);

    Route::post('/chat/{chat_id}/participants', [ParticipantController::class, 'store']);

    Route::post('/chat/{chat_id}/messages', [MessageController::class, 'store']);

    Route::get('/chat/{chat_id}/messages', [MessageController::class, 'index']);

    Route::get('/chat/{chats_id}/media', [MediaController::class, 'chatUnloadImage']);

    Route::post('/chat/{chat_id}/media', [MediaController::class, 'chatUploadImage']);

    Route::delete('/chat/{chat_id}/participant/{user_id}', [ParticipantController::class, 'destroy']);

    Route::patch('/message/{message_id}', [MessageController::class, 'update']);

    Route::delete('/message/{messages_id}', [MessageController::class, 'destroy']);
});
