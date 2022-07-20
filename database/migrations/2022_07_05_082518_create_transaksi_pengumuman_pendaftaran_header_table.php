<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPengumumanPendaftaranHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pengumuman_pendaftaran_header', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('penanggung_jawab')->nullable();
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
        Schema::dropIfExists('transaksi_pengumuman_pendaftaran_header');
    }
}
