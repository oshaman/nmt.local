<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_statistics', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('poll_id')->unique();
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');

            $table->unsignedInteger('n1')->default(0);
            $table->unsignedInteger('n2')->default(0);
            $table->unsignedInteger('n3')->default(0);
            $table->unsignedInteger('n4')->default(0);
            $table->unsignedInteger('n5')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_statistics');
    }
}
