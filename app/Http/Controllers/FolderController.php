<?php

namespace App\Http\Controllers;


use App\Http\Requests\FolderRequest;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function index()
    {
        return FolderResource::collection(Auth::user()->folders()->get());
    }

    public function store(FolderRequest $request)
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
