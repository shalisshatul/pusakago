<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h4 class="mb-4">Edit Buku</h4>

                    <!-- ERROR -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul"
                                value="<?= esc($buku['judul']) ?>"
                                class="form-control" required>
                        </div>

                        <!-- ISBN -->
                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" name="isbn"
                                value="<?= esc($buku['isbn']) ?>"
                                class="form-control">
                        </div>

                        <!-- KATEGORI -->
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id_kategori'] ?>"
                                        <?= ($k['id_kategori'] == ($buku['id_kategori'] ?? '')) ? 'selected' : '' ?>>
                                        <?= esc($k['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <input type="text" name="kategori_baru"
                                class="form-control mt-2"
                                placeholder="Tambah kategori baru">
                        </div>

                        <!-- PENULIS -->
                        <div class="mb-3">
                            <label>Penulis</label>
                            <select name="id_penulis" class="form-control">
                                <option value="">-- Pilih Penulis --</option>
                                <?php foreach ($penulis as $p): ?>
                                    <option value="<?= $p['id_penulis'] ?>"
                                        <?= ($p['id_penulis'] == ($buku['id_penulis'] ?? '')) ? 'selected' : '' ?>>
                                        <?= esc($p['nama_penulis']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <input type="text" name="penulis_baru"
                                class="form-control mt-2"
                                placeholder="Tambah penulis baru">
                        </div>

                        <!-- PENERBIT -->
                        <div class="mb-3">
                            <label>Penerbit</label>
                            <select name="id_penerbit" class="form-control">
                                <option value="">-- Pilih Penerbit --</option>
                                <?php foreach ($penerbit as $p): ?>
                                    <option value="<?= $p['id_penerbit'] ?>"
                                        <?= ($p['id_penerbit'] == ($buku['id_penerbit'] ?? '')) ? 'selected' : '' ?>>
                                        <?= esc($p['nama_penerbit']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <input type="text" name="penerbit_baru"
                                class="form-control mt-2"
                                placeholder="Tambah penerbit baru">
                        </div>

                        <!-- RAK -->
                        <div class="mb-3">
                            <label>Rak</label>
                            <select name="id_rak" class="form-control" required>
                                <option value="">-- Pilih Rak --</option>

                                <?php foreach ($rak as $r): ?>
                                    <option value="<?= $r['id_rak'] ?>"
                                        <?= ($r['id_rak'] == ($buku['id_rak'] ?? '')) ? 'selected' : '' ?>>
                                        <?= esc($r['nama_rak']) ?> - <?= esc($r['lokasi']) ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <!-- TAHUN -->
                        <div class="mb-3">
                            <label>Tahun Terbit</label>
                            <input type="number" name="tahun_terbit"
                                value="<?= esc($buku['tahun_terbit'] ?? '') ?>"
                                class="form-control">
                        </div>

                        <!-- JUMLAH -->
                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah"
                                value="<?= esc($buku['jumlah'] ?? '') ?>"
                                class="form-control">
                        </div>

                        <!-- TERSEDIA -->
                        <div class="mb-3">
                            <label>Tersedia</label>
                            <input type="number" name="tersedia"
                                value="<?= esc($buku['tersedia'] ?? '') ?>"
                                class="form-control">
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"><?= esc($buku['deskripsi'] ?? '') ?></textarea>
                        </div>

                        <!-- COVER -->
                        <div class="mb-3">
                            <input type="hidden" name="old_cover" value="<?= $buku['cover'] ?? '' ?>">

                            <label>Cover Lama</label><br>
                            <?php if (!empty($buku['cover'])): ?>
                                <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" width="100" class="mb-2 rounded">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada</span>
                            <?php endif; ?>

                            <br><br>

                            <label>Ganti Cover</label>
                            <input type="file" name="cover" class="form-control">
                        </div>

                        <!-- BUTTON -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                Update
                            </button>

                            <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>