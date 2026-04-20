<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'no_anggota',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
        'status',
        'tanggal_daftar',
        'tanggal_expire',
    ];

    protected $casts = [
        'tanggal_lahir'   => 'date',
        'tanggal_daftar'  => 'date',
        'tanggal_expire'  => 'date',
    ];

    // Auto-generate nomor anggota
    public static function generateNoAnggota(): string
    {
        $year  = date('Y');
        $count = self::whereYear('created_at', $year)->count() + 1;
        return 'AGT-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'aktif' ? 'success' : 'danger';
    }
}