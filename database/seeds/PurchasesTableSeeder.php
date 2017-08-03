<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchases')->insert([
            [
                'name' => 'Продукты',
                'event_id' => 1,
            ],
            [
                'name' => 'Аренда дома',
                'event_id' => 1,
            ],
            [
                'name' => 'Покупка второго пользователя',
                'event_id' => 3,
            ],
            [
                'name' => 'Билеты',
                'event_id' => 1,
            ],
            [
                'name' => 'Личная покупка в личном событии',
                'event_id' => 2,
            ],
        ]);
    }
}
