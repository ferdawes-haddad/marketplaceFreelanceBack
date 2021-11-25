<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cvs extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'post_employer','date_debut','date_fin',
        'nom_etablisement','ville_etablisement','domain_etude','date_diplome','user_id'
    ];

    public function userName() {
        return $this->belongsTo(user::class , 'user_id');
    }
}
