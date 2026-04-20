@extends('layouts.app')

@section('title', 'Data Petugas')
@section('page-title', 'Data Petugas')

@section('breadcrumb')
    <li class="breadcrumb-item active">Petugas</li>
@endsection

@section('content')
{{-- STAT ROW --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#1a3c6b,#2563eb);">
            <div class="stat-icon"><i class="bi bi-person-badge-fill"></i></div>
            <div class="stat-value">{{ \App\Models\Petugas::count() }}</div>
            <div class="stat-label">Total Petugas</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#065f46,#059669);">
            <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
            <div class="stat-value">{{ \App\Models\Petugas::where('status','aktif')->count() }}</div>
            <div class="stat-label">Petugas Aktif</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#4c1d95,#7c3aed);">
            <div class="stat-icon"><i class="bi bi-book-fill"></i></div>
            <div class="stat-value">{{ \App\Models\Petugas::where('jabatan','pustakawan')->count() }}</div>
            <div class="stat-label">Pustakawan</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#92400e,#d97706);">
            <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
            <div class="stat-value">{{ \App\Models\Petugas::where('status','non-aktif')->count() }}</div>
            <div class="stat-label">Non-Aktif</div>
        </div>
    </div>
</div>

{{-- TABLE CARD --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-person-badge-fill me-2" style="color:var(--primary)"></i>Daftar Petugas</span>
        <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-sm rounded-3 d-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Tambah Petugas
        </a>
    </div>

    <div class="card-body">
        {{-- FILTER --}}
        <form method="GET" action="{{ route('petugas.index') }}" class="row g-2 mb-3">
            <div class="col-md-5">
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, NIP, email…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <select name="jabatan" class="form-select">
                    <option value="">Semua Jabatan</option>
                    <option value="kepala_perpustakaan" {{ request('jabatan')=='kepala_perpustakaan' ? 'selected' : '' }}>Kepala Perpustakaan</option>
                    <option value="pustakawan"          {{ request('jabatan')=='pustakawan' ? 'selected' : '' }}>Pustakawan</option>
                    <option value="staf_administrasi"   {{ request('jabatan')=='staf_administrasi' ? 'selected' : '' }}>Staf Administrasi</option>
                    <option value="teknisi"             {{ request('jabatan')=='teknisi' ? 'selected' : '' }}>Teknisi</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif"     {{ request('status')=='aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="non-aktif" {{ request('status')=='non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel-fill me-1"></i>Filter
                </button>
                <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Kontak</th>
                        <th>Tgl. Masuk</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petugas as $item)
                    <tr>
                        <td>{{ $petugas->firstItem() + $loop->index }}</td>
                        <td><span style="font-weight:700;color:var(--primary)">{{ $item->nip }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar" style="background:{{ $item->jenis_kelamin=='L' ? '#dbeafe' : '#fce7f3' }};color:{{ $item->jenis_kelamin=='L' ? '#1d4ed8' : '#9d174d' }};">
                                    {{ strtoupper(substr($item->nama_lengkap, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;color:#1f2937;">{{ $item->nama_lengkap }}</div>
                                    <div style="font-size:.72rem;color:#9ca3af;">{{ $item->jenis_kelamin_label }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $jabatanColors = [
                                    'kepala_perpustakaan' => ['bg'=>'#fef3c7','color'=>'#92400e'],
                                    'pustakawan'          => ['bg'=>'#dbeafe','color'=>'#1e40af'],
                                    'staf_administrasi'   => ['bg'=>'#d1fae5','color'=>'#065f46'],
                                    'teknisi'             => ['bg'=>'#ede9fe','color'=>'#5b21b6'],
                                ];
                                $c = $jabatanColors[$item->jabatan] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                            @endphp
                            <span style="background:{{ $c['bg'] }};color:{{ $c['color'] }};padding:.28rem .65rem;border-radius:20px;font-size:.72rem;font-weight:600;">
                                {{ $item->jabatan_label }}
                            </span>
                        </td>
                        <td>
                            <div style="font-size:.8rem;">{{ $item->email }}</div>
                            <div style="font-size:.75rem;color:#9ca3af;">{{ $item->no_telepon }}</div>
                        </td>
                        <td style="font-size:.82rem;">{{ $item->tanggal_masuk->format('d/m/Y') }}</td>
                        <td>
                            @if($item->status === 'aktif')
                                <span class="badge-aktif">✓ Aktif</span>
                            @else
                                <span class="badge-nonaktif">✗ Non-Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('petugas.show', $item) }}" class="btn-action btn btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('petugas.edit', $item) }}" class="btn-action btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('petugas.destroy', $item) }}" onsubmit="return confirm('Hapus petugas ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Tidak ada data petugas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($petugas->hasPages())
        <div class="d-flex align-items-center justify-content-between mt-3">
            <small class="text-muted">
                Menampilkan {{ $petugas->firstItem() }}–{{ $petugas->lastItem() }} dari {{ $petugas->total() }} data
            </small>
            {{ $petugas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection