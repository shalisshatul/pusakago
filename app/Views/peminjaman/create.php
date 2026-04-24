<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Pilih Buku untuk Dipinjam</h2>

<!-- SEARCH -->
<input type="text" id="search" onkeyup="searchBuku()" placeholder="Cari buku..." style="padding:8px; width:200px;">

<br><br>

<!-- LIST BUKU -->
<div id="listBuku" style="display:flex; flex-wrap:wrap; gap:20px;">

    <?php foreach ($buku as $b): ?>
        <div class="buku-card"
            data-judul="<?= strtolower($b['judul']) ?>"
            style="width:180px; border:1px solid #ccc; padding:10px; border-radius:10px; text-align:center;">

            <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                style="width:100%; height:220px; object-fit:cover; border-radius:8px;">

            <h4 style="font-size:14px; margin:10px 0;">
                <?= $b['judul'] ?>
            </h4>
            <p style="font-size:12px;">
    Stok: <b><?= $b['tersedia'] ?></b>
</p>

            <button type="button" onclick="pilihBuku(<?= $b['id_buku'] ?>, '<?= $b['judul'] ?>')">
                Pinjam
            </button>

            <button type="button" onclick="showDetail(
                '<?= esc($b['judul']) ?>',
                '<?= esc($b['nama_kategori'] ?? '-') ?>',
                '<?= esc($b['nama_penulis'] ?? '-') ?>',
                '<?= esc($b['nama_penerbit'] ?? '-') ?>',
                '<?= esc($b['tahun_terbit'] ?? '-') ?>',
                '<?= base_url('uploads/buku/' . $b['cover']) ?>'
            )">
                Detail
            </button>
        </div>
    <?php endforeach; ?>

</div>

<br><br>

<h3>Buku yang dipilih:</h3>
<ul id="list_buku"></ul>
<p id="judul_buku">0 buku dipilih</p>

<!-- FORM -->
<form action="<?= base_url('peminjaman/store') ?>" method="post">

    <!-- 🔥 INI YANG TADI KURANG -->
    <div id="input_buku"></div>

    <label>Metode:</label>
    <select name="metode" id="metode">
        <option value="ambil">Ambil di Perpustakaan</option>
        <option value="antar">Antar ke Rumah</option>
    </select>

    <br><br>

    <div id="alamatField" style="display:none;">
        <label>Alamat:</label><br>
        <textarea name="alamat"></textarea>
    </div>

    <br>

    <button type="submit">Simpan</button>

</form>

<script>
let bukuDipilih = [];

function searchBuku() {
    let input = document.getElementById('search').value.toLowerCase();
    let cards = document.querySelectorAll('.buku-card');

    cards.forEach(card => {
        let judul = card.getAttribute('data-judul');
        card.style.display = judul.includes(input) ? "block" : "none";
    });
}

document.getElementById('metode').addEventListener('change', function() {
    document.getElementById('alamatField').style.display =
        (this.value === 'antar') ? 'block' : 'none';
});

function pilihBuku(id, judul) {

    if (bukuDipilih.includes(id)) {
        alert("Buku sudah dipilih");
        return;
    }

    bukuDipilih.push(id);

    // 🔥 TAMBAH INPUT HIDDEN
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'id_buku[]';
    input.value = id;
    document.getElementById('input_buku').appendChild(input);

    // tampilkan list
    document.getElementById('list_buku').innerHTML += `<li>${judul}</li>`;

    document.getElementById('judul_buku').innerText =
        bukuDipilih.length + " buku dipilih";
}
</script>

<!-- MODAL -->
<div id="modalDetail" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6);">
    <div style="background:#fff; width:400px; margin:50px auto; padding:20px; border-radius:10px; position:relative;">
        <button onclick="tutupModal()" style="position:absolute; right:10px; top:10px;">X</button>

        <h3 id="detail_judul"></h3>
        <img id="detail_cover" style="width:100%; height:250px; object-fit:cover; border-radius:8px;">

        <p><strong>Kategori:</strong> <span id="detail_kategori"></span></p>
        <p><strong>Penulis:</strong> <span id="detail_penulis"></span></p>
        <p><strong>Penerbit:</strong> <span id="detail_penerbit"></span></p>
        <p><strong>Tahun:</strong> <span id="detail_tahun"></span></p>
    </div>
</div>

<script>
function showDetail(judul, kategori, penulis, penerbit, tahun, cover) {
    document.getElementById('detail_judul').innerText = judul;
    document.getElementById('detail_kategori').innerText = kategori;
    document.getElementById('detail_penulis').innerText = penulis;
    document.getElementById('detail_penerbit').innerText = penerbit;
    document.getElementById('detail_tahun').innerText = tahun;
    document.getElementById('detail_cover').src = cover;

    document.getElementById('modalDetail').style.display = 'block';
}

function tutupModal() {
    document.getElementById('modalDetail').style.display = 'none';
}
</script>

<?= $this->endSection() ?>
