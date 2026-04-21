<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Pengembalian</h2>

<form action="/pengembalian/store" method="post">
    ID Peminjaman <br>
    <input type="text" name="id_peminjaman"><br>

    Tanggal Kembali <br>
    <input type="date" name="tanggal_kembali"><br>

    Denda <br>
    <input type="number" name="denda"><br><br>

    <button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>