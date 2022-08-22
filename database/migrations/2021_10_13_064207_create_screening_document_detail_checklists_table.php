<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningDocumentDetailChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening_document_detail_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('screening_detail_id')->nullable();
            $table->foreignId('screening_document_checklist_id')->nullable();
            $table->string('attachment')->nullable();
            $table->text('store_path')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('screening_document_detail_checklists');
    }
}
