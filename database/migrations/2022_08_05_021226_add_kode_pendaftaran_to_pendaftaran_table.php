<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodePendaftaranToPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_pengumuman_pendaftaran_detail', function (Blueprint $table) {
            $table->string('kode_pendaftaran', 12);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_pengumuman_pendaftaran_detail', function (Blueprint $table) {
            $table->string('kode_pendaftaran', 12);
        });
    }
}
