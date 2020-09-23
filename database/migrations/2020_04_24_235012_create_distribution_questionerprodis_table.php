<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionQuestionerprodisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_questionerprodis', function (Blueprint $table) {
            $table->id();
            $table->string('tahun',6);
            $table->string('kode_prodi',50);
            $table->string('kode',50)->index('FK_distribution_questionerprodis_questioners');
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
        Schema::dropIfExists('distribution_questionerprodis');
    }
}
