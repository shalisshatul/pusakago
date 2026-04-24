<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Peminjaman</h2>

<?php if (session()->get('role') == 'anggota'): ?>
    <a href="<?= base_url('peminjaman/create') ?>">
        <button style="margin-bottom:10px;">+ Tambah Peminjaman</button>
    </a>
<?php endif; ?>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Tanggal Pinjam</th>
        <th>Tenggat Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['tanggal_pinjam'] ?? '-' ?></td>
            <td><?= $p['tanggal_kembali'] ?? '-' ?></td>

            <!-- STATUS -->
            <td>
                <?php if ($p['status'] == 'menunggu'): ?>
                    🟡 Menunggu
                <?php elseif ($p['status'] == 'dipinjam'): ?>
                    🔵 Dipinjam
                <?php elseif ($p['status'] == 'dikembalikan'): ?>
                    🟢 Dikembalikan
                <?php elseif ($p['status'] == 'ditolak'): ?>
                    🔴 Ditolak
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <!-- AKSI -->
            <td>

                <!-- DETAIL -->
                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>">
                    Detail
                </a>

                <!-- 🔥 ANTAR (PETUGAS) -->
                <?php if (
                    session()->get('role') == 'petugas' &&
                    $p['metode'] == 'antar' &&
                    ($p['status_pengiriman'] ?? '') == 'menunggu'
                ): ?>
                    | <a href="<?= base_url('pengiriman/antar/' . $p['id_peminjaman']) ?>">
                        <button>Antar</button>
                    </a>
                <?php endif; ?>

                <!-- 🔥 SAMPAI (ANGGOTA) -->
                <?php
$db = \Config\Database::connect();
$transaksi = $db->table('transaksi')
    ->where('id_peminjaman', $p['id_peminjaman'])
    ->where('jenis', 'pengiriman')
    ->get()
    ->getRowArray();
?>

<!-- 🔥 SAMPAI / BAYAR -->
<?php if (
    session()->get('role') == 'anggota' &&
    $p['metode'] == 'antar' &&
    ($p['status_pengiriman'] ?? '') == 'dikirim'
): ?>

    <?php if ($transaksi && $transaksi['status'] == 'belum_bayar'): ?>
        |<a href="<?= base_url('transaksi/' . $p['id_peminjaman']) ?>">
            <button style="background:red;color:white;">Bayar Ongkir</button>
        </a>
    <?php else: ?>
        | <a href="<?= base_url('pengiriman/sampai/' . $p['id_peminjaman']) ?>">
            <button>Sampai</button>
        </a>
    <?php endif; ?>

<?php endif; ?>


                <!-- 🔥 PENGEMBALIAN (ADMIN) -->
                <?php if (
                    session()->get('role') == 'admin' &&
                    $p['status'] == 'dipinjam'
                ): ?>
                    | <a href="<?= base_url('pengembalian/create/' . $p['id_peminjaman']) ?>">
    <button>Pengembalian</button>
</a>


                <?php endif; ?>
                <!-- 🔥 HAPUS (ADMIN SAJA) -->
<?php if (session()->get('role') == 'admin'): ?>
    | <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
        onclick="return confirm('Yakin ingin menghapus data ini?')">
        <button style="color:red;">Hapus</button>
    </a>
<?php endif; ?>


        
        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>
