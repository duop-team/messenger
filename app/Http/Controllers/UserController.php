<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $id = Auth::id();
            return User::findOrFail($id);
        } else {
            return null;
        }
    }
}