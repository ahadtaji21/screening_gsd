<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no')->unique()->nullable();
            $table->tinyInteger('employee_id')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('father_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->tinyInteger('field_office_id')->nullable();
            $table->tinyInteger('region_id')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('passport')->nullable();
            $table->string('nic')->nullable();
            $table->string('nationality')->nullable();
            $table->string('ethnicity')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('is_deleted')->default('0');
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
        Schema::dropIfExists('employee_infos');
        // Schema::table('employee_infos', function (Blueprint $table) {
        //     $table->tinyInteger('region_id')->nullable();
        //     $table->tinyInteger('field_office_id')->nullable();        
        // });
    
    }
}
