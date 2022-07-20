<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPengumumanPendaftaranDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pengumuman_pendaftaran_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengumuman_pendaftaran')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_ktp')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('no_ktp_wali')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transaksi_pengumuman_pendaftaran_detail');
    }
}
