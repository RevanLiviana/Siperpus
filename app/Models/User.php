<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Cek apakah user adalah Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah Anggota
     */
    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    /**
     * Cek apakah user adalah Petugas
     */
    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }
}