<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <!-- wrapper biar tidak full lebar -->
    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h4 class="mb-4">Tambah Buku</h4>

                    <form method="post" action="<?= base_url('buku/store') ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <input list="kategoriList" name="nama_kategori" class="form-control">

                            <datalist id="kategoriList">
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= esc($k['nama_kategori']) ?>">
                                    <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label>Penulis</label>
                            <input list="penulisList" name="nama_penulis" class="form-control">

                            <datalist id="penulisList">
                                <?php foreach ($penulis as $p): ?>
                                    <option value="<?= esc($p['nama_penulis']) ?>">
                                    <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label>Penerbit</label>
                            <input list="penerbitList" name="nama_penerbit" class="form-control">

                            <datalist id="penerbitList">
                                <?php foreach ($penerbit as $p): ?>
                                    <option value="<?= esc($p['nama_penerbit']) ?>">
                                    <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
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

                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Tersedia</label>
                            <input type="number" name="tersedia" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Cover</label>
                            <input type="file" name="cover" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                        </div>

                        <button class="btn btn-primary w-100 shadow-sm">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>