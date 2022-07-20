<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiJadwalKelas extends Model
{
    use HasFactory;

    protected $table = 'transaksi_jadwal_kelas';

    protected $fillable = ['hari','mapel','nama_guru','kelas','created_at','updated_at'];
}
