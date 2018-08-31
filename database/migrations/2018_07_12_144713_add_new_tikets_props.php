<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTiketsProps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('ticketit', function (Blueprint $table) {
            $table->string('parameters')->nullable();
            $table->dateTime('date_request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('ticketit', function (Blueprint $table) {
            $table->dropColumn('parameters');
            $table->dropColumn('date_request');
        });
    }
}
