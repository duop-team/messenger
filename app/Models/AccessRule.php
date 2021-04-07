<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRule extends Model
{
    use HasFactory;

    protected $table = 'access_rules';

    public $timestamps = false;

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
