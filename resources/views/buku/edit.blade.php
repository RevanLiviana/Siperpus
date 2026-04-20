@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Edit Buku</h5>
        <small class="text-muted">{{ $buku->kode_buku }} - {{ $buku->judul }}</small>
    </div>
    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil-square me-2"></i>Form Edit Buku
    </div>
    <div class="card-body">
        <form action="{{ route('buku.update', $buku) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                {{-- KODE BUKU --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kode Buku</label>
                    <input type="text" class="form-control bg-light"
                        value="{{ $buku->kode_buku }}" readonly>
                </div>

                {{-- ISBN --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">ISBN <span class="text-muted fw-normal">(opsional)</span></label>
                    <input type="text" name="isbn"
                        class="form-control @error('isbn') is-invalid @enderror"
                        value="{{ old('isbn', $buku->isbn) }}" placeholder="978-xxx-xxx-xxx-x">
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $buku->kategori) == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JUDUL --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" name="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $buku->judul) }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PENGARANG --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" name="pengarang"
                        class="form-control @error('pengarang') is-invalid @enderror"
                        value="{{ old('pengarang', $buku->pengarang) }}">
                    @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PENERBIT --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Penerbit <span class="text-danger">*</span></label>
                    <input type="text" name="penerbit"
                        class="form-control @error('penerbit') is-invalid @enderror"
                        value="{{ old('penerbit', $buku->penerbit) }}">
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TAHUN TERBIT --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_terbit"
                        class="form-control @error('tahun_terbit') is-invalid @enderror"
                        value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                        min="1900" max="{{ date('Y') }}">
                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STOK --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok"
                        class="form-control @error('stok') is-invalid @enderror"
                        value="{{ old('stok', $buku->stok) }}" min="1">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Stok tersedia saat ini: {{ $buku->stok_tersedia }}</small>
                </div>

                {{-- LOKASI RAK --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Lokasi Rak</label>
                    <input type="text" name="lokasi_rak"
                        class="form-control @error('lokasi_rak') is-invalid @enderror"
                        value="{{ old('lokasi_rak', $buku->lokasi_rak) }}" placeholder="Contoh: A-01">
                    @error('lokasi_rak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="tersedia" {{ old('status', $buku->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tidak_tersedia" {{ old('status', $buku->status) == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary px-4">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection