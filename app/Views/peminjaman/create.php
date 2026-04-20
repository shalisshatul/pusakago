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

        <!-- PINJAM -->
        <form action="<?= base_url('peminjaman/store') ?>" method="post" style="margin-top:5px;">
            <input type="hidden" name="id_buku" value="<?= $b['id_buku'] ?>">
            <button type="submit">Pinjam</button>
        </form>

    </div>

<?php endforeach; ?>

</div>