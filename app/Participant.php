<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function purchases()
    {
        return $this->belongsToMany('App\Purchase');
    }
}
