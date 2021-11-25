<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_skills extends Model
{
    public function users()
    {
        return $this->belongsTo('App\user');
    }

    public function skills()
    {
        return $this->belongsTo('App\skills');
    }
}
