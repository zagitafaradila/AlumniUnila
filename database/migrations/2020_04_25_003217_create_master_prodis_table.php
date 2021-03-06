<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_prodis', function (Blueprint $table) {
            $table->id('kode');
            $table->bigInteger('fak')->index('FK_master_prodis_master_fakultas');
            $table->bigInteger('jur')->index('FK_master_prodis_master_jurusan');
            $table->string('nama',50);
            $table->bigInteger('urutan');
            $table->string('active',1);
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
        Schema::dropIfExists('master_prodis');
    }
}
