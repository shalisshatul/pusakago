<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Tambah Penerbit</h3>

<form method="post" action="<?= base_url('penerbit/store') ?>">

    <label>Nama Penerbit</label><br>
    <input type="text" name="nama_penerbit" required><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>