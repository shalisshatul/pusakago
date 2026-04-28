<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h4 class="fw-bold mb-3">Pembayaran Transfer Bank</h4>

    <div class="card shadow-sm text-center">
        <div class="card-body">

            <h5>Total Bayar</h5>
            <h3 class="text-primary">
                Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?>
            </h3>

            <hr>

            <!-- INFO REKENING -->
            <h6 class="fw-bold">Transfer ke rekening:</h6>
            <p class="mb-1"><b>Bank BRI</b></p>
            <p class="mb-1">No Rekening: <b>1234567890</b></p>
            <p>Atas Nama: <b>Perpustakaan PusakaGo</b></p>

            <hr>

            <p class="text-muted">
                Setelah transfer, upload bukti pembayaran
            </p>

            <!-- FORM UPLOAD -->
            <form action="<?= base_url('transaksi/proses') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_peminjaman" value="<?= $transaksi['id_peminjaman'] ?>">
                <input type="hidden" name="metode" value="transfer">

                <input type="file" name="bukti" class="form-control mb-3" required>

                <button class="btn btn-success">
                    Upload Bukti
                </button>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>