<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold mb-0">Tambah Buku</h4>
        <small class="text-muted">Masukkan data buku baru ke sistem</small>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form method="post" action="<?= base_url('buku/store') ?>" enctype="multipart/form-data">

                <div class="row">

                    <!-- JUDUL -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <!-- ISBN -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control">
                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>">
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PENULIS -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select">
                            <?php foreach($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>">
                                    <?= esc($p['nama_penulis']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PENERBIT -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select">
                            <?php foreach($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>">
                                    <?= esc($p['nama_penerbit']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- RAK -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <?php foreach($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>">
                                    <?= esc($r['nama_rak']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- JUMLAH -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control">
                    </div>

                    <!-- TERSEDIA -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tersedia</label>
                        <input type="number" name="tersedia" class="form-control">
                    </div>

                    <!-- COVER -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cover</label>
                        <input type="file" name="cover" class="form-control">
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-3">
                    <button class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                    <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>