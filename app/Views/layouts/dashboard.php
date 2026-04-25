<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <div class="mb-4">
        <h4 class="fw-bold">Dashboard</h4>
        <p class="text-muted">Selamat datang di <b>PustakaGo</b></p>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Buku</p>
                        <h5 id="totalBuku"><?= $total_buku ?? 0 ?></h5>
                    </div>
                    <i class="bi bi-book fs-2 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">User</p>
                        <h5 id="totalUser"><?= $total_user ?? 0 ?></h5>
                    </div>
                    <i class="bi bi-people fs-2 text-warning"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Peminjaman</p>
                        <h5 id="totalDipinjam"><?= $total_peminjaman ?? 0 ?></h5>
                    </div>
                    <i class="bi bi-arrow-left-right fs-2 text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Pengembalian</p>
                        <h5 id="totalKembali"><?= $total_pengembalian ?? 0 ?></h5>
                    </div>
                    <i class="bi bi-check-circle fs-2 text-danger"></i>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function loadStats(){
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