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

    public function update(Request $request, $id, $mid)
    {
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 422);
        }

        return Message::findOrFail($mid)->update([
            'text' => $request->text
        ]);
    }
}
