<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h3>Detail Buku</h3>

    <?php if ($buku): ?>
        <div class="card">
            <div class="card-body">
                <h4><?= esc($buku['judul']); ?></h4>
                <hr>

                <p><strong>Kategori:</strong> <?= esc($buku['nama_kategori']); ?></p>
                <p><strong>Penulis:</strong> <?= esc($buku['nama_penulis']); ?></p>
                <p><strong>Penerbit:</strong> <?= esc($buku['nama_penerbit']); ?></p>
                <p><strong>Tahun Terbit:</strong> <?= esc($buku['tahun_terbit']); ?></p>
                <p><strong>ISBN:</strong> <?= esc($buku['isbn']); ?></p>
                <p><strong>Deskripsi:</strong><br><?= esc($buku['deskripsi']); ?></p>

                <?php if (!empty($buku['cover'])): ?>
                    <div class="mt-3">
                        <img src="<?= base_url('uploads/buku/' . $buku['cover']); ?>" width="200">
                    </div>
                <?php endif; ?>

                <div class="mt-4">
                    <?php if ($from == 'dashboard'): ?>
                        <a href="<?= base_url('dashboard'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
                    <?php else: ?>
                        <a href="<?= base_url('buku'); ?>" class="btn btn-secondary">Kembali ke Daftar Buku</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            Data buku tidak ditemukan.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>