<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penulis</h3>
<form method="get" action="<?= base_url('penulis') ?>">
    <input type="text" name="keyword" placeholder="Cari penulis..."
           value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
</form>
<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <a href="<?= base_url('penulis/create') ?>">+ Tambah</a>

<?php endif; ?>
<table border="1">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <th>Aksi</th>
<?php endif; ?>
    </tr>

    <?php foreach ($penulis as $k): ?>
    <tr>
        <td><?= $k['id_penulis'] ?></td>
        <td><?= $k['nama_penulis'] ?></td>
        <td><?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
<td>
    <a href="<?= base_url('penulis/edit/'.$k['id_penulis']) ?>">Edit</a>
    <a href="<?= base_url('penulis/delete/'.$k['id_penulis']) ?>"
     onclick="return confirm('Hapus?')">Hapus</a>
</td>
<?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>