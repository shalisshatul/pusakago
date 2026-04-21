<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Form Pengembalian</h2>

<form action="<?= base_url('pengembalian/store') ?>" method="post">

    <input type="hidden" name="id_peminjaman" value="<?= $id_peminjaman ?>">

    <p>
        <label>Tanggal Dikembalikan</label><br>
        <input type="date" name="tanggal_dikembalikan" required>
    </p>

    <p>
        <label>Denda</label><br>
        <input type="number" name="denda" value="0">
    </p>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>