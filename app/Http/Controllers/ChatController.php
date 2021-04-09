<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return $user->chats;
    }

    public function store(Request $request)
    {
        return Chat::create([
            "title" => $request->title,
            "about" => $request->about,
            "user_id" => Auth::id(),
        ]);
    }

    public function show(Request $request)
    {
        return Chat::find($request->id);
    }

    public function destroy(Request $request)
    {
        $chat = Chat::find($request->id);
        return $chat->delete();
    }
}
