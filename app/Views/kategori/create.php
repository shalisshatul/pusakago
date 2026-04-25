<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- HEADER -->
    <div class="mb-3">
        <h4 class="fw-bold">Tambah Kategori</h4>
        <small class="text-muted">Tambahkan data kategori baru</small>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0" style="max-width:500px;">
        <div class="card-body">

            <form method="post" action="<?= base_url('kategori/store') ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
                           required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>