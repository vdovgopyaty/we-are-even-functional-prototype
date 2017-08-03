<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyerPurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buyer_purchase')->insert([
            [
                'amount' => 1000.00,
                'buyer_id' => 1,
                'purchase_id' => 1,
            ],
            [
                'amount' => 1500.00,
                'buyer_id' => 2,
                'purchase_id' => 1,
            ],
            [
                'amount' => 500.00,
                'buyer_id' => 3,
                'purchase_id' => 1,
            ],
            [
                'amount' => 900.00,
                'buyer_id' => 1,
                'purchase_id' => 2,
            ],
            [
                'amount' => 300.00,
                'buyer_id' => 2,
                'purchase_id' => 2,
            ],
        ]);
    }
}
