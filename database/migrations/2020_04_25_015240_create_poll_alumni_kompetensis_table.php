<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollAlumniKompetensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_alumni_kompetensis', function (Blueprint $table) {
            $table->id();
            $table->string('npm',50)->index('FK_poll_alumni_kompetensis_alumnis');
            $table->string('id_jawaban',10);
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
        Schema::dropIfExists('poll_alumni_kompetensis');
    }
}
