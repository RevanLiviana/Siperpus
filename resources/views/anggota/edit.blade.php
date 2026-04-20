@extends('layouts.app')

@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}" class="text-muted text-decoration-none">Anggota</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square me-2" style="color:var(--accent)"></i>Edit Data Anggota — {{ $anggota->no_anggota }}
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('anggota.update', $anggota) }}">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">No. Anggota</label>
                            <input type="text" class="form-control bg-light" value="{{ $anggota->no_anggota }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="aktif"     {{ old('status', $anggota->status)=='aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ old('status', $anggota->status)=='non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap"
                                   class="form-control @error('nama_lengkap') is-invalid @enderror"
                                   value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}">
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin)=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin)=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir"
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   value="{{ old('tanggal_lahir', $anggota->tanggal_lahir->format('Y-m-d')) }}">
                            @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $anggota->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telepon"
                                   class="form-control @error('no_telepon') is-invalid @enderror"
                                   value="{{ old('no_telepon', $anggota->no_telepon) }}">
                            @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_daftar"
                                   class="form-control @error('tanggal_daftar') is-invalid @enderror"
                                   value="{{ old('tanggal_daftar', $anggota->tanggal_daftar->format('Y-m-d')) }}">
                            @error('tanggal_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Expire <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_expire"
                                   class="form-control @error('tanggal_expire') is-invalid @enderror"
                                   value="{{ old('tanggal_expire', $anggota->tanggal_expire->format('Y-m-d')) }}">
                            @error('tanggal_expire')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $anggota->alamat) }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary rounded-3">
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