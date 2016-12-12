<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
     public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function illustrations()
    {
        return $this->hasMany('App\Illustration');
    }
}
