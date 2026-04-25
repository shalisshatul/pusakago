<div class="card shadow-sm border-0">
<div class="card-body">

<h5 class="fw-bold mb-3">Detail Peminjaman</h5>

<table class="table table-borderless">
<tr><th>Nama</th><td><?= $peminjaman['nama'] ?></td></tr>
<tr><th>Buku</th><td><?= $peminjaman['judul'] ?></td></tr>
<tr><th>Tgl Pinjam</th><td><?= $peminjaman['tanggal_pinjam'] ?></td></tr>
<tr><th>Tgl Kembali</th><td><?= $peminjaman['tanggal_kembali'] ?></td></tr>
<tr>
<th>Status</th>
<td><span class="badge bg-primary"><?= $peminjaman['status'] ?></span></td>
</tr>
</table>

<a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">Kembali</a>
<a href="<?= base_url('peminjaman/print/'.$peminjaman['id_peminjaman']) ?>"
   target="_blank" class="btn btn-success">Print</a>

</div>
</div>