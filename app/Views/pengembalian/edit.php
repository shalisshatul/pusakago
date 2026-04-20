<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Edit Pengembalian</h2>

<form action="<?= base_url('pengembalian/update/'.$pengembalian['id_pengembalian']) ?>" method="post">

    <p>
        ID Peminjaman<br>
        <input type="number" name="id_peminjaman" value="<?= $pengembalian['id_peminjaman'] ?>">
    </p>

    <p>
        Tanggal Dikembalikan<br>
        <input type="date" name="tanggal_dikembalikan" value="<?= $pengembalian['tanggal_dikembalikan'] ?>">
    </p>

    <p>
        Denda<br>
        <input type="number" step="0.01" name="denda" value="<?= $pengembalian['denda'] ?>">
    </p>

    <button type="submit">Update</button>

</form>

<?= $this->endSection() ?>
