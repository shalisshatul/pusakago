<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Pengembalian</h2>

<a href="/pengembalian/create">+ Tambah</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>ID Peminjaman</th>
        <th>Tanggal Kembali</th>
        <th>Denda</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($pengembalian as $p): ?>
    <tr>
        <td><?= $p['id_pengembalian'] ?></td>
        <td><?= $p['id_peminjaman'] ?></td>
        <td><?= $p['tanggal_kembali'] ?></td>
        <td><?= $p['denda'] ?></td>
        <td><?= $p['status'] ?></td>
        <td>
            <a href="/pengembalian/edit/<?= $p['id_pengembalian'] ?>">Edit</a>
            <a href="/pengembalian/delete/<?= $p['id_pengembalian'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>