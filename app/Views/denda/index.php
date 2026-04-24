<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Pembayaran Denda</h2>

<p><b>Nama:</b> <?= $denda['nama'] ?></p>
<p><b>Total Denda:</b> Rp <?= number_format($denda['denda'], 0, ',', '.') ?></p>

<form action="<?= base_url('denda/bayar') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_pengembalian" value="<?= $denda['id_pengembalian'] ?>">
    <input type="hidden" name="jumlah_denda" value="<?= $denda['denda'] ?>">

    <!-- 🔥 PILIH METODE -->
    <label>Metode Pembayaran:</label><br>
    <select name="metode" id="metode" required onchange="toggleBukti()">
        <option value="">-- Pilih --</option>
        <option value="cash">Cash</option>
        <option value="qris">QRIS</option>
    </select><br><br>

    <!-- 🔥 UPLOAD QRIS (HIDDEN DULU) -->
    <div id="bukti_qris" style="display:none;">
        <label>Upload Bukti QRIS:</label><br>
        <input type="file" name="bukti"><br><br>
    </div>

    <button type="submit">Bayar</button>
</form>

<!-- 🔥 SCRIPT -->
<script>
function toggleBukti() {
    var metode = document.getElementById("metode").value;
    var bukti = document.getElementById("bukti_qris");

    if (metode === "qris") {
        bukti.style.display = "block";
    } else {
        bukti.style.display = "none";
    }
}
</script>

<?= $this->endSection() ?>
