@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Tambah Buku</h5>
        <small class="text-muted">Tambahkan koleksi buku baru</small>
    </div>
    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-book-half me-2"></i>Form Tambah Buku
    </div>
    <div class="card-body">

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Input tidak valid!</strong>
                Perbaiki kesalahan berikut:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- PENTING: enctype="multipart/form-data" wajib ada untuk upload cover --}}
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                {{-- KODE BUKU --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kode Buku</label>
                    <input type="text" class="form-control bg-light"
                        value="{{ $kodeBuku }}" readonly>
                    <small class="text-muted">Generate otomatis</small>
                </div>

                {{-- ISBN --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">ISBN <span class="text-muted fw-normal">(opsional)</span></label>
                    <input type="text" name="isbn"
                        class="form-control @error('isbn') is-invalid @enderror"
                        value="{{ old('isbn') }}" placeholder="978-xxx-xxx-xxx-x">
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
                            <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
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
                        value="{{ old('judul') }}" placeholder="Masukkan judul buku (5-100 karakter)">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Minimal 5, maksimal 100 karakter</small>
                </div>

                {{-- PENGARANG --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" name="pengarang"
                        class="form-control @error('pengarang') is-invalid @enderror"
                        value="{{ old('pengarang') }}" placeholder="Nama pengarang (3-30 karakter)">
                    @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Minimal 3, maksimal 30 karakter</small>
                </div>

                {{-- PENERBIT --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Penerbit <span class="text-danger">*</span></label>
                    <input type="text" name="penerbit"
                        class="form-control @error('penerbit') is-invalid @enderror"
                        value="{{ old('penerbit') }}" placeholder="Nama penerbit (3-30 karakter)">
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Minimal 3, maksimal 30 karakter</small>
                </div>

                {{-- TAHUN TERBIT --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_terbit"
                        class="form-control @error('tahun_terbit') is-invalid @enderror"
                        value="{{ old('tahun_terbit') }}" placeholder="{{ date('Y') }}"
                        min="2020" max="{{ date('Y') }}">
                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Antara 2020 s.d {{ date('Y') }}</small>
                </div>

                {{-- STOK --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok"
                        class="form-control @error('stok') is-invalid @enderror"
                        value="{{ old('stok', 1) }}" min="1">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- LOKASI RAK --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Lokasi Rak <span class="text-muted fw-normal">(opsional)</span></label>
                    <input type="text" name="lokasi_rak"
                        class="form-control @error('lokasi_rak') is-invalid @enderror"
                        value="{{ old('lokasi_rak') }}" placeholder="Contoh: A-01">
                    @error('lokasi_rak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="tersedia" {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tidak_tersedia" {{ old('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- COVER BUKU --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Cover Buku <span class="text-danger">*</span></label>
                    <input type="file" name="cover" accept=".jpg,.jpeg"
                        class="form-control @error('cover') is-invalid @enderror">
                    @error('cover')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG/JPEG saja | Ukuran: 50 KB – 200 KB</small>
                </div>

                {{-- DESKRIPSI --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi <span class="text-muted fw-normal">(opsional)</span></label>
                    <textarea name="deskripsi" rows="4"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Sinopsis atau keterangan buku...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary px-4">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection