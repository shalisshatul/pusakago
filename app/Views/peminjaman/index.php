<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Peminjaman</h2>

<?php if (session()->get('role') == 'anggota' || session()->get('role') == 'petugas'): ?>
    <a href="<?= base_url('peminjaman/create') ?>">+ Tambah</a>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>nama</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($peminjaman as $p): ?>
    <tr>
        <td><?= $p['id_peminjaman'] ?></td>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['tanggal_pinjam'] ?></td>
        <td><?= $p['tanggal_kembali'] ?></td>
        <td><?= $p['status'] ?></td>
        <td>
 
        <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">Detail</a>
        <?php if (session()->get('role') == 'admin'): ?>
    <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>" 
       onclick="return confirm('Hapus data?')">
       Hapus
    </a>
<?php endif; ?>

    <?php if ($p['status'] == 'dipinjam'): ?>
        <a href="<?= base_url('peminjaman/kembalikan/'.$p['id_peminjaman']) ?>"
           onclick="return confirm('Kembalikan buku ini?')">
           Kembalikan
        </a>
    <?php endif; ?>
</td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>