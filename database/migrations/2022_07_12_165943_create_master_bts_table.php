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
        Schema::create('master_bts', function (Blueprint $table) {
            $table->increments('id_master');
            $table->string('nama_master');
            $table->char('provinsi_id');
            $table->foreign('provinsi_id')->references('id')->on('provinces');
            $table->char('kabupaten_id');
            $table->foreign('kabupaten_id')->references('id')->on('regencies');
            $table->char('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('districts');
            $table->char('desa_id');
            $table->foreign('desa_id')->references('id')->on('villages');
            $table->string('nama_lokasi');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('master_bts');
    }
};
