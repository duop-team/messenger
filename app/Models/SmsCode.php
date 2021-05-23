<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['code', 'created_at', 'valid_time', 'timeout'];

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
