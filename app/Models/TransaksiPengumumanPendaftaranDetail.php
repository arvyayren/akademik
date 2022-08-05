<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPengumumanPendaftaranDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pengumuman_pendaftaran_detail';

    protected $fillable = ['id_pengumuman_pendaftaran','tanggal','nama','tempat_lahir','tanggal_lahir',
    'no_ktp','riwayat_pendidikan','nama_wali','no_ktp_wali','status','created_at','updated_at', 'kode_pendaftaran'];
}
