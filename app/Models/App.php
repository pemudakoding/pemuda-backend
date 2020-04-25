<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = [
        'app_name', 'logo', 'email', 'number',
        'address', 'facebook', 'instagram', 'twitter'
    ];

    public function getLogoAttribute($value)
    {
        return url('storage/' . $value);
    }
}
