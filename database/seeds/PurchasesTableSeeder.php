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
                'name' => 'Purchase 1',
                'event_id' => 1,
            ],
            [
                'name' => 'Purchase 2',
                'event_id' => 1,
            ],
            [
                'name' => 'User 2 Purchase 1',
                'event_id' => 3,
            ],
        ]);
    }
}
