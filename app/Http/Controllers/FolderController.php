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
    public function create(Request $request)
    {
        $folder = Auth::user()->folders()->create([
            'name' => $request->name
        ]);
        return $folder;
    }

    public function index()
    {
        return Auth::user()->folders();
    }

    public function destroy($folder_id)
    {
        return Folder::findOrFail($folder_id)->delete();
    }

    public function store(Request $request, $folder_id)
    {
        $folder = ChatFolder::where('chat_id', $request->chat_id)->where('folder_id', $folder_id)->first();
        if (!$folder) {
            return ChatFolder::create([
                'chat_id' => $request->chat_id,
                'folder_id' => $folder_id
            ]);
        }
        abort(400);
    }

    public function deleteChatInFolder(Request $request, $folder_id)
    {
        return ChatFolder::where('chat_id', $request->chat_id)->where('folder_id', $folder_id)->first()->delete();
    }

    public function show($folder_id)
    {
        return ChatFolder::all()->where('folder_id', $folder_id);
    }

}
