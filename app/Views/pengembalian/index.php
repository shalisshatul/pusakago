<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Pengembalian</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Dikembalikan</th>
        <th>Denda</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($pengembalian as $p): ?>
    <tr>
        <td><?= $p['id_pengembalian'] ?></td>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['judul'] ?></td>
        <td><?= $p['tanggal_pinjam'] ?></td>
        <td><?= $p['tanggal_dikembalikan'] ?></td>

        <td>
            <?php if ($p['denda'] > 0): ?>
                💰 Rp <?= number_format($p['denda']) ?>
            <?php else: ?>
                -
            <?php endif; ?>
        </td>

        <!-- AKSI -->
        <td>
            <?php if (session()->get('role') == 'admin'): ?>
                <a href="<?= base_url('pengembalian/delete/'.$p['id_pengembalian']) ?>"
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                    <button>Hapus</button>
                </a>
            <?php else: ?>
                -
            <?php endif; ?>
        </td>

    </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>
