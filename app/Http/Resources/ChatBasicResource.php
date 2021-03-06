<?php

namespace App\Http\Resources;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatBasicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'about' => $this->about,
            'photo' => new MediaResource(Media::where('id', $this->media_id)->first()),
        ];
    }
}
