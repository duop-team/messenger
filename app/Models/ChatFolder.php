<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatFolder extends Model
{
    use HasFactory;

    protected $table = 'chat_folder';

    protected $fillable = ['chat_id', 'folder_id'];

    public $timestamps = false;

}
