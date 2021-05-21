<?php

namespace App\Http\Controllers;

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
        return User::findOrFail($user_id);
    }

    public function search(Request $request) {
        return User::where('nickname', 'LIKE', '%'.$request->nickname.'%')->get();
    }
}
