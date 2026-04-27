<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .foto-preview {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #0d6efd;
        display: block;
        margin: 0 auto 10px auto;
    }

    .form-card {
        border-radius: 15px;
    }

    /* 🔥 PERBAIKAN GAMBAR */
    .cover-buku {
        width: 100%;
        height: 220px; /* semua sama tinggi */
        object-fit: cover; /* biar tidak gepeng */
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* 🔥 BIAR CARD RAPI */
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s;
    }

    .card:hover {
        transform: scale(1.03);
    }
</style>

<div class="container-fluid mt-3">

    <h4 class="fw-bold mb-3">Pilih Buku</h4>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <input type="text" id="search" class="form-control"
                   placeholder="Cari buku...">
        </div>
    </div>

    <!-- LIST BUKU -->
    <div class="row g-3" id="listBuku">

        <?php foreach ($buku as $b): ?>
        <div class="col-md-3 buku-card"
             data-judul="<?= strtolower($b['judul']) ?>">

            <div class="card h-100 shadow-sm border-0">

                <!-- 🔥 COVER SUDAH FIX -->
                <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>"
                     class="cover-buku">

                <div class="card-body text-center">

                    <h6 class="fw-bold"><?= $b['judul'] ?></h6>

                    <p class="text-muted small mb-2">
                        Stok: <b><?= $b['tersedia'] ?></b>
                    </p>

                    <div class="d-flex gap-1 justify-content-center">

                        <button class="btn btn-sm btn-primary"
                                onclick="pilihBuku(<?= $b['id_buku'] ?>,'<?= $b['judul'] ?>')">
                            Pinjam
                        </button>

                        <button class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetail"
                                onclick="showDetail(
                                    '<?= esc($b['judul']) ?>',
                                    '<?= esc($b['nama_kategori'] ?? '-') ?>',
                                    '<?= esc($b['nama_penulis'] ?? '-') ?>',
                                    '<?= esc($b['nama_penerbit'] ?? '-') ?>',
                                    '<?= esc($b['tahun_terbit'] ?? '-') ?>',
                                    '<?= esc($b['deskripsi'] ?? 'Tidak ada deskripsi') ?>',
                                    '<?= base_url('uploads/buku/'.$b['cover']) ?>'
                                )">
                            Detail
                        </button>

                    </div>

                </div>
            </div>

        </div>
        <?php endforeach; ?>

    </div>

    <!-- PILIHAN -->
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-body">
            <h6 class="fw-bold">Buku Dipilih</h6>
            <ul id="list_buku"></ul>
            <p id="judul_buku" class="text-muted">0 buku dipilih</p>
        </div>
    </div>

    <!-- FORM -->
    <div class="card mt-3 shadow-sm border-0">
        <div class="card-body">

            <form action="<?= base_url('peminjaman/store') ?>" method="post">

                <div id="input_buku"></div>

                <div class="mb-3">
                    <label class="form-label">Metode</label>
                    <select name="metode" id="metode" class="form-select">
                        <option value="ambil">Ambil</option>
                        <option value="antar">Antar</option>
                    </select>
                </div>

                <div class="mb-3" id="alamatField" style="display:none;">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <button class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>

            </form>

        </div>
    </div>

</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">

                <img id="detail_cover"
                     class="img-fluid mb-2"
                     style="max-height:200px; object-fit:cover; border-radius:10px;">

                <h5 id="detail_judul"></h5>

                <p><b>Kategori:</b> <span id="detail_kategori"></span></p>
                <p><b>Penulis:</b> <span id="detail_penulis"></span></p>
                <p><b>Penerbit:</b> <span id="detail_penerbit"></span></p>
                <p><b>Tahun:</b> <span id="detail_tahun"></span></p>

                <p class="mt-2"><b>Deskripsi:</b></p>
                <p id="detail_deskripsi" class="text-muted small"></p>

            </div>

        </div>
    </div>
</div>

<script>
let bukuDipilih = [];

document.getElementById('search').addEventListener('keyup', function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll('.buku-card').forEach(card=>{
        card.style.display = card.dataset.judul.includes(val) ? '' : 'none';
    });
});

document.getElementById('metode').addEventListener('change', function(){
    document.getElementById('alamatField').style.display =
        this.value === 'antar' ? 'block' : 'none';
});

function pilihBuku(id, judul){
    if(bukuDipilih.includes(id)) return alert('Sudah dipilih');

    bukuDipilih.push(id);

    document.getElementById('input_buku').innerHTML +=
        `<input type="hidden" name="id_buku[]" value="${id}">`;

    document.getElementById('list_buku').innerHTML += `<li>${judul}</li>`;

    document.getElementById('judul_buku').innerText =
        bukuDipilih.length + " buku dipilih";
}

function showDetail(j,k,p,pe,t,d,c){
    detail_judul.innerText = j;
    detail_kategori.innerText = k;
    detail_penulis.innerText = p;
    detail_penerbit.innerText = pe;
    detail_tahun.innerText = t;
    detail_deskripsi.innerText = d;
    detail_cover.src = c;
}
</script>

<?= $this->endSection() ?>