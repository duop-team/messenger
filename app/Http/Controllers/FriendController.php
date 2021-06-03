<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        return FriendResource::collection(Friend::where('user_id', Auth::id())->firstOrFail()->get());
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
        return Friend::where('friend_id', $friend_id)->where('user_id', Auth::id())->firstOrFail()->delete();
    }
}
