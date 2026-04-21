<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Peminjaman</h2>

<?php if (!empty($peminjaman)): ?>

    <p><b>Nama:</b> <?= $peminjaman['nama'] ?></p>
    <p><b>Judul Buku:</b> <?= $peminjaman['judul'] ?></p>
    <p><b>Tanggal Pinjam:</b> <?= $peminjaman['tanggal_pinjam'] ?></p>
    <p><b>Tanggal Kembali:</b> <?= $peminjaman['tanggal_kembali'] ?></p>
    <p><b>Status:</b> <?= $peminjaman['status'] ?></p>

<?php else: ?>

    <p>Data tidak ditemukan</p>

<?php endif; ?>

<br>

<a href="<?= base_url('peminjaman') ?>">Kembali</a>

<a href="<?= base_url('peminjaman/print/'.$peminjaman['id_peminjaman'] ?? 0) ?>" target="_blank">
    Print
</a>

<?= $this->endSection() ?>
