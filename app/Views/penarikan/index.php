<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- TITLE -->
    <div class="mb-3">
        <h4 class="fw-bold">Data Penarikan</h4>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Alamat</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Tanggal Ambil</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($penarikan)): ?>
                        <?php foreach ($penarikan as $p): ?>
                        <tr>

                            <!-- ALAMAT -->
                            <td><?= $p['alamat'] ?></td>

                            <!-- BIAYA -->
                            <td class="fw-semibold">
                                Rp <?= number_format($p['biaya'], 0, ',', '.') ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php
                                if ($p['status'] == 'selesai') {
                                    $warna = 'success';
                                } elseif ($p['status'] == 'diambil') {
                                    $warna = 'primary';
                                } elseif ($p['status'] == 'diproses') {
                                    $warna = 'warning';
                                } else {
                                    $warna = 'secondary';
                                }
                                ?>
                                <span class="badge bg-<?= $warna ?>">
                                    <?= ucfirst($p['status']) ?>
                                </span>
                            </td>

                            <!-- TANGGAL -->
                            <td><?= $p['tanggal_ambil'] ?? '-' ?></td>

                            <!-- PETUGAS -->
                            <td><?= $p['nama_petugas'] ?? '-' ?></td>

                            <!-- AKSI -->
                            <td>
                                <div class="btn-group btn-group-sm">

                                    <!-- PROSES -->
                                    <?php if (session()->get('role') == 'petugas' && $p['status'] == 'menunggu'): ?>
                                        <a href="<?= base_url('penarikan/proses/'.$p['id_penarikan']) ?>"
                                           class="btn btn-warning">
                                           Proses
                                        </a>
                                    <?php endif; ?>

                                    <!-- AMBIL -->
                                    <?php if (session()->get('role') == 'petugas' && $p['status'] == 'diproses'): ?>
                                        <a href="<?= base_url('penarikan/ambil/'.$p['id_penarikan']) ?>"
                                           class="btn btn-primary">
                                           Ambil
                                        </a>
                                    <?php endif; ?>

                                    <!-- SELESAI -->
                                    <?php if (session()->get('role') == 'petugas' && $p['status'] == 'diambil'): ?>
                                        <a href="<?= base_url('penarikan/selesai/'.$p['id_penarikan']) ?>"
                                           class="btn btn-success">
                                           Selesai
                                        </a>
                                    <?php endif; ?>

                                    <!-- HAPUS -->
                                    <?php if (session()->get('role') == 'petugas'): ?>
                                        <a href="<?= base_url('penarikan/hapus/'.$p['id_penarikan']) ?>"
                                           onclick="return confirm('Yakin hapus?')"
                                           class="btn btn-danger">
                                           <i class="bi bi-trash"></i>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada data penarikan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>