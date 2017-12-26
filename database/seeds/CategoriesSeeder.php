<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                ['name' => 'Обговорення (ток шоу)', 'alias' => 'obgovorennya-tok-shou'],
                ['name' => 'Короткі новини дня', 'alias' => 'korotki-novini-dnya'],
                ['name' => 'Інтерв\'ю дня', 'alias' => 'intervyu-dnya'],
                ['name' => 'Огляд преси', 'alias' => 'oglyad-presi'],
                ['name' => 'Веб камера нашого міста', 'alias' => 'veb-kamera-nashogo-mista'],
                ['name' => 'Кримінал', 'alias' => 'kriminal'],
                ['name' => 'Культура і спорт', 'alias' => 'kultura-i-sport'],
            ]
        );
    }
}
