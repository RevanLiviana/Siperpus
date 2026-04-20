<?php $__env->startSection('title', 'Data Anggota'); ?>
<?php $__env->startSection('page-title', 'Data Anggota'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Anggota</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#1a3c6b,#2563eb);">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Anggota::count()); ?></div>
            <div class="stat-label">Total Anggota</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#065f46,#059669);">
            <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Anggota::where('status','aktif')->count()); ?></div>
            <div class="stat-label">Anggota Aktif</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#92400e,#d97706);">
            <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
            <div class="stat-value"><?php echo e(\App\Models\Anggota::where('status','non-aktif')->count()); ?></div>
            <div class="stat-label">Anggota Non-Aktif</div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people-fill me-2" style="color:var(--primary)"></i>Daftar Anggota</span>
        <a href="<?php echo e(route('anggota.create')); ?>" class="btn btn-primary btn-sm rounded-3 d-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Tambah Anggota
        </a>
    </div>

    <div class="card-body">
        
        <form method="GET" action="<?php echo e(route('anggota.index')); ?>" class="row g-2 mb-3">
            <div class="col-md-6">
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, no. anggota, email…" value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif"     <?php echo e(request('status') == 'aktif'     ? 'selected' : ''); ?>>Aktif</option>
                    <option value="non-aktif" <?php echo e(request('status') == 'non-aktif' ? 'selected' : ''); ?>>Non-Aktif</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel-fill me-1"></i>Filter
                </button>
                <a href="<?php echo e(route('anggota.index')); ?>" class="btn btn-outline-secondary flex-fill">Reset</a>
            </div>
        </form>

        
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
                    <?php $__empty_1 = true; $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($anggota->firstItem() + $loop->index); ?></td>
                        <td><span class="fw-700" style="font-weight:700;color:var(--primary)"><?php echo e($item->no_anggota); ?></span></td>
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
                            <div style="font-size:.8rem;"><?php echo e($item->email); ?></div>
                            <div style="font-size:.75rem;color:#9ca3af;"><?php echo e($item->no_telepon); ?></div>
                        </td>
                        <td style="font-size:.82rem;"><?php echo e($item->tanggal_daftar->format('d/m/Y')); ?></td>
                        <td style="font-size:.82rem;"><?php echo e($item->tanggal_expire->format('d/m/Y')); ?></td>
                        <td>
                            <?php if($item->status === 'aktif'): ?>
                                <span class="badge-aktif">✓ Aktif</span>
                            <?php else: ?>
                                <span class="badge-nonaktif">✗ Non-Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="<?php echo e(route('anggota.show', $item)); ?>" class="btn-action btn btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('anggota.edit', $item)); ?>" class="btn-action btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="<?php echo e(route('anggota.destroy', $item)); ?>" onsubmit="return confirm('Hapus anggota ini?')">
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
                            Tidak ada data anggota.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($anggota->hasPages()): ?>
        <div class="d-flex align-items-center justify-content-between mt-3">
            <small class="text-muted">
                Menampilkan <?php echo e($anggota->firstItem()); ?>–<?php echo e($anggota->lastItem()); ?> dari <?php echo e($anggota->total()); ?> data
            </small>
            <?php echo e($anggota->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/holykun/Documents/File PHP Laravel/belajar_php/siperpus/resources/views/anggota/index.blade.php ENDPATH**/ ?>