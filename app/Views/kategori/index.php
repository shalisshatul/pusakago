<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Kategori</h3>
<form method="get" action="<?= base_url('kategori') ?>">
    <input type="text" name="keyword" placeholder="Cari kategori...">
    <button type="submit">Cari</button>
</form>

<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <a href="<?= base_url('kategori/create') ?>">+ Tambah</a>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Kategori</th>
        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <th>Aksi</th>
<?php endif; ?>
    </tr>

    <?php foreach ($kategori as $k): ?>
    <tr>
        <td><?= $k['id_kategori'] ?></td>
        <td><?= $k['nama_kategori'] ?></td>
        <td><?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
<td>
    <a href="<?= base_url('kategori/edit/'.$k['id_kategori']) ?>">Edit</a>
    <a href="<?= base_url('kategori/delete/'.$k['id_kategori']) ?>"
     onclick="return confirm('Hapus?')">Hapus</a>
</td>
<?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>