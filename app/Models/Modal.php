<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    protected $table = 'modal';
    protected $primaryKey = 'id_modal';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'sumber_modal',
        'jumlah',
        'tanggal_terima',
        'keterangan',
        'tanggal_dibuat'
    ];
} 