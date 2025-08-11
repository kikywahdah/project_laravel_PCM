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
        'tanggal_diupdate',
        'is_admin',
        'is_super_admin',
        'is_approved',
        'google_id',
        'avatar',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_super_admin' => 'boolean',
        'is_approved' => 'boolean',
        'tanggal_dibuat' => 'datetime',
        'tanggal_diupdate' => 'datetime',
    ];

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('is_approved', false);
    }

    public function isSuperAdmin(): bool
    {
        return (bool) $this->is_super_admin;
    }

    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    public function isApproved(): bool
    {
        return (bool) $this->is_approved;
    }

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($pengguna) {
            $pengguna->tanggal_dibuat = now();
        });
        
        static::updating(function ($pengguna) {
            $pengguna->tanggal_diupdate = now();
        });
    }
} 