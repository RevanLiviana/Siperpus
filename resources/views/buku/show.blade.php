@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Detail Buku</h5>
        <small class="text-muted">{{ $buku->kode_buku }}</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('buku.edit', $buku) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle me-2"></i>Informasi Buku
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="180">Kode Buku</td>
                        <td><code>{{ $buku->kode_buku }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Judul</td>
                        <td class="fw-semibold">{{ $buku->judul }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pengarang</td>
                        <td>{{ $buku->pengarang }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Penerbit</td>
                        <td>{{ $buku->penerbit }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tahun Terbit</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">ISBN</td>
                        <td>{{ $buku->isbn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kategori</td>
                        <td><span class="badge bg-secondary">{{ $buku->kategori }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Lokasi Rak</td>
                        <td>{{ $buku->lokasi_rak ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Deskripsi</td>
                        <td>{{ $buku->deskripsi ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart me-2"></i>Stok & Status
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    @if($buku->status == 'tersedia')
                        <span class="badge-aktif fs-6">Tersedia</span>
                    @else
                        <span class="badge-nonaktif fs-6">Tidak Tersedia</span>
                    @endif
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="fs-2 fw-bold text-primary">{{ $buku->stok_tersedia }}</div>
                        <small class="text-muted">Stok Tersedia</small>
                    </div>
                    <div class="col-6">
                        <div class="fs-2 fw-bold text-secondary">{{ $buku->stok }}</div>
                        <small class="text-muted">Total Stok</small>
                    </div>
                </div>
                <hr>
                <div class="fs-4 fw-bold text-danger">{{ $buku->stok - $buku->stok_tersedia }}</div>
                <small class="text-muted">Sedang Dipinjam</small>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="bi bi-clock-history me-2"></i>Riwayat
            </div>
            <div class="card-body">
                <small class="text-muted d-block">Ditambahkan</small>
                <span>{{ $buku->created_at->format('d M Y, H:i') }}</span>
                <hr>
                <small class="text-muted d-block">Terakhir Diperbarui</small>
                <span>{{ $buku->updated_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection