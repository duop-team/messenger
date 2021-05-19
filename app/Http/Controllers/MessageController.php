<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request, $chat_id)
    {
//        TODO: check if sender is participant
        $message = new MessageResource(Auth::user()->messages()->create([
            'text' => $request->text,
            'chat_id' => $chat_id
        ]));

        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }

    public function index($chat_id)
    {
        return MessageResource::collection(Message::all()->where('chat_id', '=', $chat_id));
    }

    public function destroy($message_id)
    {
        return Message::findOrFail($message_id)->delete();
    }

    public function update(Request $request, $message_id)
    {
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 422);
        }

        return Message::findOrFail($message_id)->update([
            'text' => $request->text
        ]);
    }
}
