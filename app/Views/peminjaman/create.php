<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Pilih Buku untuk Dipinjam</h2>

<div style="display:flex; flex-wrap:wrap; gap:20px;">

<?php foreach ($buku as $b): ?>
    
    <div style="width:180px; border:1px solid #ccc; padding:10px; border-radius:10px; text-align:center;">

        <!-- COVER -->
        <img src="<?= base_url('uploads/' . $b['cover']) ?>"
             style="width:100%; height:220px; object-fit:cover; border-radius:8px;">

        <!-- JUDUL -->
        <h4 style="font-size:14px; margin:10px 0;">
            <?= $b['judul'] ?>
        </h4>

        <!-- BUTTON -->
        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas'): ?>
            <a href="<?= base_url('buku/edit/'.$b['id_buku']) ?>">
                <button>Edit</button>
            </a>
        <?php endif; ?>

        <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">
            <button>Detail</button>
        </a>

        <!-- PILIH BUKU -->
        <button type="button" onclick="pilihBuku(<?= $b['id_buku'] ?>, '<?= $b['judul'] ?>')">
            Pinjam
        </button>

    </div>

<?php endforeach; ?>

</div>

<br><br>

<h3>Buku yang dipilih:</h3>
<p id="judul_buku">Belum memilih buku</p>

<form action="<?= base_url('peminjaman/store') ?>" method="post">

    <!-- ID buku -->
    <input type="hidden" name="id_buku" id="id_buku">

    <p>
        <label>Tanggal Pinjam</label><br>
        <input type="date" name="tanggal_pinjam" required>
    </p>

   

    <!-- METODE (HANYA 1) -->
    <p>
        <label>Metode Peminjaman</label><br>
        <select name="metode" id="metode" onchange="toggleAlamat()">
            <option value="ambil">Ambil ke Perpustakaan</option>
            <option value="antar">Diantar</option>
        </select>
    </p>

    <!-- ALAMAT -->
    <div id="form_alamat" style="display:none;">
        <p>
            <label>Alamat Pengiriman</label><br>
            <textarea name="alamat"></textarea>
        </p>
    </div>

    <button type="submit">Simpan</button>

</form>

<script>
function toggleAlamat() {
    let metode = document.getElementById('metode').value;
    let alamat = document.getElementById('form_alamat');

    if (metode === 'antar') {
        alamat.style.display = 'block';
    } else {
        alamat.style.display = 'none';
    }
}

function pilihBuku(id, judul) {
    document.getElementById('id_buku').value = id;
    document.getElementById('judul_buku').innerText = judul;
}
</script>

<?= $this->endSection() ?>
