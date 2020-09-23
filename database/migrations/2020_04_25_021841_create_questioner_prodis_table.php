<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionerProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questioner_prodis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi',50);
            $table->string('kode',50);
            $table->string('nama',255);
            $table->string('active',1);
            $table->mediumInteger('jumlah')->nullable();
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
        Schema::dropIfExists('questioner_prodis');
    }
}
