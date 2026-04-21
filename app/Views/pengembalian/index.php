<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pengembalian</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tenggat</th>
        <th>Tanggal Dikembalikan</th>
        <th>Denda</th>
        <th>Status</th>
    </tr>

    <?php if (!empty($pengembalian)): ?>
        <?php foreach ($pengembalian as $p): ?>
            <tr>
                <td><?= $p['id_pengembalian'] ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['tanggal_pinjam'] ?></td>
                <td><?= $p['tanggal_kembali'] ?></td>
                <td><?= $p['tanggal_dikembalikan'] ?></td>

                <td>
                    <?php if ($p['denda'] > 0): ?>
                        Rp <?= number_format($p['denda'], 0, ',', '.') ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <td>
                    <?php
                    if ($p['tanggal_dikembalikan'] > $p['tanggal_kembali']) {
                        echo "🔴 Terlambat";
                    } else {
                        echo "🟢 Tepat Waktu";
                    }
                    ?>
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