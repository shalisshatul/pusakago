<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Pembayaran Ongkir</h2>

<p><b>Total Ongkir:</b> Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?></p>

<form action="<?= base_url('transaksi/proses') ?>" method="post" enctype="multipart/form-data">


    <input type="hidden" name="id_peminjaman" value="<?= $transaksi['id_peminjaman'] ?>">

    <label>Metode Pembayaran:</label><br>
    <input type="radio" name="metode" value="cash" required> Cash<br>
    <input type="radio" name="metode" value="qris"> QRIS<br><br>

    <!-- upload bukti -->
    <div id="bukti_qris" style="display:none;">
        <label>Upload Bukti (QRIS):</label><br>
        <input type="file" name="bukti">
    </div>

    <br>
    <button type="submit">Bayar</button>
</form>

<script>
document.querySelectorAll('input[name="metode"]').forEach(el => {
    el.addEventListener('change', function () {
        if (this.value === 'qris') {
            document.getElementById('bukti_qris').style.display = 'block';
        } else {
            document.getElementById('bukti_qris').style.display = 'none';
        }
    });
});
</script>

<?= $this->endSection() ?>
