<h4 class="fw-bold mb-3">Tambah Penerbit</h4>

<div class="card shadow-sm border-0">
<div class="card-body">

<form method="post" action="<?= base_url('penerbit/store') ?>">

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama_penerbit" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>

    <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
</form>

</div>
</div>