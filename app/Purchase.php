<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'event_id',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function buyers()
    {
        return $this->belongsToMany('App\Buyer')->withPivot('amount');
    }

    public function getAmountAttribute()
    {
        return $this->buyers()->sum('amount');
    }
}
