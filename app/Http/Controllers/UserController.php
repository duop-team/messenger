<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\SearchRequest;
use App\Http\Resources\UserBasicResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return new UserBasicResource(Auth::user());
    }

    public function show($user_id)
    {
        return new UserBasicResource(User::findOrFail($user_id));
    }

    public function search(SearchRequest $request)
    {
        if ($request->has('nickname')) {
            return UserBasicResource::collection(User::where('nickname', 'LIKE', '%' . $request->nickname . '%')->get());
        } else if ($request->has('phone')) {
            return UserBasicResource::collection(User::where('phone', 'LIKE', '%' . $request->phone . '%')->get());
        }
    }

    public function edit(EditRequest $request)
    {
        $user = Auth::user();
        if ($request->has('name')) {
            $user->update(['name' => $request->name]);
        } else if ($request->has('about')) {
            $user->update(['about' => $request->about]);
        }
        return $user;
    }
}
