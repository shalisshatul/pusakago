<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Rak</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari rak / lokasi">
    <button type="submit">Search</button>
</form>

<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <a href="<?= base_url('rak/create') ?>">+ Tambah</a>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Rak</th>
        <th>Lokasi</th>
        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
            <th>Aksi</th>
        <?php endif; ?>
    </tr>

    <?php foreach ($rak as $k): ?>
    <tr>
        <td><?= $k['id_rak'] ?></td>
        <td><?= $k['nama_rak'] ?></td>
        <td><?= $k['lokasi'] ?></td>

        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
        <td>
            <a href="<?= base_url('rak/edit/'.$k['id_rak']) ?>">Edit</a>
            <a href="<?= base_url('rak/delete/'.$k['id_rak']) ?>"
               onclick="return confirm('Hapus?')">Hapus</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>
