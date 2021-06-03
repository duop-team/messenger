<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBasicResource extends JsonResource
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
            'full_name' => $this->name,
            'nickname' => $this->nickname,
            'phone' => $this->phone,
            'photo' => new MediaResource(User::findOrFail($this->id)->media),
        ];
    }
}
