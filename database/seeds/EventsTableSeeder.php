<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'name' => 'Поездка в Лиетлахти',
                'place' => 'Карелия',
                'description' => 'Скальные сектора в окрестностях Треугольного озера и национального парка Лиетлахти',
                'user_id' => 1,
            ],
            [
                'name' => 'День рождения (личные расходы)',
                'place' => 'Ресторан «Какой-нибудь»',
                'description' => 'Если в событии только один покупатель, событие нужно считать личным и как-то выделить его на фоне остальных',
                'user_id' => 1,
            ],
            [
                'name' => 'Событие второго пользователя',
                'place' => '',
                'description' => 'Для тестирования безопасности',
                'user_id' => 2,
            ],
        ]);
    }
}
