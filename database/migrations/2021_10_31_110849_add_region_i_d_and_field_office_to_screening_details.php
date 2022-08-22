<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionIDAndFieldOfficeToScreeningDetails extends Migration
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
            //$table->string('region_id')->after('name');
            $table->tinyInteger('region_id')->nullable();
            $table->tinyInteger('field_office_id')->nullable();

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
