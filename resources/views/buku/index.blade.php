@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Data Buku</h5>
        <small class="text-muted">Kelola data koleksi buku perpustakaan</small>
    </div>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </a>
</div>

{{-- FILTER & SEARCH --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('buku.index') }}" class="row g-2">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control"
                    placeholder="Cari judul, kode, pengarang, ISBN..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- TABEL --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book me-2"></i>Daftar Buku</span>
        <small class="text-muted">Total: {{ $buku->total() }} buku</small>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku as $index => $item)
                    <tr>
                        <td>{{ $buku->firstItem() + $index }}</td>
                        <td><code>{{ $item->kode_buku }}</code></td>
                        <td>
                            <span class="fw-semibold">{{ $item->judul }}</span><br>
                            <small class="text-muted">{{ $item->penerbit }}, {{ $item->tahun_terbit }}</small>
                        </td>
                        <td>{{ $item->pengarang }}</td>
                        <td><span class="badge bg-secondary">{{ $item->kategori }}</span></td>
                        <td>
                            <span class="fw-bold">{{ $item->stok_tersedia }}</span>
                            <small class="text-muted">/ {{ $item->stok }}</small>
                        </td>
                        <td>
                            @if($item->status == 'tersedia')
                                <span class="badge-aktif">Tersedia</span>
                            @else
                                <span class="badge-nonaktif">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('buku.show', $item) }}"
                                   class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('buku.edit', $item) }}"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Tidak ada data buku
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($buku->hasPages())
    <div class="card-footer">
        {{ $buku->links() }}
    </div>
    @endif
</div>
@endsection