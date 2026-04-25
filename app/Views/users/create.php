<!-- app/Views/users/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            font-family: "Segoe UI", sans-serif;
        }

        .form-card {
            border-radius: 15px;
            overflow: hidden;
        }

        .form-header {
            background: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .form-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
        }

        .btn-primary {
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow form-card" style="width: 380px;">

        <!-- HEADER -->
        <div class="form-header">
            <h5><i class="bi bi-person-plus"></i> Tambah User</h5>
        </div>

        <div class="card-body p-4">

            <!-- ALERT -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save"></i> Simpan
                </button>

            </form>

            <!-- FOOTER -->
            <div class="text-center mt-4">
                <a href="<?= base_url('login') ?>" class="btn btn-outline-primary btn-sm">
                    Kembali ke Login
                </a>
            </div>

        </div>

    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>