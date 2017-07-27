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
        $this->call('UsersTableSeeder');
        $this->call('EventsTableSeeder');
        $this->call('PurchasesTableSeeder');
//        $this->call(CountriesTableSeeder::class);
    }
}
