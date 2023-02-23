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
        Schema::create('laporan_tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tamu');
            $table->integer('telepon');
            $table->string('kantor_instansi');
            $table->string('bidang');
            $table->string('pegawai');
            $table->string('keperluan');
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
        Schema::dropIfExists('laporan_tamus');
    }
};
