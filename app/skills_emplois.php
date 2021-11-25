<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skills_emplois extends Model
{
    public $timestamps = false;
    protected $fillable = ['titre','type'];
}
