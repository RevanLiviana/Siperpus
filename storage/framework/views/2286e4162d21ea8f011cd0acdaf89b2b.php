<?php $__env->startSection('title', 'Data Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Data Buku</h5>
        <small class="text-muted">Kelola data koleksi buku perpustakaan</small>
    </div>
    <a href="<?php echo e(route('buku.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </a>
</div>


<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('buku.index')); ?>" class="row g-2">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control"
                    placeholder="Cari judul, kode, pengarang, ISBN..."
                    value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kat); ?>" <?php echo e(request('kategori') == $kat ? 'selected' : ''); ?>>
                            <?php echo e($kat); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" <?php echo e(request('status') == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                    <option value="tidak_tersedia" <?php echo e(request('status') == 'tidak_tersedia' ? 'selected' : ''); ?>>Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="<?php echo e(route('buku.index')); ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book me-2"></i>Daftar Buku</span>
        <small class="text-muted">Total: <?php echo e($buku->total()); ?> buku</small>
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
                    <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($buku->firstItem() + $index); ?></td>
                        <td><code><?php echo e($item->kode_buku); ?></code></td>
                        <td>
                            <span class="fw-semibold"><?php echo e($item->judul); ?></span><br>
                            <small class="text-muted"><?php echo e($item->penerbit); ?>, <?php echo e($item->tahun_terbit); ?></small>
                        </td>
                        <td><?php echo e($item->pengarang); ?></td>
                        <td><span class="badge bg-secondary"><?php echo e($item->kategori); ?></span></td>
                        <td>
                            <span class="fw-bold"><?php echo e($item->stok_tersedia); ?></span>
                            <small class="text-muted">/ <?php echo e($item->stok); ?></small>
                        </td>
                        <td>
                            <?php if($item->status == 'tersedia'): ?>
                                <span class="badge-aktif">Tersedia</span>
                            <?php else: ?>
                                <span class="badge-nonaktif">Tidak Tersedia</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('buku.show', $item)); ?>"
                                   class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('buku.edit', $item)); ?>"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('buku.destroy', $item)); ?>" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Tidak ada data buku
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($buku->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($buku->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/holykun/Documents/File PHP Laravel/belajar_php/siperpus/resources/views/buku/index.blade.php ENDPATH**/ ?>