<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Peminjaman</h2>

<p><b>ID:</b> <?= $peminjaman['id_peminjaman'] ?></p>
<p><b>Tanggal Pinjam:</b> <?= $peminjaman['tanggal_pinjam'] ?></p>
<p><b>Tanggal Kembali:</b> <?= $peminjaman['tanggal_kembali'] ?></p>
<p><b>Status:</b> <?= $peminjaman['status'] ?></p>
<p><b>ID User:</b> <?= $peminjaman['id'] ?></p>

<a href="<?= base_url('peminjaman') ?>">Kembali</a>

<?= $this->endSection() ?>
