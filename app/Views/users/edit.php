<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- TITLE -->
    <div class="mb-3">
        <h4 class="fw-bold">Edit User</h4>
        <p class="text-muted">Perbarui data user</p>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">

                <div class="row">

                    <!-- NAMA -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control"
                               value="<?= $user['nama'] ?>" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= $user['email'] ?>" required>
                    </div>

                    <!-- USERNAME -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control"
                               value="<?= $user['username'] ?>" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak diubah</small>
                    </div>

                    <!-- ROLE -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                            <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>

                    <!-- FOTO -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">

                        <div class="mt-2">
                            <small class="text-muted">Foto saat ini:</small><br>

                            <?php if ($user['foto']): ?>
                                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                     class="rounded-circle mt-2"
                                     width="60" height="60"
                                     style="object-fit: cover;">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>