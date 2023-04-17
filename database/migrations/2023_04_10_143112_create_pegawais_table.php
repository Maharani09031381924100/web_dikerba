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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->bigIncrements('no_pegawai', false);
            $table->string('email_address');
            $table->string('nama_pegawai');
            $table->char('jk',1);
            $table->string('tk_pddkan');
            $table->string('status_pekerjaan');
            $table->string('status_jabatan');
            $table->string('bidang');
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
        Schema::dropIfExists('pegawais');
    }
};
