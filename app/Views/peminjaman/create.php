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

        <img src="<?= base_url('uploads/' . $b['cover']) ?>"
             style="width:100%; height:220px; object-fit:cover; border-radius:8px;">

        <h4 style="font-size:14px; margin:10px 0;">
            <?= $b['judul'] ?>
        </h4>

        <button type="button" onclick="pilihBuku(<?= $b['id_buku'] ?>, '<?= $b['judul'] ?>')">
            Pinjam
        </button>
        <a href="<?= base_url('buku/detail/'.$b['id_buku'].'?from=peminjaman') ?>">
    <button>Detail</button>
</a>
    </div>

<?php endforeach; ?>

</div>

<br><br>

<h3>Buku yang dipilih:</h3>
<ul id="list_buku"></ul>
<p id="judul_buku">0 buku dipilih</p>

<!-- FORM -->
<form action="<?= base_url('peminjaman/store') ?>" method="post">

    <div id="input_buku"></div>

    <p>
        <label>Tanggal Pinjam</label><br>
        <input type="date" name="tanggal_pinjam" required>
    </p>

    <p>
        <label>Metode Peminjaman</label><br>
        <select name="metode" id="metode" onchange="toggleAlamat()">
            <option value="ambil">Ambil ke Perpustakaan</option>
            <option value="antar">Diantar</option>
        </select>
    </p>

    <div id="form_alamat" style="display:none;">
        <p>
            <label>Alamat Pengiriman</label><br>
            <textarea name="alamat"></textarea>
        </p>
    </div>

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

function toggleAlamat() {
    let metode = document.getElementById('metode').value;
    document.getElementById('form_alamat').style.display =
        (metode === 'antar') ? 'block' : 'none';
}

function pilihBuku(id, judul) {

    if (bukuDipilih.includes(id)) {
        alert("Buku sudah dipilih");
        return;
    }

    bukuDipilih.push(id);

    document.getElementById('input_buku').innerHTML +=
        `<input type="hidden" name="id_buku[]" value="${id}">`;

    document.getElementById('list_buku').innerHTML +=
        `<li>${judul}</li>`;

    document.getElementById('judul_buku').innerText =
        bukuDipilih.length + " buku dipilih";
}

</script>

<?= $this->endSection() ?>
