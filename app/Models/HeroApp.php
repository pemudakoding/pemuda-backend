<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroApp extends Model
{
    protected $fillable = [
        'title', 'description', 'type', 'background'
    ];

    public function getBackgroundAttribute($value)
    {
        return url('storage/' . $value);
    }
}
