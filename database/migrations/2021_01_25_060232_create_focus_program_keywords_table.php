<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFocusProgramKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('focus_program_keywords', function (Blueprint $table) {
            $table->unsignedBigInteger('program_details_id');
            $table->unsignedBigInteger('focus_keyword_id');
            $table->foreign('program_details_id')->references('id')->on('program_details')->onDelete('CASCADE');
            $table->foreign('focus_keyword_id')->references('id')->on('focus_keywords')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('focus_program_keywords');
    }
}
