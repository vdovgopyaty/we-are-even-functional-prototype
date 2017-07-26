<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'place', 'description', 'image',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }
}
