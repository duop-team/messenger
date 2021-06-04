<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $friend = Friend::where('user_id', Auth::id())->get();
        if ($friend->isEmpty()) {
            return response()->noContent(404);
        }
        return FriendResource::collection($friend);
    }

    public function store(Request $request)
    {
        $temp = User::where('nickname', $request->nickname)->first();
        if (Friend::where('user_id', Auth::id())->where('friend_id', $temp->id)->first() || $temp->id == Auth::id()) {
            return response()->noContent(400);
        }
        return Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $temp->id
        ]);
    }

    public function delete($friend_id)
    {
        $friend = Friend::where('friend_id', $friend_id)->where('user_id', Auth::id())->first();
        if (!$friend) {
            return response()->noContent(404);
        }
        return $friend->delete();
    }
}
