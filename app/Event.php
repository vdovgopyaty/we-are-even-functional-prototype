<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $fillable = [
        'name', 'place', 'description', 'image',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this['user_id'] = Auth::id();
    }

//    public function __construct(array $attributes = [])
//    {
//        parent::__construct($attributes);
//
//        Participant::createParticipant(Auth::user());

//        $participant = new Participant();
//        $participant->name = $this->user()->name;
//        $participant->event_id = $this->id;
//        $participant->save();
//    }

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
