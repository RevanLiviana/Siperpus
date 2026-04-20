@extends('layouts.app')

@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}" class="text-muted text-decoration-none">Anggota</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-plus-fill me-2" style="color:var(--primary)"></i>Form Tambah Anggota
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('anggota.store') }}">
                    @csrf

                    <div class="row g-3">
                        {{-- No Anggota (readonly) --}}
                        <div class="col-md-6">
                            <label class="form-label">No. Anggota <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light" value="{{ $noAnggota }}" readonly>
                            <div class="form-text">Generate otomatis oleh sistem</div>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="aktif"     {{ old('status','aktif')=='aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ old('status')=='non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Nama Lengkap --}}
                        <div class="col-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap"
                                   class="form-control @error('nama_lengkap') is-invalid @enderror"
                                   value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap">
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir"
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="contoh@email.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- No. Telepon --}}
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telepon"
                                   class="form-control @error('no_telepon') is-invalid @enderror"
                                   value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx">
                            @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Tanggal Daftar --}}
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_daftar"
                                   class="form-control @error('tanggal_daftar') is-invalid @enderror"
                                   value="{{ old('tanggal_daftar', date('Y-m-d')) }}">
                            @error('tanggal_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Tanggal Expire --}}
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Expire <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_expire"
                                   class="form-control @error('tanggal_expire') is-invalid @enderror"
                                   value="{{ old('tanggal_expire', date('Y-m-d', strtotime('+1 year'))) }}">
                            @error('tanggal_expire')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="col-12">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary rounded-3">
                            <i class="bi bi-x-lg me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary rounded-3">
                            <i class="bi bi-save me-1"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection