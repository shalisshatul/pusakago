<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="mb-4">
        <h4 class="fw-bold">Dashboard</h4>
        <p class="text-muted mb-0">Selamat datang di <b>PustakaGo</b> 📚</p>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">

        <!-- Buku -->
        <div class="col-md-3">
            <div class="card stat-card bg-blue text-white">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total Buku</div>
                        <h4 id="totalBuku"><?= $total_buku ?? 0 ?></h4>
                    </div>
                    <i class="bi bi-book stat-icon"></i>
                </div>
            </div>
        </div>

        <!-- User -->
        <?php if (session()->get('role') != 'anggota') : ?>
            <div class="col-md-3">
                <div class="card stat-card bg-green text-white">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <div class="stat-title">User</div>
                            <h4 id="totalUser"><?= $total_user ?? 0 ?></h4>
                        </div>
                        <i class="bi bi-people stat-icon"></i>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Denda -->
        <div class="col-md-3">
            <div class="card stat-card bg-danger text-white">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total Denda</div>
                        <h4 id="totalDenda">Rp <?= number_format($total_denda ?? 0, 0, ',', '.') ?></h4>
                    </div>
                    <i class="bi bi-cash-coin stat-icon"></i>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-3">
            <div class="card stat-card bg-cyan text-white">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Peminjaman</div>
                        <h4 id="totalDipinjam"><?= $total_peminjaman ?? 0 ?></h4>
                    </div>
                    <i class="bi bi-arrow-left-right stat-icon"></i>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-md-3">
            <div class="card stat-card bg-dark text-white">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Pengembalian</div>
                        <h4 id="totalKembali"><?= $total_pengembalian ?? 0 ?></h4>
                    </div>
                    <i class="bi bi-check-circle stat-icon"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Chart -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="fw-bold">Statistik</h6>
            <canvas id="chartPeminjaman"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartPeminjaman');

    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: 'Peminjaman',
                    data: [],
                    borderWidth: 2
                },
                {
                    label: 'Denda',
                    data: [],
                    borderWidth: 2
                }
            ]
        }
    });

    // format rupiah
    function formatRupiah(angka) {
        return "Rp " + (angka ?? 0).toLocaleString("id-ID");
    }

    // 🔥 LOAD STATS
    function loadStats() {
        fetch("<?= base_url('index.php/dashboard/stats') ?>")
            .then(r => r.json())
            .then(d => {
                console.log("STATS:", d);

                document.getElementById('totalBuku').innerText = d.buku ?? 0;
                document.getElementById('totalDipinjam').innerText = d.dipinjam ?? 0;
                document.getElementById('totalKembali').innerText = d.pengembalian ?? 0;
                document.getElementById('totalDenda').innerText = formatRupiah(d.denda);

                if (d.user !== undefined && document.getElementById('totalUser')) {
                    document.getElementById('totalUser').innerText = d.user;
                }
            })
            .catch(err => console.log("ERROR STATS:", err));
    }

    // 🔥 LOAD CHART
    function loadChart() {
        fetch("<?= base_url('index.php/dashboard/chart') ?>")
            .then(res => res.json())
            .then(res => {
                console.log("CHART:", res);

                chart.data.labels = res.labels ?? [];
                chart.data.datasets[0].data = res.peminjaman ?? [];
                chart.data.datasets[1].data = res.denda ?? [];
                chart.update();
            })
            .catch(err => console.log("ERROR CHART:", err));
    }

    // load pertama
    loadStats();
    loadChart();

    // realtime
    setInterval(() => {
        loadStats();
        loadChart();
    }, 5000);
</script>

<?= $this->endSection() ?>