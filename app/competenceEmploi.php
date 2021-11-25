<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competenceEmploi extends Model
{
    public function emplois()
    {
        return $this->belongsTo('App\emplois');
    }

    public function skillsEmplois()
    {
        return $this->belongsTo('App\skills_emplois');
    }
}
