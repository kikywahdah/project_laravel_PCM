<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id_aset'; // jika primary key Anda bukan 'id'
    public $timestamps = false; // <--- WAJIB ADA

    protected $fillable = [
        'id_pengguna',
        'nama_aset',
        'jenis_aset',
        'lokasi',
        'luas',
        'status_kepemilikan',
        'tahun_perolehan',
        'nilai_aset',
        'keterangan',
        'tanggal_dibuat'
    ];
} 