<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillsCv extends Model
{
    public function cvs()
    {
        return $this->belongsTo('App\cvs');
    }

    public function skills()
    {
        return $this->belongsTo('App\skills');
    }
}
