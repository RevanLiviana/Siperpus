<?php $__env->startSection('title', 'Data Petugas'); ?>
<?php $__env->startSection('page-title', 'Data Petugas'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Petugas</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#1a3c6b,#2563eb);">
            <div class="stat-icon"><i class="bi bi-person-badge-fill"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Petugas::count()); ?></div>
            <div class="stat-label">Total Petugas</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#065f46,#059669);">
            <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Petugas::where('status','aktif')->count()); ?></div>
            <div class="stat-label">Petugas Aktif</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#4c1d95,#7c3aed);">
            <div class="stat-icon"><i class="bi bi-book-fill"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Petugas::where('jabatan','pustakawan')->count()); ?></div>
            <div class="stat-label">Pustakawan</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#92400e,#d97706);">
            <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Petugas::where('status','non-aktif')->count()); ?></div>
            <div class="stat-label">Non-Aktif</div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-person-badge-fill me-2" style="color:var(--primary)"></i>Daftar Petugas</span>
        <a href="<?php echo e(route('petugas.create')); ?>" class="btn btn-primary btn-sm rounded-3 d-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Tambah Petugas
        </a>
    </div>

    <div class="card-body">
        
        <form method="GET" action="<?php echo e(route('petugas.index')); ?>" class="row g-2 mb-3">
            <div class="col-md-5">
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, NIP, email…" value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <select name="jabatan" class="form-select">
                    <option value="">Semua Jabatan</option>
                    <option value="kepala_perpustakaan" <?php echo e(request('jabatan')=='kepala_perpustakaan' ? 'selected' : ''); ?>>Kepala Perpustakaan</option>
                    <option value="pustakawan"          <?php echo e(request('jabatan')=='pustakawan' ? 'selected' : ''); ?>>Pustakawan</option>
                    <option value="staf_administrasi"   <?php echo e(request('jabatan')=='staf_administrasi' ? 'selected' : ''); ?>>Staf Administrasi</option>
                    <option value="teknisi"             <?php echo e(request('jabatan')=='teknisi' ? 'selected' : ''); ?>>Teknisi</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif"     <?php echo e(request('status')=='aktif' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="non-aktif" <?php echo e(request('status')=='non-aktif' ? 'selected' : ''); ?>>Non-Aktif</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel-fill me-1"></i>Filter
                </button>
                <a href="<?php echo e(route('petugas.index')); ?>" class="btn btn-outline-secondary flex-fill">Reset</a>
            </div>
        </form>

        
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
                    <?php $__empty_1 = true; $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($petugas->firstItem() + $loop->index); ?></td>
                        <td><span style="font-weight:700;color:var(--primary)"><?php echo e($item->nip); ?></span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar" style="background:<?php echo e($item->jenis_kelamin=='L' ? '#dbeafe' : '#fce7f3'); ?>;color:<?php echo e($item->jenis_kelamin=='L' ? '#1d4ed8' : '#9d174d'); ?>;">
                                    <?php echo e(strtoupper(substr($item->nama_lengkap, 0, 2))); ?>

                                </div>
                                <div>
                                    <div style="font-weight:600;color:#1f2937;"><?php echo e($item->nama_lengkap); ?></div>
                                    <div style="font-size:.72rem;color:#9ca3af;"><?php echo e($item->jenis_kelamin_label); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php
                                $jabatanColors = [
                                    'kepala_perpustakaan' => ['bg'=>'#fef3c7','color'=>'#92400e'],
                                    'pustakawan'          => ['bg'=>'#dbeafe','color'=>'#1e40af'],
                                    'staf_administrasi'   => ['bg'=>'#d1fae5','color'=>'#065f46'],
                                    'teknisi'             => ['bg'=>'#ede9fe','color'=>'#5b21b6'],
                                ];
                                $c = $jabatanColors[$item->jabatan] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                            ?>
                            <span style="background:<?php echo e($c['bg']); ?>;color:<?php echo e($c['color']); ?>;padding:.28rem .65rem;border-radius:20px;font-size:.72rem;font-weight:600;">
                                <?php echo e($item->jabatan_label); ?>

                            </span>
                        </td>
                        <td>
                            <div style="font-size:.8rem;"><?php echo e($item->email); ?></div>
                            <div style="font-size:.75rem;color:#9ca3af;"><?php echo e($item->no_telepon); ?></div>
                        </td>
                        <td style="font-size:.82rem;"><?php echo e($item->tanggal_masuk->format('d/m/Y')); ?></td>
                        <td>
                            <?php if($item->status === 'aktif'): ?>
                                <span class="badge-aktif">✓ Aktif</span>
                            <?php else: ?>
                                <span class="badge-nonaktif">✗ Non-Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="<?php echo e(route('petugas.show', $item)); ?>" class="btn-action btn btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('petugas.edit', $item)); ?>" class="btn-action btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="<?php echo e(route('petugas.destroy', $item)); ?>" onsubmit="return confirm('Hapus petugas ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Tidak ada data petugas.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($petugas->hasPages()): ?>
        <div class="d-flex align-items-center justify-content-between mt-3">
            <small class="text-muted">
                Menampilkan <?php echo e($petugas->firstItem()); ?>–<?php echo e($petugas->lastItem()); ?> dari <?php echo e($petugas->total()); ?> data
            </small>
            <?php echo e($petugas->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/holykun/Documents/File PHP Laravel/belajar_php/siperpus/resources/views/petugas/index.blade.php ENDPATH**/ ?>