<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmployeeInfosEmpNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('employee_infos', function (Blueprint $table) {
            $table->string('employee_surname')->nullable()->after('employee_name');
            $table->string('father_surname')->nullable()->after('father_name');
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
        Schema::table('field_offices', function (Blueprint $table) {
            $table->dropColumn('employee_surname')->nullable();
            $table->dropColumn('father_surname')->nullable();
        });
    }
}
