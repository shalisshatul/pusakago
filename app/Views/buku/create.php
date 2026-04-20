<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Tambah Buku</h2>

<form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">

    <fieldset>
        <legend>Data Buku</legend>

        <p>
            <label>Judul Buku</label><br>
            <input type="text" name="judul" required>
        </p>

        <p>
            <label>ISBN</label><br>
            <input type="text" name="isbn">
        </p>

        <p>
            <label>Kategori</label><br>
            <select name="id_kategori">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>">
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <input type="text" name="kategori_baru" placeholder="Tambah kategori baru">
        </p>

        <p>
            <label>Penulis</label><br>
            <select name="id_penulis">
                <option value="">-- Pilih Penulis --</option>
                <?php foreach ($penulis as $p): ?>
                    <option value="<?= $p['id_penulis'] ?>">
                        <?= $p['nama_penulis'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <input type="text" name="penulis_baru" placeholder="Tambah penulis baru">
        </p>

        <p>
            <label>Penerbit</label><br>
            <select name="id_penerbit">
                <option value="">-- Pilih Penerbit --</option>
                <?php foreach ($penerbit as $p): ?>
                    <option value="<?= $p['id_penerbit'] ?>">
                        <?= $p['nama_penerbit'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <input type="text" name="penerbit_baru" placeholder="Tambah penerbit baru">
        </p>
        <p>
            <label>Rak</label><br>
            <select name="id_rak">
                <option value="">-- Pilih Rak --</option>
                <?php foreach ($rak as $r): ?>
                    <option value="<?= $r['id_rak'] ?>">
                        <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label>Tahun Terbit</label><br>
            <input type="number" name="tahun_terbit">
        </p>
       
        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="3"></textarea>
        </p>

      

        <p>
            <label>Jumlah</label><br>
            <input type="number" name="jumlah">
        </p>

        <p>
            <label>Tersedia</label><br>
            <input type="number" name="tersedia">
        </p>

        <p>
            <label>Cover Buku</label><br>
            <input type="file" name="cover">
        </p>

    </fieldset>

    <p>
        <button type="submit">Simpan</button>
        <a href="<?= base_url('buku') ?>">Kembali</a>
    </p>

</form>

<?= $this->endSection() ?>
