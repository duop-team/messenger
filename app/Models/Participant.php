<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    public function accessRules()
    {
        return $this->belongsTo(AccessRule::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function chats()
    {
        return $this->belongsTo(Chat::class);
    }
}
