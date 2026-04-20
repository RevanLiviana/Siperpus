@extends('layouts.app')

@section('title', 'Detail Anggota')
@section('page-title', 'Detail Anggota')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}" class="text-muted text-decoration-none">Anggota</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-person-circle me-2" style="color:var(--primary)"></i>Detail Anggota</span>
                <div class="d-flex gap-2">
                    <a href="{{ route('anggota.edit', $anggota) }}" class="btn btn-warning btn-sm rounded-3">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">

                {{-- Avatar Header --}}
                <div class="text-center mb-4 pb-3 border-bottom">
                    <div class="avatar mx-auto mb-3"
                         style="width:72px;height:72px;font-size:1.5rem;background:{{ $anggota->jenis_kelamin=='L' ? '#dbeafe' : '#fce7f3' }};color:{{ $anggota->jenis_kelamin=='L' ? '#1d4ed8' : '#9d174d' }};">
                        {{ strtoupper(substr($anggota->nama_lengkap, 0, 2)) }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ $anggota->nama_lengkap }}</h5>
                    <p class="text-muted mb-2" style="font-size:.85rem;">{{ $anggota->no_anggota }}</p>
                    @if($anggota->status === 'aktif')
                        <span class="badge-aktif">✓ Aktif</span>
                    @else
                        <span class="badge-nonaktif">✗ Non-Aktif</span>
                    @endif
                </div>

                {{-- Detail Items --}}
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin</span>
                    <span class="detail-value">{{ $anggota->jenis_kelamin_label }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-calendar-date me-1"></i>Tanggal Lahir</span>
                    <span class="detail-value">{{ $anggota->tanggal_lahir->format('d F Y') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-envelope me-1"></i>Email</span>
                    <span class="detail-value">{{ $anggota->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-telephone me-1"></i>No. Telepon</span>
                    <span class="detail-value">{{ $anggota->no_telepon }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-geo-alt me-1"></i>Alamat</span>
                    <span class="detail-value">{{ $anggota->alamat }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-calendar-check me-1"></i>Tanggal Daftar</span>
                    <span class="detail-value">{{ $anggota->tanggal_daftar->format('d F Y') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-calendar-x me-1"></i>Tanggal Expire</span>
                    <span class="detail-value">{{ $anggota->tanggal_expire->format('d F Y') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-clock me-1"></i>Dibuat Pada</span>
                    <span class="detail-value">{{ $anggota->created_at->format('d F Y H:i') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="bi bi-arrow-repeat me-1"></i>Diperbarui</span>
                    <span class="detail-value">{{ $anggota->updated_at->format('d F Y H:i') }}</span>
                </div>

                {{-- Delete Action --}}
                <div class="mt-4 pt-3 border-top">
                    <form method="POST" action="{{ route('anggota.destroy', $anggota) }}"
                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-3">
                            <i class="bi bi-trash me-1"></i>Hapus Anggota
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection