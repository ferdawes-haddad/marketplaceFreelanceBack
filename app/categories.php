<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{

    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    protected $table = "categories";

}
