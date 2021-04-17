<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
//        return Auth::user()->chats;
        $participant = Participant::select('chat_id')->where('user_id', Auth::id());
        return Chat::whereIn('id', $participant)->get();
    }

    public function store(Request $request)
    {
        $chat = Auth::user()->chats()->create([
            "title" => $request->title,
            "about" => $request->about
        ]);

        $chat->participants()->create([
            'user_id' => Auth::id(),
            'access_rule_id' => null
        ]);

        return $chat;
    }

    public function show($id)
    {
        return Chat::findOrFail($id);
    }

    public function destroy($id)
    {
        return Chat::findOrFail($id)->delete();
    }
}
