@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- ALERT ERROR ROLE (muncul saat Anggota coba akses Create Buku) --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-shield-lock-fill fs-5"></i>
        <div>
            <strong>Akses Ditolak!</strong> {{ session('error') }}
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- ALERT SUCCESS --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- DASHBOARD ANGGOTA: tampilkan link Tambah Buku --}}
@if (auth()->user()->role === 'anggota')
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-person-circle me-2"></i>Dashboard Anggota — {{ auth()->user()->nama }}
        </div>
        <div class="card-body">
            <p class="mb-3">Selamat datang! Berikut menu yang tersedia untuk Anda:</p>
            <div class="d-flex gap-2 flex-wrap">
                {{-- Link ini akan ditolak karena role bukan Admin --}}
                <a href="{{ route('buku.create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Buku Baru
                </a>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-book me-1"></i> Lihat Daftar Buku
                </a>
            </div>
            <small class="text-muted d-block mt-2">
                * Tombol "Tambah Buku Baru" hanya untuk demonstrasi validasi role.
            </small>
        </div>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg,#e94560,#c73652);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 fw-bold">{{ \App\Models\Anggota::count() }}</div>
                    <div class="opacity-75">Total Anggota</div>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg,#0f3460,#16213e);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 fw-bold">{{ \App\Models\Petugas::count() }}</div>
                    <div class="opacity-75">Total Petugas</div>
                </div>
                <i class="bi bi-person-badge fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg,#2ecc71,#27ae60);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 fw-bold">{{ \App\Models\Buku::count() }}</div>
                    <div class="opacity-75">Total Buku</div>
                </div>
                <i class="bi bi-book fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg,#f39c12,#e67e22);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 fw-bold">{{ \App\Models\Buku::where('status','tersedia')->sum('stok_tersedia') }}</div>
                    <div class="opacity-75">Stok Tersedia</div>
                </div>
                <i class="bi bi-archive fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-people me-2"></i>Anggota Terbaru</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. Anggota</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Anggota::latest()->take(5)->get() as $a)
                        <tr>
                            <td>{{ $a->nama_lengkap }}</td>
                            <td><code>{{ $a->no_anggota }}</code></td>
                            <td>
                                @if($a->status == 'aktif')
                                    <span class="badge-aktif">Aktif</span>
                                @else
                                    <span class="badge-nonaktif">Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-book me-2"></i>Buku Terbaru</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Buku::latest()->take(5)->get() as $b)
                        <tr>
                            <td>{{ Str::limit($b->judul, 30) }}</td>
                            <td><span class="badge bg-secondary">{{ $b->kategori }}</span></td>
                            <td>{{ $b->stok_tersedia }}/{{ $b->stok }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection