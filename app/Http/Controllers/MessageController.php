<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(MessageRequest $request, $chat_id)
    {
        if (!Participant::where('chat_id', $chat_id)->where('user_id', Auth::id())->first()) {
            return response()->noContent(403);
        }
      
        $message = Auth::user()->messages()->create([
            'text' => $request->text,
            'chat_id' => $id
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return new MessageResource($message);
    }

    public function index($chat_id)
    {
        return MessageResource::collection(Message::all()->where('chat_id', '=', $chat_id));
    }

    public function destroy($message_id)
    {
        return Message::findOrFail($message_id)->delete();
    }

    public function update(MessageRequest $request, $message_id)
    {
        return Message::findOrFail($message_id)->update([
            'text' => $request->text
        ]);
    }
}
