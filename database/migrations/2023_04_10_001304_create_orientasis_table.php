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
        Schema::create('orientasis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('jk');
            $table->date('tgl_orientasi');
            $table->date('tgl_selesaiorientasi');
            $table->string('status_pegawai');
            $table->string('pendidikan');
            $table->string('asal');
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
        Schema::dropIfExists('orientasis');
    }
};
