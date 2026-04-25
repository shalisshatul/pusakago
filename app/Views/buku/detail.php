<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">

<div class="card shadow-sm">
<div class="card-body">

<h4><?= esc($buku['judul']) ?></h4>
<hr>

<p>Kategori: <?= esc($buku['nama_kategori']) ?></p>
<p>Penulis: <?= esc($buku['nama_penulis']) ?></p>
<p>Penerbit: <?= esc($buku['nama_penerbit']) ?></p>
<p>Tahun: <?= esc($buku['tahun_terbit']) ?></p>
<p>ISBN: <?= esc($buku['isbn']) ?></p>

<?php if($buku['cover']): ?>
<img src="<?= base_url('uploads/buku/'.$buku['cover']) ?>" width="150">
<?php endif; ?>

<br><br>
<a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>

</div>
</div>

</div>

<?= $this->endSection() ?>