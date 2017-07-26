<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function getCourse(Currency $currencyFrom, Currency $currencyTo)
    {
//        return $course;
    }

    public function convert(Currency $currencyFrom, Currency $currencyTo, $amount)
    {
//        return $amount;
    }
}
