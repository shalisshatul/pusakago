<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Data Buku</h4>
            <small class="text-muted">Kelola koleksi buku perpustakaan</small>
        </div>

        <?php if (in_array(session()->get('role'), ['admin','petugas'])): ?>
            <a href="<?= base_url('buku/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="get" class="d-flex gap-2">
                <input type="text" name="keyword"
                    class="form-control"
                    placeholder="Cari buku..."
                    value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penerbit</th>
                            <th>Penulis</th>
                            <th>Rak</th>
                            <th>Stok</th>
                            <th>Cover</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($buku)): ?>
                        <?php foreach ($buku as $b): ?>
                        <tr>

                            <td class="text-muted"><?= $b['id_buku'] ?></td>

                            <!-- JUDUL -->
                            <td>
                                <div class="fw-semibold"><?= esc($b['judul']) ?></div>
                            </td>

                            <td><?= esc($b['nama_kategori']) ?></td>
                            <td><?= esc($b['nama_penerbit']) ?></td>
                            <td><?= esc($b['nama_penulis']) ?></td>

                            <!-- RAK -->
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?= esc($b['nama_rak'] ?? '-') ?>
                                </span>
                            </td>

                            <!-- STOK -->
                            <td>
                                <span class="badge bg-<?= ($b['tersedia'] > 0) ? 'success' : 'danger' ?>">
                                    <?= $b['tersedia'] ?>/<?= $b['jumlah'] ?>
                                </span>
                            </td>

                            <!-- COVER -->
                            <td>
                                <?php if (!empty($b['cover'])): ?>
                                    <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>"
                                         style="width:50px;height:70px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">

                                    <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>"
                                       class="btn btn-info text-white">
                                       <i class="bi bi-eye"></i>
                                    </a>

                                    <?php if (in_array(session()->get('role'), ['admin','petugas'])): ?>

                                        <a href="<?= base_url('buku/edit/'.$b['id_buku']) ?>"
                                           class="btn btn-warning">
                                           <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="<?= base_url('buku/delete/'.$b['id_buku']) ?>"
                                           onclick="return confirm('Hapus?')"
                                           class="btn btn-danger">
                                           <i class="bi bi-trash"></i>
                                        </a>

                                    <?php endif; ?>

                                </div>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3"></i><br>
                                Data buku kosong
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>