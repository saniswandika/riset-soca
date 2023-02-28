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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id('id');
            $table->string('no_pendaftaran');
            $table->integer('id_alur');
            $table->string('id_provinsi');
            $table->string('id_kabkot');
            $table->string('id_kecamatan');
            $table->string('id_kelurahan');
            $table->string('jenis_pelapor');
            $table->string('ada_nik');
            $table->string('nik');
            $table->string('no_kk');
            $table->string('no_kis');
            $table->string('nama');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->string('telp');
            $table->string('email');
            $table->string('hubungan_terlapor');
            $table->string('file_penunjang');
            $table->string('keluhan_tipe');
            $table->integer('keluhan_id_program');
            $table->string('keluhan_detail');
            $table->string('keluhan_foto');
            $table->string('tl_catatan');
            $table->string('tl_file');
            $table->string('createdby');
            $table->string('updatedby');
            $table->string('ada_dtks');
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
        Schema::drop('pengaduans');
    }
};
