<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participants')->insert([
            [
                'name' => 'Vladislav',
                'event_id' => 1,
            ],
            [
                'name' => 'Participant 2',
                'event_id' => 1,
            ],
            [
                'name' => 'Participant 3',
                'event_id' => 1,
            ],
            [
                'name' => 'Event 2 Vladislav',
                'event_id' => 2,
            ],
            [
                'name' => 'Event 2 Participant 2',
                'event_id' => 2,
            ],
            [
                'name' => 'User 2 Participant 1',
                'event_id' => 3,
            ],
            [
                'name' => 'User 2 Participant 2',
                'event_id' => 3,
            ],
        ]);
    }
}
