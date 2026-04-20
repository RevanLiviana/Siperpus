<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'kategori',
        'stok',
        'stok_tersedia',
        'deskripsi',
        'lokasi_rak',
        'status',
    ];

    public static function generateKodeBuku(): string
    {
        $last = self::latest('id')->first();
        $number = $last ? (int) substr($last->kode_buku, 3) + 1 : 1;
        return 'BKU' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    public static function kategoriList(): array
    {
        return [
            'Fiksi',
            'Non-Fiksi',
            'Ilmu Pengetahuan',
            'Teknologi',
            'Sejarah',
            'Biografi',
            'Agama',
            'Anak-anak',
            'Komik',
            'Lainnya',
        ];
    }
}