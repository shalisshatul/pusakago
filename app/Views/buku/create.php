<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Tambah Buku</h2>

<form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">

    Judul:<br>
    <input type="text" name="judul" required><br><br>

    ISBN:<br>
    <input type="text" name="isbn"><br><br>

    Kategori:<br>
    <select name="id_kategori">
        <option value="">-- Pilih Kategori --</option>
        <?php foreach ($kategori as $k): ?>
            <option value="<?= $k['id_kategori'] ?>">
                <?= $k['nama_kategori'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="kategori_baru" placeholder="Atau tambah kategori baru"><br><br>

    Penulis:<br>
    <select name="id_penulis">
        <option value="">-- Pilih Penulis --</option>
        <?php foreach ($penulis as $p): ?>
            <option value="<?= $p['id_penulis'] ?>">
                <?= $p['nama_penulis'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="penulis_baru" placeholder="Atau tambah penulis baru"><br><br>

    Penerbit:<br>
    <select name="id_penerbit">
        <option value="">-- Pilih Penerbit --</option>
        <?php foreach ($penerbit as $p): ?>
            <option value="<?= $p['id_penerbit'] ?>">
                <?= $p['nama_penerbit'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="penerbit_baru" placeholder="Atau tambah penerbit baru"><br><br>

    Tahun Terbit:<br>
    <input type="number" name="tahun_terbit"><br><br>
   
    Rak:<br>
<select name="id_rak">
    <option value="">Pilih Rak</option>
    <?php foreach ($rak as $r): ?>
        <option value="<?= $r['id_rak'] ?>">
            <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
        </option>
    <?php endforeach; ?>
</select><br>

<input type="text" name="rak_baru" placeholder="Atau tambah rak baru"><br><br>

<input type="text" name="rak_baru" placeholder="Atau tambah rak baru (isi jika tidak ada)"><br><br>
    Deskripsi:<br>
    <textarea name="deskripsi"></textarea><br><br>

    Cover:<br>
    <input type="file" name="cover"><br><br>

    <button type="submit">Simpan</button>

</form>

<?= $this->endSection() ?>