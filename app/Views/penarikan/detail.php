<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h4 class="mb-4 fw-bold">Detail Penarikan</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <?php if (!empty($penarikan)): ?>

                <table class="table table-bordered">

                    <tr>
                        <th width="200">Nama Anggota</th>
                        <td><?= esc($penarikan['nama_anggota'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Alamat</th>
                        <td><?= esc($penarikan['alamat'] ?? '-') ?></td>
                    </tr>

                    <tr>

                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            $status = $penarikan['status'] ?? 'unknown';

                            if ($status == 'selesai') {
                                $warna = 'success';
                            } elseif ($status == 'diambil') {
                                $warna = 'primary';
                            } elseif ($status == 'diproses') {
                                $warna = 'warning';
                            } else {
                                $warna = 'secondary';
                            }
                            ?>
                            <span class="badge bg-<?= $warna ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Tanggal Ambil</th>
                        <td><?= esc($penarikan['tanggal_ambil'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Petugas</th>
                        <td><?= esc($penarikan['nama_petugas'] ?? '-') ?></td>
                    </tr>



                </table>

            <?php else: ?>
                <div class="alert alert-warning text-center">
                    Data tidak ditemukan
                </div>
            <?php endif; ?>

            <a href="<?= base_url('penarikan') ?>" class="btn btn-secondary mt-3">
                ← Kembali
            </a>

        </div>
    </div>

</div>

<?= $this->endSection() ?>