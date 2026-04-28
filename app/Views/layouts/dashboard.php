<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="dashboard-title mb-4">
        <h4>Dashboard</h4>
        <p class="text-muted">Selamat datang di <b>PustakaGo</b> 📚</p>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">

        <!-- Buku -->
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-text">Total Buku</div>
                        <div class="stat-number" id="totalBuku"><?= $total_buku ?? 0 ?></div>
                    </div>
                    <div class="stat-icon bg-blue">
                        <i class="bi bi-book"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- User -->
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-text">User</div>
                        <div class="stat-number" id="totalUser"><?= $total_user ?? 0 ?></div>
                    </div>
                    <div class="stat-icon bg-warning-soft">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-text">Peminjaman</div>
                        <div class="stat-number" id="totalDipinjam"><?= $total_peminjaman ?? 0 ?></div>
                    </div>
                    <div class="stat-icon bg-success-soft">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-text">Pengembalian</div>
                        <div class="stat-number" id="totalKembali"><?= $total_pengembalian ?? 0 ?></div>
                    </div>
                    <div class="stat-icon bg-danger-soft">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Chart.js (kalau nanti dipakai) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function loadStats() {
        fetch("<?= base_url('dashboard/stats') ?>")
            .then(r => r.json())
            .then(d => {
                document.getElementById('totalBuku').innerText = d.buku;
                document.getElementById('totalUser').innerText = d.user;
                document.getElementById('totalDipinjam').innerText = d.dipinjam;
                document.getElementById('totalKembali').innerText = d.pengembalian;
            })
            .catch(err => console.log(err));
    }

    loadStats();
    setInterval(loadStats, 5000);
</script>

<?= $this->endSection() ?>