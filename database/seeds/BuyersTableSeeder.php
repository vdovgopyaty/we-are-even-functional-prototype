<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buyers')->insert([
            [
                'name' => 'Владислав',
                'event_id' => 1,
            ],
            [
                'name' => 'Ольга',
                'event_id' => 1,
            ],
            [
                'name' => 'Пётр',
                'event_id' => 1,
            ],
            [
                'name' => 'Владислав',
                'event_id' => 2,
            ],
            [
                'name' => 'Покупатель 1 пользователя 2',
                'event_id' => 3,
            ],
            [
                'name' => 'Покупатель 2 пользователя 2',
                'event_id' => 3,
            ],
        ]);
    }
}
