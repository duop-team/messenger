<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, $id)
    {
//        TODO: check if sender is participant
        $message = new MessageResource(Auth::user()->messages()->create([
            'text' => $request->text,
            'chat_id' => $id
        ]));

        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }

    public function index(Request $request)
    {
        return MessageResource::collection(Message::all()->where('chat_id', '=', $request->id));
    }

    public function destroy(Request $request)
    {
        return Message::findOrFail($request->message_id)->delete();
    }
}
