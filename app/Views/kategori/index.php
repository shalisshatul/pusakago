<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Kategori</h4>

        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
            <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH -->
    <form method="get" action="<?= base_url('kategori') ?>" class="mb-3">
        <div class="input-group" style="max-width:300px;">
            <input type="text" name="keyword" class="form-control" placeholder="Cari kategori...">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="80">ID</th>
                        <th>Nama Kategori</th>

                        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                            <th width="150">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($kategori)): ?>
                        <?php foreach ($kategori as $k): ?>
                        <tr>
                            <td><?= $k['id_kategori'] ?></td>
                            <td class="fw-semibold"><?= $k['nama_kategori'] ?></td>

                            <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                            <td>
                                <a href="<?= base_url('kategori/edit/'.$k['id_kategori']) ?>"
                                   class="btn btn-sm btn-warning">
                                   Edit
                                </a>

                                <a href="<?= base_url('kategori/delete/'.$k['id_kategori']) ?>"
                                   onclick="return confirm('Yakin hapus?')"
                                   class="btn btn-sm btn-danger">
                                   Hapus
                                </a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3"></i><br>
                                Belum ada data kategori
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>