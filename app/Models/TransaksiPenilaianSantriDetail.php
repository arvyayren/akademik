<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenilaianSantriDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penilaian_santri_detail';

    protected $fillable = ['id_penilaian','tanggal','subjek','nilai','keterangan','mapel',
    'created_at','updated_at'];
}
