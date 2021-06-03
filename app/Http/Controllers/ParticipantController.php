<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatParticipantsResource;
use App\Models\Chat;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index($chat_id)
    {
        return ChatParticipantsResource::collection(Chat::with('participants')->where('id', $chat_id)->get());
    }

    public function store(Request $request, $chat_id)
    {
        if (empty($request->users)) {
            return response()->noContent(404);
        }
        foreach ($request->users as $user) {
            $temp = User::where('nickname', $user)->first();
            $participant = Participant::where('user_id', $temp->id)->where('chat_id', $chat_id)->first();
            if (!$participant) {
                Participant::create([
                    'chat_id' => $chat_id,
                    'user_id' => $temp->id
                ]);
            }
        }

        return response()->noContent(200);
    }

    public function destroy($chat_id, $user_id)
    {
        return Participant::where('user_id', $user_id)->where('chat_id', $chat_id)->firstOrFail()->delete();
    }
}
