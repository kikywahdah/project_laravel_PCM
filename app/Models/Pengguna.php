<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'kata_sandi',
        'nama_lengkap',
        'tanggal_dibuat',
        'is_admin',
        'is_super_admin',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }

    public function isSuperAdmin(): bool
    {
        return (bool) $this->is_super_admin;
    }

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
} 