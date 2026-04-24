<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Form Pengembalian</h2>

<form action="<?= base_url('pengembalian/store') ?>" method="post">

    <!-- 🔥 ID tetap dikirim (tidak terlihat) -->
    <input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman'] ?>">

    <!-- 📅 HANYA INPUT TANGGAL -->
    <label>Tanggal Dikembalikan:</label><br>
    <input type="date" name="tanggal_dikembalikan" required><br><br>

    <button type="submit">Simpan</button>
</form>


<?= $this->endSection() ?>