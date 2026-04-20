<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $role = session()->get('role'); ?>

<h2>Peminjaman</h2>

<!-- ================= KERANJANG ================= -->
<h3>Keranjang</h3>

<table border="1">
<tr>
    <th>Judul Buku</th>
    <th>Jumlah</th>
</tr>

<?php if (!empty($keranjang)) : ?>
    <?php foreach ($keranjang as $k): ?>
    <tr>
        <td><?= $k['judul'] ?? '-' ?></td>
        <td><?= $k['jumlah'] ?? 0 ?></td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="2">Keranjang kosong</td>
    </tr>
<?php endif; ?>
</table>

<br>
<a href="<?= base_url('peminjaman/ajukan') ?>">Ajukan Peminjaman</a>

<hr>

<!-- ================= PEMINJAMAN ================= -->

<?php if ($role == 'admin' || $role == 'petugas'): ?>

    <!-- ADMIN -->
    <form method="get">
        <input type="text" name="keyword" placeholder="Cari user...">
        <button type="submit">Cari</button>
    </form>

    <table border="1">
<tr>
    <th>User</th>
    <th>Status</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Aksi</th>
</tr>

<?php foreach ($peminjaman as $p): ?>
<tr>
    <td><?= $p['username']; ?></td>
    <td><?= $p['status']; ?></td>
    <td><?= $p['tanggal_pinjam']; ?></td>
    <td><?= $p['tanggal_kembali']; ?></td>
    <td>

<?php if ($p['status'] == 'keranjang'): ?>

    <!-- SETUJUI -->
    <a href="<?= base_url('peminjaman/setujui/'.$p['id_peminjaman']) ?>">
        Setujui
    </a> |

    <!-- TOLAK -->
    <a href="<?= base_url('peminjaman/tolak/'.$p['id_peminjaman']) ?>"
       onclick="return confirm('Tolak peminjaman?')">
        Tolak
    </a> |

<?php endif; ?>

<!-- HAPUS (SEMUA STATUS) -->
<a href="<?= base_url('peminjaman/hapus/'.$p['id_peminjaman']) ?>"
   onclick="return confirm('Hapus data?')">
    Hapus
</a>

</td>
 <td>
        <?php if ($p['status'] == 'dipinjam'): ?>
            <a href="<?= base_url('peminjaman/selesai/'.$p['id_peminjaman']) ?>">
                Selesai
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php else: ?>

    <!-- ANGGOTA -->
    <table border="1">
    <tr>
        <th>Status</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
    </tr>

    <?php if (!empty($peminjaman)) : ?>
        <?php foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $p['status'] ?? '-' ?></td>
            <td><?= $p['tanggal_pinjam'] ?? '-' ?></td>
            <td><?= $p['tanggal_kembali'] ?? '-' ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Belum ada peminjaman</td>
        </tr>
    <?php endif; ?>
    </table>

<?php endif; ?>

<?= $this->endSection() ?>