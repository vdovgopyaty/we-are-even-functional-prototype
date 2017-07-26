<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'id' => 'RUB',
                'code' => 'RUB',
                'symbol' => '₽',
                'symbol_native' => 'руб.',
                'name' => 'Russian Ruble',
                'name_plural' => 'Russian rubles',
                'decimal_digits' => 2,
                'rounding' => 0,
            ],
            [
                'id' => 'USD',
                'code' => 'USD',
                'symbol' => '$',
                'symbol_native' => '$',
                'name' => 'US Dollar',
                'name_plural' => 'US dollars',
                'decimal_digits' => 2,
                'rounding' => 0,
            ],
            [
                'id' => 'EUR',
                'code' => 'EUR',
                'symbol' => '€',
                'symbol_native' => '€',
                'name' => 'Euro',
                'name_plural' => 'euros',
                'decimal_digits' => 2,
                'rounding' => 0,
            ],
        ]);
    }
}
