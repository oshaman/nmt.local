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
                ['name' => 'Діета та харчування', 'alias'=>'dieta-ta-harchuvannya'],
                ['name' => 'Спорт', 'alias'=>'sport'],
                ['name' => 'Корисні поради', 'alias'=>'korysni-porady'],
                ['name' => 'Цікаві факти', 'alias'=>'cikavi-fakty'],
            ]
        );
    }
}
