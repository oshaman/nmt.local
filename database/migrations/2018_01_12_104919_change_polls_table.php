<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->string('image')->nullable()->default(null);
            $table->string('alt')->nullable()->default(null);
            $table->string('imgtitle')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('alt');
            $table->dropColumn('imgtitle');
        });
    }
}
