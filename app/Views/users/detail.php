<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-3">

    <!-- TITLE -->
    <div class="mb-3">
        <h4 class="fw-bold">Detail User</h4>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">

                <!-- FOTO -->
                <div class="col-md-3 text-center mb-3">
                    <?php if ($user['foto']): ?>
                        <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                             class="rounded-circle shadow"
                             width="120" height="120"
                             style="object-fit: cover;">
                    <?php else: ?>
                        <div class="text-muted">Tidak ada foto</div>
                    <?php endif; ?>
                </div>

                <!-- DATA -->
                <div class="col-md-9">

                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Nama</th>
                            <td><?= $user['nama'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $user['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?= $user['username'] ?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>***</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <span class="badge bg-<?= 
                                    $user['role'] == 'admin' ? 'danger' :
                                    ($user['role'] == 'petugas' ? 'warning' : 'primary')
                                ?>">
                                    <?= ucfirst($user['role']) ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <!-- BUTTON -->
                    <div class="mt-3 d-flex gap-2">
                        <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <?php if (session()->get('role') == 'admin') : ?>
                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-warning text-white">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        <?php endif; ?>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>