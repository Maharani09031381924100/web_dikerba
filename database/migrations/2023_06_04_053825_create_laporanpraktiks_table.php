<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporanpraktiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('univ_id');
            $table->unsignedBigInteger('fakul_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('prodi_id');
            $table->unsignedBigInteger('tkpendidikan_id');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('jumlah');
            $table->integer('pria');
            $table->integer('perempuan');
            $table->string('keterangan');
            $table->string('Kelulusan');
            $table->timestamps();

            $table->foreign('univ_id')->references('iduniv')->on('univs');
            $table->foreign('fakul_id')->references('idfakul')->on('fakuls');
            $table->foreign('jurusan_id')->references('idjurusan')->on('jurusans');
            $table->foreign('prodi_id')->references('idprodi')->on('prodis');
            $table->foreign('tkpendidikan_id')->references('idtkpendidikan')->on('tingkatpendidikans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporanpraktiks');
    }
};
