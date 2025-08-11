<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $table = 'usaha';
    protected $primaryKey = 'id_usaha';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'nama_usaha',
        'jenis_usaha',
        'keterangan',
        'tanggal_dibuat'
    ];
} 