@extends('layouts.app')

@section('title', 'Edit Petugas')
@section('page-title', 'Edit Petugas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.index') }}" class="text-muted text-decoration-none">Petugas</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square me-2" style="color:var(--accent)"></i>Edit Data Petugas — {{ $petugas->nip }}
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('petugas.update', $petugas) }}">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control bg-light" value="{{ $petugas->nip }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="aktif"     {{ old('status', $petugas->status)=='aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ old('status', $petugas->status)=='non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap"
                                   class="form-control @error('nama_lengkap') is-invalid @enderror"
                                   value="{{ old('nama_lengkap', $petugas->nama_lengkap) }}">
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="L" {{ old('jenis_kelamin', $petugas->jenis_kelamin)=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $petugas->jenis_kelamin)=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir"
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   value="{{ old('tanggal_lahir', $petugas->tanggal_lahir->format('Y-m-d')) }}">
                            @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $petugas->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telepon"
                                   class="form-control @error('no_telepon') is-invalid @enderror"
                                   value="{{ old('no_telepon', $petugas->no_telepon) }}">
                            @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror">
                                <option value="kepala_perpustakaan" {{ old('jabatan', $petugas->jabatan)=='kepala_perpustakaan' ? 'selected' : '' }}>Kepala Perpustakaan</option>
                                <option value="pustakawan"          {{ old('jabatan', $petugas->jabatan)=='pustakawan' ? 'selected' : '' }}>Pustakawan</option>
                                <option value="staf_administrasi"   {{ old('jabatan', $petugas->jabatan)=='staf_administrasi' ? 'selected' : '' }}>Staf Administrasi</option>
                                <option value="teknisi"             {{ old('jabatan', $petugas->jabatan)=='teknisi' ? 'selected' : '' }}>Teknisi</option>
                            </select>
                            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk"
                                   class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                   value="{{ old('tanggal_masuk', $petugas->tanggal_masuk->format('Y-m-d')) }}">
                            @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $petugas->alamat) }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary rounded-3">
                            <i class="bi bi-x-lg me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-warning rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i>Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection