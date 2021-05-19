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
    Route::get('/users', [UserController::class, 'index']);

    Route::get('/users/{user_id}', [UserController::class, 'show']);

    Route::post('/users/search', [UserController::class, 'search']);  // ????

    Route::get('/users/chats', [ChatController::class, 'index']);

    Route::get('/chats/{chat_id}', [ChatController::class, 'show']);

    Route::post('/chats', [ChatController::class, 'store']);

    Route::delete('/chats/{chat_id}', [ChatController::class, 'destroy']);

    Route::get('/chats/{chat_id}/participants', [ParticipantController::class, 'index']);

    Route::post('/chats/{chat_id}/participants', [ParticipantController::class, 'store']); // ????

    Route::post('/chats/{chat_id}/participants/{user_id}', [ParticipantController::class, 'destroy']);

    Route::delete('/chats/messages/{messages_id}', [MessageController::class, 'destroy']); // ????

    Route::post('/chats/{chat_id}/messages', [MessageController::class, 'store']);

    Route::get('/chats/{chat_id}/messages', [MessageController::class, 'index']);

    Route::patch('/chats/messages/{message_id}', [MessageController::class, 'update']);

    Route::post('/chats/{chat_id}/media', [MediaController::class, 'chatUploadImage']);

    Route::get('/chats/{chats_id}/media', [MediaController::class, 'chatUnloadImage']);

    Route::post('/users/{user_id}/media', [MediaController::class, 'userUploadImage']);

    Route::get('/users/{user_id}/media', [MediaController::class, 'userUnloadImage']);
});
