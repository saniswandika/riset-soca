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
        Schema::create('prelist', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_provinsi');
            $table->string('id_kabkot');
            $table->string('id_kecamatan');
            $table->string('id_kelurahan');
            $table->string('nik');
            $table->string('no_kk');
            $table->string('no_kis');
            $table->string('nama');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->string('telp');
            $table->string('email');
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
        Schema::dropIfExists('prelist');
    }
};
