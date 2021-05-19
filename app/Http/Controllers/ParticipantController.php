<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index($chat_id)
    {
        return Chat::findOrFail($chat_id)->participants;
    }

    public function store(Request $request, $chat_id)
    {
        User::findOrFail($request->user_id);
        $participant = Participant::where('user_id', $request->user_id)->where('chat_id', $chat_id)->first();
        if (!$participant) {
            return Participant::create([
                'chat_id' => $chat_id,
                'user_id' => $request->user_id
            ]);
        }
        abort(400);
    }

    public function destroy($chat_id, $user_id)
    {
        return Participant::where('user_id', '=', $user_id)->where('chat_id', $chat_id)->firstOrFail()->delete();
    }
}
