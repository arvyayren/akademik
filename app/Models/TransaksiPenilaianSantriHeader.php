<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenilaianSantriHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penilaian_santri_header';

    protected $fillable = ['id_santri','nama','kelas','wali_kelas','bulan','rekap_nilai_bulanan',
    'created_at','updated_at'];
}