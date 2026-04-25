<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Dashboard</h4>
        <p class="text-muted">Selamat datang di <b>PustakaGo</b></p>
    </div>

    <!-- CARD STAT -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 text-muted">Total Buku</p>
                        <h5 class="fw-bold">120</h5>
                    </div>
                    <i class="bi bi-book fs-2 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 text-muted">Dipinjam</p>
                        <h5 class="fw-bold">45</h5>
                    </div>
                    <i class="bi bi-arrow-left-right fs-2 text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 text-muted">User</p>
                        <h5 class="fw-bold">30</h5>
                    </div>
                    <i class="bi bi-people fs-2 text-warning"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 text-muted">Pengembalian</p>
                        <h5 class="fw-bold">80</h5>
                    </div>
                    <i class="bi bi-check-circle fs-2 text-danger"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- CHART + TABLE -->
    <div class="row">
        
        <!-- CHART -->
        <div class="col-md-8 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Statistik Peminjaman</h6>
                    <canvas id="chartPeminjaman" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Peminjaman Terbaru</h6>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Shatul</td>
                                <td><span class="badge bg-success">Aktif</span></td>
                            </tr>
                            <tr>
                                <td>Admin</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPeminjaman');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
        datasets: [{
            label: 'Peminjaman',
            data: [10, 20, 15, 30, 25],
            borderWidth: 2,
            tension: 0.4
        }]
    }
});
</script>

<?= $this->endSection() ?>