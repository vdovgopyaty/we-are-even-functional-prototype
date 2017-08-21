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
        foreach ($event->purchases as $purchase) {
            $average = $purchase->amount / $purchase->buyers_count;
            foreach ($purchase->buyers as $buyer) {
                $id = $buyer->id;
                $amount = $average - $buyer->pivot->amount;
                if (array_key_exists($id, $debts)) {
                    $debts[$id] += $amount;
                } else {
                    if ($amount != 0) {
                        $debts[$id] = $amount;
                    }
                }
            }
        }

        $debts = Event::totalDebtsToPersonalDebts($debts);

        return $debts;
    }

    /**
     * Bring the total debts to the form of personal debts
     * with a minimum number of transactions between participants
     *
     * @param $totalDebts
     * @return array
     */
    private static function totalDebtsToPersonalDebts($totalDebts)
    {
        $debts = [];

        while (!empty($totalDebts)) {
            $max = max($totalDebts);
            $min = min($totalDebts);
            $maxKey = array_keys($totalDebts, $max)[0];
            $minKey = array_keys($totalDebts, $min)[0];

            $min = abs($min);
            $log[] = $max - $min;
            if (abs($max - $min) < 0.001) {
                unset($totalDebts[$maxKey]);
                unset($totalDebts[$minKey]);
            } elseif ($max > $min) {
                unset($totalDebts[$minKey]);
                $totalDebts[$maxKey] = $max - $min;
            } else {
                unset($totalDebts[$maxKey]);
                $totalDebts[$minKey] = $max - $min;
            }

            // TODO: fix multiple database requests
            $debts[] = [
                'from' => Buyer::find($maxKey)->name,
                'to' => Buyer::find($minKey)->name,
                'amount' => min($max, $min)
            ];
        }

        return $debts;
    }
}
