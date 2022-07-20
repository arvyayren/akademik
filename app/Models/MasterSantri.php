<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSantri extends Model
{
    use HasFactory;

    protected $table = 'master_santri';

    protected $fillable = ['nama','tempat_lahir','tanggal_lahir','no_ktp','riwayat_pendidikan',
    'nama_wali','no_ktp_wali','kelas','created_at','updated_at'];
}
