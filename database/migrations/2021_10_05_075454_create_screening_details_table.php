<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening_details', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('employee_info_id')->nullable();
            $table->string('type_of_staff')->nullable();
            $table->foreignId('designation_id')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->string('line_manager_designation')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->string('screening_result')->nullable();
            $table->date('screening_date')->nullable();
            $table->text('comments')->nullable();
            $table->json('questions')->nullable();
            $table->string('screening_status')->nullable();
            $table->string('employee_status')->nullable();
            $table->date('employee_status_dated')->nullable();
            $table->string('record_status')->nullable();
            $table->tinyInteger('on_behalf_user')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->tinyInteger('is_deleted')->nullable();
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
        Schema::dropIfExists('screening_details');
    }
}
