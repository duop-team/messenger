<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Http\Resources\MediaResource;
use App\Models\Chat;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    private function uploadImage($image)
    {
        $currentMedia = Media::create([
            'content' => Storage::putFile('/public/media', $image),
        ]);
        return $currentMedia->id;
    }

    public function userUploadImage(ImageUploadRequest $request, $user_id)
    {
        if (Auth::id() !== $user_id) {
            return response()->noContent(403);
        }
        return User::findOrFail($user_id)->update(["media_id" => $this->uploadImage($request->image)]);
    }

    public function chatUploadImage(ImageUploadRequest $request, $group_id)
    {
        if (!Chat::where('user_id', Auth::id())->first()) {
            return response()->noContent(403);
        }
        return Chat::findOrFail($group_id)->update(["media_id" => $this->uploadImage($request->image)]);
    }

    public function userUnloadImage($user_id)
    {
        $userImage = User::findOrFail($user_id)->media;
        return new MediaResource($userImage);
    }

    public function chatUnloadImage($user_id)
    {
        $chatImage = Chat::findOrFail($user_id)->media;
        return new MediaResource($chatImage);
    }
}
