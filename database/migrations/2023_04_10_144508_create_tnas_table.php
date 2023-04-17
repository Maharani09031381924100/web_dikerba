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
        Schema::create('tnas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tna_id')
                    ->constrained('tna_utamas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('pegawai_id')
                    ->references('no_pegawai')
                    ->on('pegawais')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('umur');
            $table->integer('lama_kerja_rs');
            $table->integer('lama_kerja_skrg');
            $table->longText('kompetensi');
            $table->longText('masalah');
            $table->longText('pelatihan_2_thn');
            $table->longText('pelatihan_tupoksi');
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
        Schema::dropIfExists('tnas');
    }
};
