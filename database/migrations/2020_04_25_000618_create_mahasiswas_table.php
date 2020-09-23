<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('npm',50)->primary();
            $table->string('name',50);
            $table->mediumInteger('fak');
            $table->mediumInteger('jur');
            $table->mediumInteger('prodi');
            $table->string('birth_place',50)->nullable();
            $table->date('birthday');
            $table->mediumInteger('angkatan');
            $table->string('jk',10)->nullable();
            $table->string('agama',10)->nullable();
            $table->string('telp',20);
            $table->string('telp_other',20)->nullable();
            $table->string('telp_wa',20)->nullable();
            $table->mediumText('social')->nullable();
            $table->string('instagram',150)->nullable();
            $table->string('fb',150)->nullable();
            $table->string('twitter',150)->nullable();
            $table->string('linkedin',150)->nullable();
            $table->string('email',150)->nullable();
            $table->string('foto',255)->nullable();
            $table->text('address')->nullable();
            $table->string('registered',1);
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
        Schema::dropIfExists('mahasiswas');
    }
}
