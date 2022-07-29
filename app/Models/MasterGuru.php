<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGuru extends Model
{
    use HasFactory;

    protected $table = 'data_guru';

    protected $fillable = ['nama','tempat_lahir','tanggal_lahir','alamat','no_ktp','riwayat_pendidikan',
    'wali_kelas','created_at','updated_at'];
}
