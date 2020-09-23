<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_works', function (Blueprint $table) {
            $table->id();
            $table->string('npm',50)->index('FK_alumni_works_alumnis');
            $table->string('tahun',50);
            $table->string('perusahaan',50);
            $table->string('posisi',50);
            $table->string('nama_atasan',50);
            $table->string('telp_atasan',50);
            $table->string('email_atasan',150);
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
        Schema::dropIfExists('alumni_works');
    }
}
