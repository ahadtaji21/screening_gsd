<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeaverCommentToScreeningDetails extends Migration
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
            $table->text('leaver_comment')->nullable()->after('employee_status_dated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screening_details', function (Blueprint $table) {
            //
        });
    }
}
