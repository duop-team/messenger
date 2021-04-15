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
        return Auth::user()->chats;
    }

    public function store(Request $request)
    {
//        TODO: add creator of chat to participants
        return Auth::user()->chats()->create([
            "title" => $request->title,
            "about" => $request->about
        ]);
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
