<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Data Penerbit</h3>

<form method="get" action="<?= base_url('penerbit') ?>">
    <input type="text" name="keyword" placeholder="Cari kategori...">
    <button type="submit">Cari</button>
</form>
<tr>
<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <a href="<?= base_url('penerbit/create') ?>">+ Tambah</a>
<?php endif; ?>
</tr>
<table border="1">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Alamat</th>
    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
        <th>Aksi</th>
<?php endif; ?>
    </tr>

    <?php foreach ($penerbit as $k): ?>
    <tr>
        <td><?= $k['id_penerbit'] ?></td>
        <td><?= $k['nama_penerbit'] ?></td>
        <td><?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
<td>
    <a href="<?= base_url('penerbit/edit/'.$k['id_penerbit']) ?>">Edit</a>
    <a href="<?= base_url('penerbit/delete/'.$k['id_penerbit']) ?>"
     onclick="return confirm('Hapus?')">Hapus</a>
</td>
<?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>