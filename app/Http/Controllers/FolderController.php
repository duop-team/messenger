<?php

namespace App\Http\Controllers;


use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\ChatFolder;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function index()
    {
        return Auth::user()->folders()->get();
    }

    public function store(Request $request)
    {
        $folder = Auth::user()->folders()->create([
            'name' => $request->name
        ]);
        return $folder;
    }

    public function destroy($folder_id)
    {
        return Folder::findOrFail($folder_id)->delete();
    }
}
