<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPenilaianSantriHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penilaian_santri_header', function (Blueprint $table) {
            $table->id();
            $table->integer('id_santri')->nullable();
            $table->string('nama')->nullable();
            $table->string('kelas')->nullable();
            $table->string('wali_kelas')->nullable();
            $table->string('bulan')->nullable();
            $table->string('rekap_nilai_bulanan')->nullable();
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
        Schema::dropIfExists('transaksi_penilaian_santri_header');
    }
}
