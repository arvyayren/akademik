<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPengumumanPendaftaranHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pengumuman_pendaftaran_header';

    protected $fillable = ['tanggal','deskripsi','penanggung_jawab','created_at','updated_at'];
}
