<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'about', 'user_id', 'media_id'];

    protected $table = 'chats';

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
