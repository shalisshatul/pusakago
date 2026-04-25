<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- TITLE + BUTTON -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Penulis</h4>

        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
            <a href="<?= base_url('penulis/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="get" action="<?= base_url('penulis') ?>" class="d-flex gap-2">

                <input type="text" name="keyword"
                       class="form-control"
                       placeholder="Cari penulis..."
                       value="<?= $_GET['keyword'] ?? '' ?>">

                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>

            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama Penulis</th>
                        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($penulis as $k): ?>
                    <tr>
                        <td><?= $k['id_penulis'] ?></td>
                        <td><?= $k['nama_penulis'] ?></td>

                        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                        <td>
                            <div class="btn-group btn-group-sm">

                                <a href="<?= base_url('penulis/edit/'.$k['id_penulis']) ?>"
                                   class="btn btn-warning text-white">
                                   <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= base_url('penulis/delete/'.$k['id_penulis']) ?>"
                                   onclick="return confirm('Hapus?')"
                                   class="btn btn-danger">
                                   <i class="bi bi-trash"></i>
                                </a>

                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>