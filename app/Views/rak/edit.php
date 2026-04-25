<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <div class="mb-3">
        <h4 class="fw-bold">Edit Rak</h4>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form method="post" action="<?= base_url('rak/update/'.$rak['id_rak']) ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Rak</label>
                    <input type="text" name="nama_rak" class="form-control"
                           value="<?= $rak['nama_rak'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                           value="<?= $rak['lokasi'] ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>

                    <a href="<?= base_url('rak') ?>" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>