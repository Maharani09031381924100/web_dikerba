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
        Schema::create('detail_ihts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('iht_id')
                    ->constrained('ihts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->date('tgl_pelaksanaan');
            $table->string('nama_detail');
            $table->string('gelombang');
            $table->string('tempat');
            $table->integer('peserta');
            $table->integer('narasumber');
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
        Schema::dropIfExists('detail_ihts');
    }
};
