<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LevelUser extends Model
{


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
