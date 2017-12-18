<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('alias')->unique();
            $table->timestamps();
        });

        $tags = [
            ['name' => 'Спорт', 'alias' => 'sport'],
            ['name' => 'Економіка', 'alias' => 'economy'],
            ['name' => 'Топ', 'alias' => 'top'],
            ['name' => 'Політика', 'alias' => 'politics'],
        ];
        foreach ($tags as $tag) {
            \Fresh\Nashemisto\Tag::create($tag);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
