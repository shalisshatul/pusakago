<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Buku</h2>

<form method="get" action="<?= base_url('buku') ?>">
    <input type="text" name="keyword" placeholder="Cari buku..." value="<?= request()->getGet('keyword') ?>">
    <button type="submit">Cari</button>
</form>

<!-- 🔒 HANYA ADMIN & PETUGAS -->
<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <a href="<?= base_url('buku/create') ?>">+ Tambah Buku</a>
<?php endif; ?>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Penerbit</th>
        <th>Penulis</th>
        <th>Rak</th>
        <th>Cover</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($buku as $b): ?>
    <tr>
        <td><?= $b['id_buku'] ?></td>
        <td><?= $b['judul'] ?></td>
        <td><?= $b['nama_kategori'] ?></td>
        <td><?= $b['nama_penerbit'] ?></td>
        <td><?= $b['nama_penulis'] ?></td>
        <td><?= $b['nama_rak'] ?? '-' ?></td>
       

        <td>
            <?php if (!empty($b['cover'])) : ?>
                <img src="<?= base_url('uploads/' . $b['cover']) ?>" width="60">
            <?php else : ?>
                Tidak ada
            <?php endif; ?>
        </td>

        <td>
            <!-- 👤 ANGGOTA -->
            <?php if (session()->get('role') == 'anggota') : ?>
                <a href="<?= base_url('peminjaman/pinjam/' . $b['id_buku']) ?>">Borrow</a> |
                <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>">Detail</a>
            <?php endif; ?>

            <!-- 👨‍💼 ADMIN & PETUGAS -->
            <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>">Detail</a> |
                <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>">Edit</a> |
                <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>" onclick="return confirm('Hapus?')">Hapus</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>