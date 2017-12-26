<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->insert(
            [
                ['title' => 'Обговорення (ток шоу)', 'alias' => 'obgovorennya-tok-shou'],
                ['title' => 'Короткі новини дня', 'alias' => 'korotki-novini-dnya'],
                ['title' => 'Інтерв\'ю дня', 'alias' => 'intervyu-dnya'],
                ['title' => 'Огляд преси', 'alias' => 'oglyad-presi'],
                ['title' => 'Веб камера нашого міста', 'alias' => 'veb-kamera-nashogo-mista'],
                ['title' => 'Кримінал', 'alias' => 'kriminal'],
                ['title' => 'Культура і спорт', 'alias' => 'kultura-i-sport'],
            ]
        );
    }
}
