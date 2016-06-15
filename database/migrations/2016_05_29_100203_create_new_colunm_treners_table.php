<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewColunmTrenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treners', function (Blueprint $table) {
            $table->string('graf');
            $table->boolean('graf_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treners', function (Blueprint $table) {
            $table->dropColumn('graf');
            $table->dropColumn('graf_time');
        });
    }
}
