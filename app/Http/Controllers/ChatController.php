<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\EditRequest;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\ChatBasicResource;
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
        $participant = Participant::select('chat_id')->where('user_id', Auth::id());
        return ChatBasicResource::collection(Chat::whereIn('id', $participant)->get());
    }

    public function store(StoreRequest $request)
    {
        $chat = Auth::user()->chats()->create([
            "title" => $request->title,
            "about" => $request->about
        ]);

        $chat->participants()->create([
            'user_id' => Auth::id()
        ]);
        if ($request->has('participants')) {
            foreach ($request->participants as $participant) {
                $chat->participants()->create([
                    'user_id' => User::where('nickname', $participant)->firstOrFail()->id
                ]);
            }
        }

        return $chat;
    }

    public function show($chat_id)
    {
        return new ChatBasicResource(Chat::findOrFail($chat_id));
    }

    public function edit(EditRequest $request, $chat_id)
    {
        $chat = Chat::findOrFail($chat_id);
        if ($request->has('about')) {
            $chat->update([
                'about' => $request->about
            ]);
        } elseif ($request->has('title')) {
            $chat->update([
                'title' => $request->title
            ]);
        }
        return $chat;
    }

    public function destroy($chat_id)
    {
        return Chat::findOrFail($chat_id)->delete();
    }
}
