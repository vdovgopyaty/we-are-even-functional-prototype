<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'name',
    ];

//    public static function createParticipant(User $user)
//    {
//        $participant = new Participant([
//            'name' => $user->name,
//        ]);
//        $participant->save();
//    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function purchases()
    {
        return $this->belongsToMany('App\Purchase');
    }
}
