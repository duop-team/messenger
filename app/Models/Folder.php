<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $table = 'folders';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }
}
