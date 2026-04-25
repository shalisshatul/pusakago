<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <div class="mb-3">
        <h4 class="fw-bold">Edit Penulis</h4>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form method="post" action="<?= base_url('penulis/update/'.$penulis['id_penulis']) ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Penulis</label>
                    <input type="text" name="nama_penulis"
                           class="form-control"
                           value="<?= $penulis['nama_penulis'] ?>"
                           required>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>

                    <a href="<?= base_url('penulis') ?>" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>