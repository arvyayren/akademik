<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMapel extends Model
{
    use HasFactory;

    protected $table = 'data_mapel';

    protected $fillable = ['nama','created_at','updated_at'];
}
