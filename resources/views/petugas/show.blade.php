@extends('layouts.app')

@section('title', 'Detail Petugas')
@section('page-title', 'Detail Petugas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.index') }}" class="text-muted text-decoration-none">Petugas</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-person-badge-fill me-2" style="color:var(--primary)"></i>Detail Petugas</span>
                <div class="d-flex gap-2">
                    <a href="{{ route('petugas.edit', $petugas) }}" class="btn btn-warning btn-sm rounded-3">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">

                <div class="text-center mb-4 pb-3 border-bottom">
                    <div class="avatar mx-auto mb-3"
                         style="width:72px;height:72px;font-size:1.5rem;background:{{ $petugas->jenis_kelamin=='L' ? '#dbeafe' : '#fce7f3' }};color:{{ $petugas->jenis_kelamin=='L' ? '#1d4ed8' : '#9d174d' }};">
                        {{ strtoupper(substr($petugas->nama_lengkap, 0, 2)) }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ $petugas->nama_lengkap }}</h5>
                    <p class="text-muted mb-2" style="font-size:.85rem;">{{ $petugas->nip }}</p>
                    @php
                        $jabatanColors = [
                            'kepala_perpustakaan' => ['bg'=>'#fef3c7','color'=>'#92400e'],
                            'pustakawan'          => ['bg'=>'#dbeafe','color'=>'#1e40af'],
                            'staf_administrasi'   => ['bg'=>'#d1fae5','color'=>'#065f46'],
                            'teknisi'             => ['bg'=>'#ede9fe','color'=>'#5b21b6'],
                        ];
                        $c = $jabatanColors[$petugas->jabatan] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                    @endphp
                    <span style="background:{{ $c['bg'] }};color:{{ $c['color'] }};padding:.3rem .8rem;border-radius:20px;font-size:.75rem;font-weight:600;">
                        {{ $petugas->jabatan_label }}
                    </span>
                    &nbsp;
                    @if($petugas->status === 'aktif')
                        <span class="badge-aktif">✓ Aktif</span>
                    @else
                        <span class="badge-nonaktif">✗ Non-Aktif</span>
                    @endif
                </div>

                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin</span>
                    <span class="detail-value">{{ $petugas->jenis_kelamin_label }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-calendar-date me-1"></i>Tanggal Lahir</span>
                    <span class="detail-value">{{ $petugas->tanggal_lahir->format('d F Y') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-envelope me-1"></i>Email</span>
                    <span class="detail-value">{{ $petugas->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-telephone me-1"></i>No. Telepon</span>
                    <span class="detail-value">{{ $petugas->no_telepon }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-geo-alt me-1"></i>Alamat</span>
                    <span class="detail-value">{{ $petugas->alamat }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-calendar-check me-1"></i>Tanggal Masuk</span>
                    <span class="detail-value">{{ $petugas->tanggal_masuk->format('d F Y') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-clock me-1"></i>Dibuat Pada</span>
                    <span class="detail-value">{{ $petugas->created_at->format('d F Y H:i') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-arrow-repeat me-1"></i>Diperbarui</span>
                    <span class="detail-value">{{ $petugas->updated_at->format('d F Y H:i') }}</span>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <form method="POST" action="{{ route('petugas.destroy', $petugas) }}"
                          onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-3">
                            <i class="bi bi-trash me-1"></i>Hapus Petugas
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection