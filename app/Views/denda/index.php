<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- HEADER -->
    <div class="mb-3">
        <h4 class="fw-bold">Pembayaran Denda</h4>
        <small class="text-muted">Silakan lakukan pembayaran denda</small>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0" style="max-width:500px;">
        <div class="card-body">

            <p><b>Nama:</b><br><?= $denda['nama'] ?></p>

            <p>
                <b>Total Denda:</b><br>
                <span class="text-danger fw-bold fs-5">
                    Rp <?= number_format($denda['denda'], 0, ',', '.') ?>
                </span>
            </p>

            <form action="<?= base_url('denda/bayar') ?>" method="post">

                <input type="hidden" name="id_pengembalian" value="<?= $denda['id_pengembalian'] ?>">
                <input type="hidden" name="jumlah_denda" value="<?= $denda['denda'] ?>">

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-success">
                        Bayar Sekarang
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>