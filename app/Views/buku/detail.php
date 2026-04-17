<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Buku</h2>

<p><b>Judul:</b> <?= $buku['judul'] ?></p>
<p><b>ISBN:</b> <?= $buku['isbn'] ?></p>
<p><b>Kategori:</b> <?= $buku['nama_kategori'] ?></p>
<p><b>Penulis:</b> <?= $buku['nama_penulis'] ?></p>
<p><b>Penerbit:</b> <?= $buku['nama_penerbit'] ?></p>
<p><b>Rak:</b> <?= $buku['nama_rak'] ?? '-' ?></p>
<p><b>Tahun:</b> <?= $buku['tahun_terbit'] ?></p>
<p><b>Deskripsi:</b> <?= $buku['deskripsi'] ?></p>

<?php if (!empty($buku['cover'])) : ?>
    <img src="<?= base_url('uploads/' . $buku['cover']) ?>" width="120">
<?php endif; ?>

<br><br>
<a href="<?= base_url('buku') ?>">Kembali</a>

<?= $this->endSection() ?>