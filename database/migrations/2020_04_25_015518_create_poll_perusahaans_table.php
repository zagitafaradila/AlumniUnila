<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('npm',50)->index('FK_poll_perusahaans_alumnis');
            $table->bigInteger('id_perusahaan')->index('FK_poll_perusahaans_alumni_works');
            $table->bigInteger('id_jawaban');
            $table->string('sub_jawaban',50);
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
        Schema::dropIfExists('poll_perusahaans');
    }
}
