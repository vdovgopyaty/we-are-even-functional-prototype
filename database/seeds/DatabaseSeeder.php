<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CurrenciesTableSeeder');
//        $this->call(CountriesTableSeeder::class);
        $this->call('UsersTableSeeder');
        $this->call('EventsTableSeeder');
        $this->call('PurchasesTableSeeder');
        $this->call('BuyersTableSeeder');
        $this->call('BuyerPurchaseTableSeeder');
    }
}
