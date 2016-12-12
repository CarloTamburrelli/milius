<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function boards()
    {
        return $this->hasMany('App\Board');
    }
}
