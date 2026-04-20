<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Tambah Rak</h3>

<form method="post" action="<?= base_url('rak/store') ?>">

    <input type="text" name="nama_rak" placeholder="Nama rak"><br><br>
    <input type="text" name="lokasi" placeholder="Lokasi"><br><br>

    <button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>