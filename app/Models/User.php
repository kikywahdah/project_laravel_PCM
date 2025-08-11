<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset'; // Ganti jika nama tabel berbeda
    protected $fillable = [
        'nama_aset', 'jenis_aset', 'lokasi', 'luas', 'kepemilikan', 'tahun_perolehan', 'keterangan', 'nilai_aset'
    ];
    public $timestamps = true; // atau false jika tabel tidak ada kolom created_at/updated_at
}
