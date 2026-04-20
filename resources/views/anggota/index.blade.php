@extends('layouts.app')

@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('breadcrumb')
    <li class="breadcrumb-item active">Anggota</li>
@endsection

@section('content')
{{-- STAT ROW --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#1a3c6b,#2563eb);">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value">{{ \App\Models\Anggota::count() }}</div>
            <div class="stat-label">Total Anggota</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#065f46,#059669);">
            <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
            <div class="stat-value">{{ \App\Models\Anggota::where('status','aktif')->count() }}</div>
            <div class="stat-label">Anggota Aktif</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#92400e,#d97706);">
            <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
            <div class="stat-value">{{ \App\Models\Anggota::where('status','non-aktif')->count() }}</div>
            <div class="stat-label">Anggota Non-Aktif</div>
        </div>
    </div>
</div>

{{-- TABLE CARD --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people-fill me-2" style="color:var(--primary)"></i>Daftar Anggota</span>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm rounded-3 d-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Tambah Anggota
        </a>
    </div>

    <div class="card-body">
        {{-- FILTER --}}
        <form method="GET" action="{{ route('anggota.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, no. anggota, email…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif"     {{ request('status') == 'aktif'     ? 'selected' : '' }}>Aktif</option>
                    <option value="non-aktif" {{ request('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel-fill me-1"></i>Filter
                </button>
                <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Anggota</th>
                        <th>Nama Lengkap</th>
                        <th>Kontak</th>
                        <th>Tgl. Daftar</th>
                        <th>Expire</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $item)
                    <tr>
                        <td>{{ $anggota->firstItem() + $loop->index }}</td>
                        <td><span class="fw-700" style="font-weight:700;color:var(--primary)">{{ $item->no_anggota }}</span></td>
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
                            <div style="font-size:.8rem;">{{ $item->email }}</div>
                            <div style="font-size:.75rem;color:#9ca3af;">{{ $item->no_telepon }}</div>
                        </td>
                        <td style="font-size:.82rem;">{{ $item->tanggal_daftar->format('d/m/Y') }}</td>
                        <td style="font-size:.82rem;">{{ $item->tanggal_expire->format('d/m/Y') }}</td>
                        <td>
                            @if($item->status === 'aktif')
                                <span class="badge-aktif">✓ Aktif</span>
                            @else
                                <span class="badge-nonaktif">✗ Non-Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('anggota.show', $item) }}" class="btn-action btn btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('anggota.edit', $item) }}" class="btn-action btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('anggota.destroy', $item) }}" onsubmit="return confirm('Hapus anggota ini?')">
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
                            Tidak ada data anggota.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($anggota->hasPages())
        <div class="d-flex align-items-center justify-content-between mt-3">
            <small class="text-muted">
                Menampilkan {{ $anggota->firstItem() }}–{{ $anggota->lastItem() }} dari {{ $anggota->total() }} data
            </small>
            {{ $anggota->links() }}
        </div>
        @endif
    </div>
</div>
@endsection