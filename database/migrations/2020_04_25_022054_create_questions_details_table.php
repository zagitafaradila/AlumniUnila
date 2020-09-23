<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no');
            $table->string('kode_questioner',50)->index('FK_questions_details_questioner');
            $table->string('kode_questions',50)->index('FK_questions_details_questions');
            $table->string('jenis',50);
            $table->string('option_value',255);
            $table->string('sub_option',255);
            $table->string('sub_option_class',50);
            $table->string('go_to',50);
            $table->string('skip',50);
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
        Schema::dropIfExists('questions_details');
    }
}
