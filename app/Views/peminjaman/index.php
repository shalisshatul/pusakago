<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Peminjaman</h2>

<?php if (session()->get('role') == 'anggota' || session()->get('role') == 'petugas'): ?>
    <a href="<?= base_url('peminjaman/create') ?>">+ Tambah</a>
<?php endif; ?>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Status Pengiriman</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($peminjaman as $p): ?>
    <tr>
        <td><?= $p['id_peminjaman'] ?></td>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['judul'] ?></td>
        <td><?= $p['tanggal_pinjam'] ?></td>
        <td><?= $p['tanggal_kembali'] ?></td>

        <!-- STATUS PEMINJAMAN -->
        <td>
            <?php if ($p['status'] == 'menunggu'): ?>
                🟡 Menunggu
            <?php elseif ($p['status'] == 'dipinjam'): ?>
                🔵 Dipinjam
            <?php elseif ($p['status'] == 'dikembalikan'): ?>
                🟢 Dikembalikan
            <?php else: ?>
                -
            <?php endif; ?>
        </td>

        <!-- STATUS PENGIRIMAN (HANYA ANTAR) -->
        <td>
            <?php if ($p['metode'] == 'antar'): ?>
                <?php if ($p['status_pengiriman'] == 'menunggu'): ?>
                    🟡 Menunggu
                <?php elseif ($p['status_pengiriman'] == 'dikirim'): ?>
                    🚚 Dikirim
                <?php elseif ($p['status_pengiriman'] == 'sampai'): ?>
                    ✅ Sampai
                <?php else: ?>
                    -
                <?php endif; ?>
            <?php else: ?>
                - <!-- kalau ambil -->
            <?php endif; ?>
        </td>

        <!-- AKSI -->
        <td>

            <!-- PETUGAS: ANTAR -->
            <?php if (
                session()->get('role') == 'petugas' &&
                $p['metode'] == 'antar' &&
                isset($p['status_pengiriman']) &&
                $p['status_pengiriman'] == 'menunggu'
            ): ?>
                <a href="<?= base_url('pengiriman/antar/'.$p['id_peminjaman']) ?>">
                    <button>Antar</button>
                </a>
            <?php endif; ?>

            <!-- ANGGOTA: SAMPAI -->
            <?php if (
                session()->get('role') == 'anggota' &&
                $p['metode'] == 'antar' &&
                isset($p['status_pengiriman']) &&
                $p['status_pengiriman'] == 'dikirim'
            ): ?>
                <a href="<?= base_url('pengiriman/sampai/'.$p['id_peminjaman']) ?>">
                    <button>Sampai</button>
                </a>
            <?php endif; ?>

            <!-- DETAIL -->
            <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                Detail
            </a>

            <!-- ADMIN: HAPUS -->
            <?php if (session()->get('role') == 'admin'): ?>
                <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>" 
                   onclick="return confirm('Hapus data?')">
                   Hapus
                </a>
            <?php endif; ?>

            <!-- KEMBALIKAN -->
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
