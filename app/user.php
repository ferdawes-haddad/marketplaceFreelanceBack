<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class user extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public $user;
    public $timestamps = false;
    protected $fillable = ['image','nom','prenom','telephone','email','password', 'confirmPassword','role','adresse',
        'emplois_id','mission_id','article_id'
    ];



    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function skyles()
    {
        return $this->belongsToMany('App\skyles');
    }

    public function emplois_skyles()
    {
        return $this->hasMany('App\user_skyles');
    }


    public function newUserNotification()
    {
        $this->user->notify(new user($this->user));
    }

}
