<?php

namespace App\Http\Resources;

use App\Models\Chat;
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
        $data = [];
        foreach ($this->participants as $item) {
            array_push($data, $item->user_id);
        }

        return [
            'owner' => new UserBasicResource(User::where('id', $this->user_id)->first()),
            'participants' => UserBasicResource::collection(User::findMany($data)),
        ];
    }
}
