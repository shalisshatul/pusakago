
<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman</title>
</head>
<body onload="window.print()">

    <h2>Bukti Peminjaman Buku</h2>
    <hr>

    <p><strong>Nama:</strong> <?= $peminjaman['nama'] ?></p>
    <p><strong>Judul Buku:</strong> <?= $peminjaman['judul'] ?></p>
    <p><strong>Tanggal Pinjam:</strong> <?= $peminjaman['tanggal_pinjam'] ?></p>
    <p><strong>Tanggal Kembali:</strong> <?= $peminjaman['tanggal_kembali'] ?></p>
    <p><strong>Status:</strong> <?= $peminjaman['status'] ?></p>

    <?php if ($peminjaman['metode'] == 'antar'): ?>
        <p><strong>Metode:</strong> Diantar</p>
        <p><strong>Alamat:</strong> <?= $peminjaman['alamat'] ?></p>
        <p><strong>Status Pengiriman:</strong> <?= $peminjaman['status_pengiriman'] ?></p>
    <?php else: ?>
        <p><strong>Metode:</strong> Ambil ke Perpustakaan</p>
    <?php endif; ?>

    <br><br>

    <p>__________________________</p>
    <p>Tanda Tangan Petugas</p>

</body>
</html>