<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function attachments()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function chats()
    {
        return $this->belongsTo(Chat::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
