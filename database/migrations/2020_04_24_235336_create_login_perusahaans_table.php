<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_perusahaans', function (Blueprint $table) {
            $table->string('key_valid',100)->primary();
            $table->string('npm',50);
            $table->bigInteger('id_perusahaan')->index('FK_login_perusahaans_alumni_works');
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
        Schema::dropIfExists('login_perusahaans');
    }
}
