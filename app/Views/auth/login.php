<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            font-family: "Segoe UI", sans-serif;
        }

        .login-card {
            border-radius: 15px;
            overflow: hidden;
        }

        .login-header {
            background: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .login-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">

        <div class="card shadow login-card" style="width: 380px;">

            <!-- HEADER -->
            <div class="login-header">
                <h4><i class="bi bi-book"></i> PusakaGo</h4>
                <small>Sistem Perpustakaan</small>
            </div>

            <div class="card-body p-4">

                <!-- ERROR -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('salahpw') ?>
                    </div>
                <?php endif; ?>

                <!-- FORM -->
                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username"
                               class="form-control"
                               placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Masukkan password" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>

                </form>

                <!-- FOOTER -->
                <div class="text-center mt-4">

                    <a href="<?= base_url('users/create') ?>"
                       class="btn btn-outline-success btn-sm me-1">
                        <i class="bi bi-person-plus"></i> Daftar
                    </a>

                    <a href="<?= base_url('restore') ?>"
                       class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-database"></i> Restore
                    </a>

                </div>

            </div>

        </div>

    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>