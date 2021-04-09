<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        return Auth::user()->messages()->create([
            'text' => $request->text,
            'user_id' => Auth::id(),
            'chat_id' => $request->id,
        ]);
    }

    public function index(Request $request)
    {
        return Message::all()->where('chat_id', '=', $request->id);
    }

    public function destroy(Request $request)
    {
        return Message::find($request->id)->delete();
    }
}
