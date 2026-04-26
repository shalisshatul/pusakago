<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .detail-wrapper {
        max-width: 650px;
        margin: 30px auto;
    }

    .detail-card {
        border-radius: 16px;
        border: none;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .detail-card .card-body {
        padding: 30px;
        background: #fff;
    }

    .detail-title {
        font-size: 20px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 25px;
        color: #2c3e50;
    }

    .table-detail {
        width: 100%;
        margin-bottom: 20px;
    }

    .table-detail tr {
        border-bottom: 1px solid #f1f1f1;
    }

    .table-detail th {
        width: 40%;
        padding: 12px 10px;
        font-weight: 600;
        color: #6c757d;
        text-align: left;
    }

    .table-detail td {
        padding: 12px 10px;
        color: #212529;
        font-weight: 500;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-area {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 20px;
    }

    .btn-area .btn {
        border-radius: 10px;
        padding: 8px 18px;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-area .btn:hover {
        transform: translateY(-2px);
    }

    .card:hover {
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }
</style>

<div class="detail-wrapper">

    <div class="card shadow-sm border-0 detail-card">
        <div class="card-body">

            <h5 class="detail-title">📚 Detail Peminjaman</h5>

            <table class="table-detail">

                <tr>
                    <th>Nama</th>
                    <td><?= $peminjaman['nama'] ?></td>
                </tr>

                <tr>
                    <th>Buku</th>
                    <td><?= $peminjaman['judul'] ?></td>
                </tr>

                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?= $peminjaman['tanggal_pinjam'] ?></td>
                </tr>

                <tr>
                    <th>Tanggal Kembali</th>
                    <td><?= $peminjaman['tanggal_kembali'] ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-primary badge-status">
                            <?= $peminjaman['status'] ?>
                        </span>
                    </td>
                </tr>

            </table>

            <div class="btn-area">
                <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
                    ← Kembali
                </a>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>