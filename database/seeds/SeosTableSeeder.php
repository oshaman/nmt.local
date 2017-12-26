<?php

use Illuminate\Database\Seeder;

class SeosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seos')->insert(
            [
                ['uri' => '/'],
                ['uri' => 'kontakty'],
                ['uri' => 'pro-nas'],
                ['uri' => 'ugoda'],
                ['uri' => 'pravyla'],
                ['uri' => 'reklama'],
                ['uri' => 'redakciya'],
            ]
        );
    }
}
