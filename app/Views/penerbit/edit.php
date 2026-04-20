<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Edit Penerbit</h3>

<form method="post" action="<?= base_url('penerbit/update/'.$penerbit['id_penerbit']) ?>">

    <label>Nama Penerbit</label><br>
    <input type="text" name="nama_penerbit" value="<?= $penerbit['nama_penerbit'] ?>" required>
    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= $penerbit['alamat'] ?></textarea>
    <br><br>

    <button type="submit">Update</button>
</form>
<?= $this->endSection() ?>