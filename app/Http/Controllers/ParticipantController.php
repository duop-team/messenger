<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index($id)
    {
        return Chat::findOrFail($id)->participants;
    }

    public function store(Request $request, $id)
    {
        User::findOrFail($request->user_id);
        $participant = Participant::where('user_id', $request->user_id)->where('chat_id', $id)->first();
        if (!$participant) {
            return Participant::create([
                'chat_id' => $id,
                'user_id' => $request->user_id
            ]);
        }
        abort(400);
    }

    public function destroy(Request $request, $id)
    {
        return Participant::where('user_id', '=', $request->user_id)->where('chat_id', $id)->firstOrFail()->delete();

    }
}
