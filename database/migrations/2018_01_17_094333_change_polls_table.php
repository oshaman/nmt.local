<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePollsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable()->default(1)->after('alias');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
            $table->dropForeign('polls_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}