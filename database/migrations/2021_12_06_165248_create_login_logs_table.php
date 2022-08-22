<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void..
     */
    public function up()
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('ip','15')->nullable();
            $table->string('login_status','50')->nullable();
            $table->string('sys_name','100')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('created_at')->useCurrent();    
        });
    }

    /**
     * Reverse the migrations....
     *
     * @return void.
     */
    public function down()
    {
        Schema::dropIfExists('login_logs');
    }
}
