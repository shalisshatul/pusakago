<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .card-custom {
        border-radius: 16px;
    }

    .table thead th {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .badge {
        font-size: 12px;
    }

    .btn-sm {
        border-radius: 8px;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
        transition: 0.2s;
    }
</style>

<div class="container-fluid mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">📚 Data Peminjaman</h4>
            <small class="text-muted">Kelola semua peminjaman buku</small>
        </div>

        <?php if (session()->get('role') == 'anggota'): ?>
            <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- CARD -->
    <div class="card card-custom shadow-sm border-0">

        <!-- HEADER CARD -->
        <div class="card-header bg-white border-0 py-3">
            <h6 class="mb-0 fw-semibold">List Peminjaman</h6>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nama</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tenggat</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th class="text-center" width="260">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($peminjaman)): ?>

                            <?php foreach ($peminjaman as $p): ?>
                                <tr>

                                    <!-- NAMA -->
                                    <td class="ps-4">
                                        <div class="fw-semibold"><?= $p['nama'] ?></div>
                                    </td>

                                    <!-- TANGGAL -->
                                    <td><?= $p['tanggal_pinjam'] ?? '-' ?></td>
                                    <td><?= $p['tanggal_kembali'] ?? '-' ?></td>

                                    <!-- STATUS -->
                                    <td>
                                        <?php
                                        $status = $p['status'];

                                        if ($status == 'menunggu') {
                                            $warna = 'warning';
                                        } elseif ($status == 'dipinjam') {
                                            $warna = 'primary';
                                        } elseif ($status == 'dikembalikan') {
                                            $warna = 'success';
                                        } elseif ($status == 'ditolak') {
                                            $warna = 'danger';
                                        } else {
                                            $warna = 'secondary';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $warna ?> px-3 py-2">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>

                                    <!-- PETUGAS -->
                                    <td class="text-muted">
                                        <?= $p['nama_petugas'] ?? $p['nama_petugas_kirim'] ?? '-' ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap gap-1 justify-content-center">

                                            <!-- DETAIL -->
                                            <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>"
                                                class="btn btn-sm btn-info text-white">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- SETUJUI -->
                                            <?php if (
                                                session()->get('role') == 'petugas' &&
                                                $p['status'] == 'menunggu' &&
                                                $p['metode'] == 'ambil'
                                            ): ?>
                                                <a href="<?= base_url('peminjaman/setujui/' . $p['id_peminjaman']) ?>"
                                                    class="btn btn-sm btn-success">
                                                    Setujui
                                                </a>
                                            <?php endif; ?>

                                            <!-- ANTAR -->
                                            <?php if (
                                                session()->get('role') == 'petugas' &&
                                                $p['metode'] == 'antar' &&
                                                ($p['status_pengiriman'] == 'menunggu' || $p['status_pengiriman'] == '-')
                                            ): ?>
                                                <a href="<?= base_url('pengiriman/antar/' . $p['id_peminjaman']) ?>"
                                                    class="btn btn-sm btn-warning">
                                                    Antar
                                                </a>
                                            <?php endif; ?>

                                            <!-- CEK TRANSAKSI -->
                                            <?php
                                            $db = \Config\Database::connect();
                                            $transaksi = $db->table('transaksi')
                                                ->where('id_peminjaman', $p['id_peminjaman'])
                                                ->where('jenis', 'pengiriman')
                                                ->get()
                                                ->getRowArray();
                                            ?>

                                            <!-- BAYAR / SAMPAI -->
                                            <?php if (
                                                session()->get('role') == 'anggota' &&
                                                $p['metode'] == 'antar' &&
                                                ($p['status_pengiriman'] ?? '') == 'dikirim'
                                            ): ?>

                                                <?php if ($transaksi && $transaksi['status'] == 'belum_bayar'): ?>
                                                    <a href="<?= base_url('transaksi/' . $p['id_peminjaman']) ?>"
                                                        class="btn btn-sm btn-danger">
                                                        Bayar
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= base_url('pengiriman/sampai/' . $p['id_peminjaman']) ?>"
                                                        class="btn btn-sm btn-primary">
                                                        Sampai
                                                    </a>
                                                <?php endif; ?>

                                            <?php endif; ?>

                                            <!-- PENGEMBALIAN -->
                                            <?php if (
                                                session()->get('role') == 'admin' &&
                                                $p['status'] == 'dipinjam'
                                            ): ?>
                                                <a href="<?= base_url('pengembalian/create/' . $p['id_peminjaman']) ?>"
                                                    class="btn btn-sm btn-secondary">
                                                    Kembali
                                                </a>
                                            <?php endif; ?>

                                            <!-- HAPUS -->
                                            <?php if (session()->get('role') == 'admin'): ?>
                                                <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            <?php endif; ?>

                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2"></i><br>
                                    Belum ada data peminjaman
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>