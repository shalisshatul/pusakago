<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pengembalian</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tenggat</th>
        <th>Tanggal Dikembalikan</th>
        <th>Denda</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($pengembalian)): ?>
        <?php foreach ($pengembalian as $p): ?>
            <tr>

                <td><?= $p['nama'] ?></td>
                <td><?= $p['tanggal_pinjam'] ?? '-' ?></td>
                <td><?= $p['tanggal_kembali'] ?? '-' ?></td>
                <td><?= $p['tanggal_dikembalikan'] ?? '-' ?></td>

                <!-- 💰 DENDA -->
                <td>
<?php if (!empty($p['denda']) && $p['denda'] > 0): ?>
    Rp <?= number_format($p['denda'], 0, ',', '.') ?>
<?php else: ?>
    0
<?php endif; ?>
</td>


                <!-- 📌 STATUS -->
                <td>
                    <?php if (!empty($p['tanggal_dikembalikan']) && !empty($p['tanggal_kembali'])): ?>
                        <?php if (strtotime($p['tanggal_dikembalikan']) > strtotime($p['tanggal_kembali'])): ?>
                            🔴 Terlambat
                        <?php else: ?>
                            🟢 Tepat Waktu
                        <?php endif; ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <!-- ⚙️ AKSI -->
                <td>

                    <!-- 🔴 HAPUS (ADMIN) -->
                    <?php if (session()->get('role') == 'admin'): ?>
                        <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <button style="color:red;">Hapus</button>
                        </a>
                    <?php endif; ?>

                    <!-- 💰 BAYAR DENDA (ANGGOTA & TERLAMBAT & BELUM DIBAYAR) -->
                    <?php if (
                        session()->get('role') == 'anggota' &&
                        !empty($p['denda']) &&
                        $p['denda'] > 0
                    ): ?>
                        |<?php if (
    session()->get('role') == 'anggota' &&
    !empty($p['denda']) &&
    $p['denda'] > 0 &&
    ($p['status_denda'] ?? 'belum_bayar') != 'sudah_bayar'
): ?>
    | <a href="<?= base_url('denda/' . $p['id_pengembalian']) ?>">
        <button>Bayar Denda</button>
    </a>
<?php endif; ?>

                    <?php endif; ?>

                </td>

            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" align="center">Belum ada data pengembalian</td>
        </tr>
    <?php endif; ?>

</table>

<?= $this->endSection() ?>
