<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public $timestamps = false;
    protected $fillable = ['nature_demande', 'date_livrable'];

    protected $table = "missions";

    public function categories()
    {
        return $this->hasMany(categories::class);
    }
}
