<?php

namespace App\Http\Resources;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatParticipantsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'about' => $this->about,
            'owner' => new UserBasicResource(User::where('id', $this->user_id)->first()),
            'photo' => new MediaResource(Media::where('id', $this->media_id)->first()),
            'participants' => UserBasicResource::collection(User::with('participants')->get()),
        ];
    }
}
