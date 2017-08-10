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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function buyers()
    {
        return $this->hasMany('App\Buyer');
    }

    public function getAmountAttribute()
    {
        $amount = 0;
        foreach ($this->purchases()->get() as $purchase) {
            $amount += $purchase->amount;
        }
        return $amount;
    }

    public static function calculateDebts(Event $event)
    {
        $debts = [];

        foreach ($event->purchases as $key => $purchase) {
            $average = $purchase->amount / $purchase->buyers_count;
            foreach ($purchase->buyers as $buyer) {
                if (array_key_exists($buyer->id, $debts)) {
                    $debts[$buyer->id] += $average - $buyer->pivot->amount;
                } else {
                    $debts[$buyer->id] = $average - $buyer->pivot->amount;
                }
            }
        }

        uasort($debts, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return (abs($a) > abs($b)) ? -1 : 1;
        });

        return $debts;
    }
}
