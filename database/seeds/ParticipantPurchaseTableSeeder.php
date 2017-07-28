<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantPurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participant_purchase')->insert([
            [
                'amount' => 1000.00,
                'participant_id' => 1,
                'purchase_id' => 1,
            ],
            [
                'amount' => 1500.00,
                'participant_id' => 2,
                'purchase_id' => 1,
            ],
            [
                'amount' => 500.00,
                'participant_id' => 3,
                'purchase_id' => 1,
            ],
            [
                'amount' => 900.00,
                'participant_id' => 1,
                'purchase_id' => 2,
            ],
            [
                'amount' => 300.00,
                'participant_id' => 2,
                'purchase_id' => 2,
            ],
        ]);
    }
}
