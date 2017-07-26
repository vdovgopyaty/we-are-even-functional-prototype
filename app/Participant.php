<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'name',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function purchases()
    {
        return $this->belongsToMany('App\Purchase');
    }
}
