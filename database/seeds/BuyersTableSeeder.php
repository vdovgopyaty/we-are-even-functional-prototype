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
                'name' => 'Vladislav',
                'event_id' => 1,
            ],
            [
                'name' => 'Buyer 2',
                'event_id' => 1,
            ],
            [
                'name' => 'Buyer 3',
                'event_id' => 1,
            ],
            [
                'name' => 'Event 2 Vladislav',
                'event_id' => 2,
            ],
            [
                'name' => 'Event 2 Buyer 2',
                'event_id' => 2,
            ],
            [
                'name' => 'User 2 Buyer 1',
                'event_id' => 3,
            ],
            [
                'name' => 'User 2 Buyer 2',
                'event_id' => 3,
            ],
        ]);
    }
}
