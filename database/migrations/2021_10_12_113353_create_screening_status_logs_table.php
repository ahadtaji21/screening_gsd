<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening_status_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('screening_detail_id')->nullable();
            $table->integer('screening_status_id')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('status_date')->nullable();
            $table->integer('created_by')->nullable();;
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
        Schema::dropIfExists('screening_status_logs');
    }
}
