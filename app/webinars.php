<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class webinars extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'titre',
        'date', 'user_id'
    ];
    protected $table = "webinars";

    public function usersName() {
        return $this->belongsTo(user::class , 'user_id');
    }


}
