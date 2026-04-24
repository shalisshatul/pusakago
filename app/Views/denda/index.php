<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Pembayaran Denda</h2>

<p><b>Nama:</b> <?= $denda['nama'] ?></p>
<p><b>Total Denda:</b> Rp <?= number_format($denda['denda'], 0, ',', '.') ?></p>

<form action="<?= base_url('denda/bayar') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_pengembalian" value="<?= $denda['id_pengembalian'] ?>">
    <input type="hidden" name="jumlah_denda" value="<?= $denda['denda'] ?>">

    <label>Upload Bukti Pembayaran:</label><br>
    <input type="file" name="bukti" required><br><br>

    <button type="submit">Bayar</button>
</form>

<?= $this->endSection() ?>
