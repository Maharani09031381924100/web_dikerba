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
        Schema::create('jpls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('jpl_id')
                    ->constrained('jpl_utamas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('pegawai_id')
                    ->references('no_pegawai')
                    ->on('pegawais')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('kategori');
            $table->string('nama_kegiatan');
            $table->string('tempat');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('jpl');
            $table->string('no_sertif');
            $table->string('penerbit');
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
        Schema::dropIfExists('jpls');
    }
};
