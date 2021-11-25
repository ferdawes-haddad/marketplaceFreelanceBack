<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emplois extends Model
{
    public $timestamps = false;
    protected $fillable = [ 'titre','description','adresse','salaire','status','date_creation','categories_id'
    , 'rating'];

    protected $table = "emplois";

    public function categoriesName() {
        return $this->belongsTo(categories::class , 'categories_id');
    }

    public function skyles()
    {
        return $this->belongsToMany(skyles::class, 'emplois_skyles',
        'emplois_skyles','emplois_id','skyles_id');
    }

    public function usersName() {
        return $this->belongsTo(user::class , 'user_id');
    }
}
