<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailSendScreeningDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('screening_details', function (Blueprint $table) {
            //
            $table->tinyInteger('email_send')->default(0);
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('screening_details', function (Blueprint $table) {
            //
            $table->dropColumn('email_send');
        });
    }
}
