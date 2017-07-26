<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'name', 'description', 'image',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Participant');
    }
}
