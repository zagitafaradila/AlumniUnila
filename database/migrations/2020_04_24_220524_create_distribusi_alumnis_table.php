<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusiAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribusi_alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('npm_alumni',50)->unique()->index('FK_distribusi_alumnis_alumnis');
            $table->string('npm_surveyor',50)->index('FK_distribusi_alumnis_mahasiswas');
            $table->string('status',50);
            $table->bigInteger('status_pekerjaan');
            $table->bigInteger('status_kompetensi');
            $table->bigInteger('status_ps');
            $table->text('catatan');
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
        Schema::dropIfExists('distribusi_alumnis');
    }
}
