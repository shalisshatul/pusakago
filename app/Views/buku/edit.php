<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Buku</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div style="color:red;">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">

    <!-- JUDUL -->
    Judul:<br>
    <input type="text" name="judul" value="<?= $buku['judul'] ?>" required><br><br>

    <!-- ISBN (FIX: tampilkan value lama) -->
    ISBN:<br>
    <input type="text" name="isbn" value="<?= $buku['isbn'] ?>"><br><br>

    <!-- KATEGORI -->
    Kategori:<br>
    <select name="id_kategori">
        <option value="">-- Pilih Kategori --</option>
        <?php foreach ($kategori as $k): ?>
            <option value="<?= $k['id_kategori'] ?>"
                <?= ($k['id_kategori'] == $buku['id_kategori']) ? 'selected' : '' ?>>
                <?= $k['nama_kategori'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="kategori_baru" placeholder="Atau tambah kategori baru"><br><br>

    <!-- PENULIS -->
    Penulis:<br>
    <select name="id_penulis">
        <option value="">-- Pilih Penulis --</option>
        <?php foreach ($penulis as $p): ?>
            <option value="<?= $p['id_penulis'] ?>"
                <?= ($p['id_penulis'] == $buku['id_penulis']) ? 'selected' : '' ?>>
                <?= $p['nama_penulis'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="penulis_baru" placeholder="Atau tambah penulis baru"><br><br>

    <!-- PENERBIT -->
    Penerbit:<br>
    <select name="id_penerbit">
        <option value="">-- Pilih Penerbit --</option>
        <?php foreach ($penerbit as $p): ?>
            <option value="<?= $p['id_penerbit'] ?>"
                <?= ($p['id_penerbit'] == $buku['id_penerbit']) ? 'selected' : '' ?>>
                <?= $p['nama_penerbit'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="penerbit_baru" placeholder="Atau tambah penerbit baru"><br><br>

    <!-- RAK -->
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

    <!-- TAHUN -->
    Tahun Terbit:<br>
    <input type="number" name="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>"><br><br>

    <!-- DESKRIPSI (FIX: tampilkan value lama) -->
    Deskripsi:<br>
    <textarea name="deskripsi"><?= $buku['deskripsi'] ?></textarea><br><br>

    <!-- JUMLAH -->
    Jumlah:<br>
    <input type="number" name="jumlah" value="<?= $buku['jumlah'] ?>"><br><br>

    <!-- TERSEDIA -->
    Tersedia:<br>
    <input type="number" name="tersedia" value="<?= $buku['tersedia'] ?>"><br><br>

    <!-- COVER -->
    <input type="hidden" name="old_cover" value="<?= $buku['cover'] ?>">

    Cover Lama:<br>
    <?php if (!empty($buku['cover'])) : ?>
        <img src="<?= base_url('uploads/' . $buku['cover']) ?>" width="80"><br>
    <?php else : ?>
        Tidak ada<br>
    <?php endif; ?>

    Ganti Cover:<br>
    <input type="file" name="cover"><br><br>

    <button type="submit">Update</button>

</form>

<?= $this->endSection() ?>