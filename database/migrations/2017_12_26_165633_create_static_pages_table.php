<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('text')->nullable()->default(null);
            $table->string('own')->unique();
            $table->timestamps();
        });

        $pages = [
            ['own' => 'kontakty', 'title' => 'Контакти'],
            ['own' => 'pro-nas', 'title' => 'Про нас'],
            ['own' => 'ugoda', 'title' => 'Угода'],
            ['own' => 'pravyla', 'title' => 'Правила'],
            ['own' => 'reklama', 'title' => 'Реклама'],
            ['own' => 'redakciya', 'title' => 'Редакція'],
        ];
        foreach ($pages as $page) {
            \Fresh\Nashemisto\StaticPage::create($page);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_pages');
    }
}
