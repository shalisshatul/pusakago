<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <h4 class="fw-bold mb-3">Form Pengembalian</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="<?= base_url('pengembalian/store') ?>" method="post">

                <input type="hidden" name="id_peminjaman"
                       value="<?= $peminjaman['id_peminjaman'] ?>">

                <div class="mb-3">
                    <label class="form-label">Tanggal Dikembalikan</label>
                    <input type="date" name="tanggal_dikembalikan"
                           class="form-control" required>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>

                    <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>