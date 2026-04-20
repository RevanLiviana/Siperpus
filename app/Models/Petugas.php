<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
        'jabatan',
        'status',
        'tanggal_masuk',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    // Auto-generate NIP
    public static function generateNip(): string
    {
        $year  = date('Y');
        $count = self::whereYear('created_at', $year)->count() + 1;
        return 'PTG-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getJabatanLabelAttribute(): string
    {
        $labels = [
            'kepala_perpustakaan' => 'Kepala Perpustakaan',
            'pustakawan'          => 'Pustakawan',
            'staf_administrasi'   => 'Staf Administrasi',
            'teknisi'             => 'Teknisi',
        ];
        return $labels[$this->jabatan] ?? $this->jabatan;
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'aktif' ? 'success' : 'danger';
    }
}