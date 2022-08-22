<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDocumentScreeningDetailChecklistAddValidLifetimeOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('screening_document_detail_checklists', function (Blueprint $table) {
            $table->string('valid_for_life_time')->nullable()->after('expiry_date');
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
        Schema::table('screening_document_detail_checklists', function (Blueprint $table) {
            //
            $table->dropColumn('valid_for_life_time');
        });
    }
}
