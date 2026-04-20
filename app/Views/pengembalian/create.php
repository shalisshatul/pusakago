<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Pengembalian</h2>

<form action="<?= base_url('pengembalian/store') ?>" method="post">

    <p>
        ID Peminjaman<br>
        <input type="number" name="id_peminjaman">
    </p>

    <p>
        Tanggal Dikembalikan<br>
        <input type="date" name="tanggal_dikembalikan">
    </p>

    <p>
        Denda<br>
        <input type="number" step="0.01" name="denda">
    </p>

    <button type="submit">Simpan</button>

</form>

<?= $this->endSection() ?>