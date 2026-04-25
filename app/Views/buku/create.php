<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">
    <h4>Tambah Buku</h4>

    <form method="post" action="<?= base_url('buku/store') ?>" enctype="multipart/form-data">
        <div class="row">

            <!-- Judul -->
            <div class="col-md-6">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <!-- ISBN -->
            <div class="col-md-6">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control">
            </div>

            <!-- KATEGORI (select + ketik) -->
            <div class="col-md-6 mt-2">
                <label>Kategori</label>
                <input list="kategoriList" name="nama_kategori" class="form-control" placeholder="Pilih atau ketik baru">

                <datalist id="kategoriList">
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= esc($k['nama_kategori']) ?>">
                    <?php endforeach; ?>
                </datalist>
            </div>

            <!-- PENULIS -->
            <div class="col-md-6 mt-2">
                <label>Penulis</label>
                <input list="penulisList" name="nama_penulis" class="form-control" placeholder="Pilih atau ketik baru">

                <datalist id="penulisList">
                    <?php foreach ($penulis as $p): ?>
                        <option value="<?= esc($p['nama_penulis']) ?>">
                    <?php endforeach; ?>
                </datalist>
            </div>

            <!-- PENERBIT -->
            <div class="col-md-6 mt-2">
                <label>Penerbit</label>
                <input list="penerbitList" name="nama_penerbit" class="form-control" placeholder="Pilih atau ketik baru">

                <datalist id="penerbitList">
                    <?php foreach ($penerbit as $p): ?>
                        <option value="<?= esc($p['nama_penerbit']) ?>">
                    <?php endforeach; ?>
                </datalist>
            </div>

            <!-- RAK (tetap select kalau tidak mau manual) -->
            <div class="col-md-6 mt-2">
                <label>Rak</label>
                <select name="id_rak" class="form-control">
                    <option value="">-- Pilih --</option>
                    <?php foreach ($rak as $r): ?>
                        <option value="<?= $r['id_rak'] ?>">
                            <?= esc($r['nama_rak']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- JUMLAH -->
            <div class="col-md-4 mt-2">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control">
            </div>

            <!-- TERSEDIA -->
            <div class="col-md-4 mt-2">
                <label>Tersedia</label>
                <input type="number" name="tersedia" class="form-control">
            </div>

            <!-- COVER -->
            <div class="col-md-4 mt-2">
                <label>Cover</label>
                <input type="file" name="cover" class="form-control">
            </div>

            <!-- DESKRIPSI BARU -->
            <div class="col-md-12 mt-2">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tulis deskripsi buku..."></textarea>
            </div>

        </div>

        <br>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
