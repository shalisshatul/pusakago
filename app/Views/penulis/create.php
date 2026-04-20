<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Tambah Penulis</h3>

<form method="post" action="<?= base_url('penulis/store') ?>">

    <input type="text" name="nama_penulis" placeholder="Nama penulis">

    <button type="submit">Simpan</button>
</form><?= $this->endSection() ?>