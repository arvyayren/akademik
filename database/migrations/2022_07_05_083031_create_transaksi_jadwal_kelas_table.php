<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiJadwalKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_jadwal_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('hari')->nullable();
            $table->string('mapel')->nullable();
            $table->string('nama_guru')->nullable();
            $table->string('kelas')->nullable();
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
        Schema::dropIfExists('transaksi_jadwal_kelas');
    }
}
