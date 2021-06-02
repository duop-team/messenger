<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        $friend = Friend::where('user_id', 1)->get();
        if ($friend->isEmpty()) {
            return response()->noContent(404);
        }
        return FriendResource::collection($friend);
    }

    public function store($friend_id)
    {
        if (Friend::where('user_id', Auth::id())->where('friend_id', $friend_id)->first() || $friend_id == Auth::id()) {
            return response()->noContent(400);
        }
        return Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $friend_id
        ]);
    }

    public function delete($friend_id)
    {
        $friend = Friend::where('friend_id', $friend_id)->where('user_id', 1)->first();
        if (!$friend) {
            return response()->noContent(404);
        }
        return $friend->delete();
    }
}
