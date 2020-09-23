<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questioners', function (Blueprint $table) {
            $table->string('kode',50)->primary();
            $table->string('nama',255);
            $table->string('kategori',50);
            $table->string('for',50);
            $table->mediumInteger('jumlah')->nullable();
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
        Schema::dropIfExists('questioners');
    }
}
