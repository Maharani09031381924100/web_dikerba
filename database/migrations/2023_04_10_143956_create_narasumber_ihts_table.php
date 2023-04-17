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
        Schema::create('narasumber_ihts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('detail_iht_id')
                    ->constrained('detail_ihts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('nama_narasumber');
            $table->string('instansi');
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
        Schema::dropIfExists('narasumber_ihts');
    }
};
