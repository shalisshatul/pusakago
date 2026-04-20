<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Peminjaman</h2>

<p><b>Nama:</b> <?= $peminjaman['nama'] ?></p>
<p><b>Judul Buku:</b> <?= $peminjaman['judul'] ?></p>
<p><b>Tanggal Pinjam:</b> <?= $peminjaman['tanggal_pinjam'] ?></p>
<p><b>Tanggal Kembali:</b> <?= $peminjaman['tanggal_kembali'] ?></p>
<p><b>Status:</b> <?= $peminjaman['status'] ?></p>


<a href="<?= base_url('peminjaman') ?>">Kembali</a>
<a href="<?= base_url('peminjaman/print?' . http_build_query($_GET)) ?>" target="_blank">
Print </a>
<?= $this->endSection() ?>
