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
        Schema::create('ihts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('jenis_kegiatan');
            $table->string('nama_pelatihan');
            $table->string('status');
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
        Schema::dropIfExists('ihts');
    }
};
