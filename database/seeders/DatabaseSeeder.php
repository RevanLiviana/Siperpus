<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Anggota
        $anggotaData = [
            ['nama_lengkap' => 'Budi Santoso',      'jenis_kelamin' => 'L', 'email' => 'budi@mail.com',    'no_telepon' => '081234567890', 'tanggal_lahir' => '1995-03-15', 'alamat' => 'Jl. Merdeka No. 10, Jakarta'],
            ['nama_lengkap' => 'Siti Rahayu',        'jenis_kelamin' => 'P', 'email' => 'siti@mail.com',    'no_telepon' => '082345678901', 'tanggal_lahir' => '1998-07-22', 'alamat' => 'Jl. Sudirman No. 5, Bandung'],
            ['nama_lengkap' => 'Ahmad Fauzi',        'jenis_kelamin' => 'L', 'email' => 'ahmad@mail.com',   'no_telepon' => '083456789012', 'tanggal_lahir' => '2000-01-10', 'alamat' => 'Jl. Gatot Subroto No. 20, Surabaya'],
            ['nama_lengkap' => 'Dewi Lestari',       'jenis_kelamin' => 'P', 'email' => 'dewi@mail.com',    'no_telepon' => '084567890123', 'tanggal_lahir' => '1997-11-05', 'alamat' => 'Jl. Diponegoro No. 8, Yogyakarta'],
            ['nama_lengkap' => 'Rizky Pratama',      'jenis_kelamin' => 'L', 'email' => 'rizky@mail.com',   'no_telepon' => '085678901234', 'tanggal_lahir' => '2001-06-18', 'alamat' => 'Jl. Ahmad Yani No. 15, Semarang'],
        ];

        foreach ($anggotaData as $i => $data) {
            $year  = date('Y');
            $no    = 'AGT-' . $year . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            Anggota::create(array_merge($data, [
                'no_anggota'     => $no,
                'status'         => $i % 4 === 3 ? 'non-aktif' : 'aktif',
                'tanggal_daftar' => date('Y-m-d', strtotime('-' . ($i + 1) . ' months')),
                'tanggal_expire' => date('Y-m-d', strtotime('+' . (12 - $i) . ' months')),
            ]));
        }

        // Seed Petugas
        $petugasData = [
            ['nama_lengkap' => 'Dr. Hendra Wijaya',  'jenis_kelamin' => 'L', 'email' => 'hendra@perpus.com',  'no_telepon' => '081100001111', 'tanggal_lahir' => '1975-04-12', 'jabatan' => 'kepala_perpustakaan', 'alamat' => 'Jl. Pahlawan No. 1, Jakarta', 'tanggal_masuk' => '2010-01-15'],
            ['nama_lengkap' => 'Rina Kusumawati',     'jenis_kelamin' => 'P', 'email' => 'rina@perpus.com',    'no_telepon' => '081200002222', 'tanggal_lahir' => '1985-09-20', 'jabatan' => 'pustakawan',           'alamat' => 'Jl. Kenanga No. 12, Bandung', 'tanggal_masuk' => '2015-03-01'],
            ['nama_lengkap' => 'Yusuf Hakim',         'jenis_kelamin' => 'L', 'email' => 'yusuf@perpus.com',   'no_telepon' => '081300003333', 'tanggal_lahir' => '1990-12-08', 'jabatan' => 'staf_administrasi',    'alamat' => 'Jl. Melati No. 7, Surabaya', 'tanggal_masuk' => '2018-06-10'],
            ['nama_lengkap' => 'Nurul Hidayah',       'jenis_kelamin' => 'P', 'email' => 'nurul@perpus.com',   'no_telepon' => '081400004444', 'tanggal_lahir' => '1992-02-14', 'jabatan' => 'pustakawan',           'alamat' => 'Jl. Mawar No. 3, Yogyakarta', 'tanggal_masuk' => '2019-09-05'],
            ['nama_lengkap' => 'Teguh Santoso',       'jenis_kelamin' => 'L', 'email' => 'teguh@perpus.com',   'no_telepon' => '081500005555', 'tanggal_lahir' => '1988-07-30', 'jabatan' => 'teknisi',              'alamat' => 'Jl. Anggrek No. 9, Semarang', 'tanggal_masuk' => '2020-02-20'],
        ];

        foreach ($petugasData as $i => $data) {
            $year = date('Y');
            $nip  = 'PTG-' . $year . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            Petugas::create(array_merge($data, [
                'nip'    => $nip,
                'status' => $i === 4 ? 'non-aktif' : 'aktif',
            ]));
        }
    }
}