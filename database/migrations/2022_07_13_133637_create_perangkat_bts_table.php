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
        Schema::create('perangkat_bts', function (Blueprint $table) {
            $table->increments('id_perangkat_bts');
            $table->string('nama_alat');
            $table->integer('bts_id')->unsigned();
            $table->foreign('bts_id')->references('id_bts')->on('bts');
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
        Schema::dropIfExists('perangkat_bts');
    }
};
