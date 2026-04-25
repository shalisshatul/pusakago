<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Penerbit</h4>

        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
            <a href="<?= base_url('penerbit/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="get" action="<?= base_url('penerbit') ?>" class="d-flex gap-2">

                <input type="text" name="keyword"
                       class="form-control"
                       placeholder="Cari penerbit..."
                       value="<?= $_GET['keyword'] ?? '' ?>">

                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>

                <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">
                    Reset
                </a>

            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="80">ID</th>
                        <th>Nama Penerbit</th>
                        <th>Alamat</th>
                        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                            <th width="120">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($penerbit)): ?>
                        <?php foreach ($penerbit as $k): ?>
                        <tr>
                            <td><?= $k['id_penerbit'] ?></td>
                            <td class="fw-semibold"><?= $k['nama_penerbit'] ?></td>
                            <td class="text-muted"><?= $k['alamat'] ?></td>

                            <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                            <td>
                                <div class="btn-group btn-group-sm">

                                    <a href="<?= base_url('penerbit/edit/'.$k['id_penerbit']) ?>"
                                       class="btn btn-warning text-white">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('penerbit/delete/'.$k['id_penerbit']) ?>"
                                       onclick="return confirm('Hapus data ini?')"
                                       class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data penerbit
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>