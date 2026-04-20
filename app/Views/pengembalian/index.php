<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Pengembalian</h2>

<a href="<?= base_url('pengembalian/create') ?>">Tambah Data</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>ID Peminjaman</th>
        <th>Tanggal</th>
        <th>Denda</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($pengembalian as $p): ?>
    <tr>
        <td><?= $p['id_pengembalian'] ?></td>
        <td><?= $p['id_peminjaman'] ?></td>
        <td><?= $p['tanggal_dikembalikan'] ?></td>
        <td><?= $p['denda'] ?></td>
        <td>
            <a href="<?= base_url('pengembalian/edit/'.$p['id_pengembalian']) ?>">Edit</a> |
            <a href="<?= base_url('pengembalian/delete/'.$p['id_pengembalian']) ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>