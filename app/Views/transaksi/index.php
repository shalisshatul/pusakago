<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <div class="mb-3">
        <h4 class="fw-bold">Pembayaran Ongkir</h4>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body text-center">

            <h5 class="mb-3">Total Ongkir</h5>
            <h3 class="fw-bold text-primary">
                Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?>
            </h3>

            <p class="text-muted mt-2">
                Silakan klik tombol di bawah untuk melanjutkan pembayaran
            </p>

            <form action="<?= base_url('transaksi/proses') ?>" method="post">
                <input type="hidden" name="id_peminjaman" value="<?= $transaksi['id_peminjaman'] ?>">

                <button type="submit" class="btn btn-success mt-3">
                    <i class="bi bi-credit-card"></i> Bayar Sekarang
                </button>
            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>