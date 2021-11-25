<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'titre',
        'description',
        'nom',
        'email',
        'date',
        'image',
        'commentaire_id'
    ];
}
