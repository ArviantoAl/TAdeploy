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
        Schema::create('profilcv', function (Blueprint $table) {
            $table->increments('id_profil');
            $table->string('nama_cv');
            $table->string('email_cv');
            $table->string('web_cv');
            $table->string('no_hp');
            $table->char('provinsi_id');
            $table->foreign('provinsi_id')->references('id')->on('provinces');
            $table->char('kabupaten_id');
            $table->foreign('kabupaten_id')->references('id')->on('regencies');
            $table->char('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('districts');
            $table->char('desa_id');
            $table->foreign('desa_id')->references('id')->on('villages');
            $table->longText('detail_alamat');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('terakhir_generate');
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
        Schema::dropIfExists('profilcv');
    }
};
