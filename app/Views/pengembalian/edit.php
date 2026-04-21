<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Edit Pengembalian</h2>

<form action="/pengembalian/update/<?= $pengembalian['id_pengembalian'] ?>" method="post">
    ID Peminjaman <br>
    <input type="text" name="id_peminjaman" value="<?= $pengembalian['id_peminjaman'] ?>"><br>

    Tanggal Kembali <br>
    <input type="date" name="tanggal_kembali" value="<?= $pengembalian['tanggal_kembali'] ?>"><br>

    Denda <br>
    <input type="number" name="denda" value="<?= $pengembalian['denda'] ?>"><br>

    Status <br>
    <select name="status">
        <option value="Menunggu">Menunggu</option>
        <option value="Dikembalikan">Dikembalikan</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>
<?= $this->endSection() ?>