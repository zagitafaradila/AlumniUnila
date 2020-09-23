<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniAcademicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_academics', function (Blueprint $table) {
            $table->id();
            $table->string('npm',50)->index('FK_alumni_academic_alumnis');
            $table->string('jenjang',50);
            $table->string('tahun',50);
            $table->string('school',255);
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
        Schema::dropIfExists('alumni_academics');
    }
}
