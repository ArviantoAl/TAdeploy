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
        Schema::create('bts', function (Blueprint $table) {
            $table->increments('id_bts');
            $table->string('nama_bts');
            $table->integer('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris');
            $table->integer('jenis_id')->unsigned();
            $table->foreign('jenis_id')->references('id_jenis')->on('jenis_bts');
            $table->integer('lokasi_id')->unsigned();
            $table->foreign('lokasi_id')->references('id_master')->on('master_bts');
            $table->string('frekuensi');
            $table->string('ssid');
            $table->string('ip');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id_status')->on('status');
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
        Schema::dropIfExists('bts');
    }
};
