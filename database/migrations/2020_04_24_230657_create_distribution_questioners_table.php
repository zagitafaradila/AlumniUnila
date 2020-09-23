<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionQuestionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_questioners', function (Blueprint $table) {
            $table->id();
            $table->string('tahun',6)->unique();
            $table->string('perusahaan',50);
            $table->string('pekerjaan',50);
            $table->string('kompetensi',50);
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
        Schema::dropIfExists('distribution_questioners');
    }
}
