<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'event_id',
    ];

    public $amount = 0;

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Participant')->withPivot('amount');
    }

    public function getAmountAttribute()
    {
        return $this->pivot->sum('amount');
    }
}
