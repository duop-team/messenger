<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = ['user_id', 'chat_id', 'access_rule_id'];

    public $timestamps = false;

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
