<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <h4 class="fw-bold mb-3">Data Pengembalian</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Tgl Pinjam</th>
                        <th>Tenggat</th>
                        <th>Dikembalikan</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($pengembalian)): ?>
                    <?php foreach ($pengembalian as $p): ?>
                        <tr>

                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['tanggal_pinjam'] ?? '-' ?></td>
                            <td><?= $p['tanggal_kembali'] ?? '-' ?></td>
                            <td><?= $p['tanggal_dikembalikan'] ?? '-' ?></td>

                            <!-- DENDA -->
                            <td>
                                <?php if (!empty($p['denda']) && $p['denda'] > 0): ?>
                                    <span class="text-danger fw-bold">
                                        Rp <?= number_format($p['denda'], 0, ',', '.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">0</span>
                                <?php endif; ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php if (!empty($p['tanggal_dikembalikan']) && !empty($p['tanggal_kembali'])): ?>
                                    <?php if (strtotime($p['tanggal_dikembalikan']) > strtotime($p['tanggal_kembali'])): ?>
                                        <span class="badge bg-danger">Terlambat</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Tepat Waktu</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge bg-secondary">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <div class="d-flex gap-1">

                                    <?php if (session()->get('role') == 'admin'): ?>
                                        <a href="<?= base_url('pengembalian/delete/'.$p['id_pengembalian']) ?>"
                                           onclick="return confirm('Yakin hapus?')"
                                           class="btn btn-sm btn-danger">
                                           <i class="bi bi-trash"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (session()->get('role') == 'anggota'): ?>

                                        <?php if ($p['denda'] > 0 && $p['status_denda'] != 'sudah_bayar'): ?>
                                            <a href="<?= base_url('denda/'.$p['id_pengembalian']) ?>"
                                               class="btn btn-sm btn-warning text-white">
                                                Bayar
                                            </a>
                                        <?php else: ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada data
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>