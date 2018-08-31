<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeParametersToCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('ticketit_categories', function (Blueprint $table) {
            $table->string('code');
            $table->string('parameters')->nullable();
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
        Schema::table('ticketit_categories', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('parameters');
        });
    }
}
