<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skills extends Model
{
    public $timestamps = false;
    protected $fillable = ['titre'];

    public function emplois()
    {
        return $this->belongsToMany(emplois::class);
    }

    public function users()
    {
        return $this->belongsToMany('App\user');
    }

    public function user_skills()
    {
        return $this->hasMany('App\user_skills');
    }

}
