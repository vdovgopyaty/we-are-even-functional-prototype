<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function participants()
    {
        return $this->belongsToMany('App\Participant');
    }
}
