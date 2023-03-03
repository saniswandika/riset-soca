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
        Schema::create('wilayahs', function (Blueprint $table) {
            $table->id();
            $table->char('province_id', 2);
            $table->char('kota_id', 4);
            $table->char('kecamatan_id', 7);
            $table->char('kelurahan_id', 10);
            $table->foreign('province_id')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kota_id')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'cities')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kecamatan_id')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'districts')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kelurahan_id')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix').'villages')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('status_wilayah')->default(0);
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
        Schema::dropIfExists('wilayahs');
    }
};
