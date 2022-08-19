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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id_invoice')->primary();
            $table->integer('pelanggan_id')->unsigned();
            $table->foreign('pelanggan_id')->references('id_user')->on('users');
            $table->integer('metode_id')->nullable()->unsigned();
            $table->foreign('metode_id')->references('id_metode')->on('metodes');
            $table->longText('keterangan')->nullable();
            $table->integer('bank_id')->nullable()->unsigned();
            $table->foreign('bank_id')->references('id_bank')->on('banks');
            $table->timestamp('tgl_terbit')->nullable();
            $table->timestamp('tgl_tempo')->nullable();
            $table->timestamp('tgl_bayar')->nullable();
            $table->integer('harga_bayar');
            $table->integer('tagihan');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('ppn');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id_status')->on('status');
            $table->string('bukti_bayar')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
