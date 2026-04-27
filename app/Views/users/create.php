<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
        }

        /* LEFT PANEL */
        .left-panel {
            background: linear-gradient(135deg, #42a5f5,rgb(91, 111, 141));
            color: white;
            height: 100vh;
            text-align: center;
            padding: 40px;
        }

        .left-panel h1 {
            font-weight: 700;
            letter-spacing: 2px;
        }

        .left-panel p {
            opacity: 0.9;
        }

        /* RIGHT PANEL */
        .right-panel {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 100%;
            max-width: 350px;
        }

        .login-box h4 {
            font-weight: 600;
        }

        .form-control {
            border-radius: 25px;
            padding: 10px 15px;
        }

        .input-group-text {
            border-radius: 25px 0 0 25px;
            background: white;
        }

        .btn-primary {
            border-radius: 25px;
            padding: 10px;
        }

        .form-link {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- LEFT -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center left-panel">
        <h1>PUSAKAGO!</h1>   
        <h1>DAFTAR AKUN BARU</h1>
            <p class="mt-3 px-5">
            “Sistem peminjaman buku perpustakaan modern yang cepat, praktis, dan mudah digunakan”
            </p>
        </div>

        <!-- RIGHT -->
        <div class="col-md-6 right-panel">

            <div class="form-box">

                <h4 class="text-center mb-4">Tambah User</h4>

                <!-- ERROR -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- FORM -->
                <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

                    <!-- NAMA -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <!-- USERNAME -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>


                    <!-- FOTO -->
                    <div class="mb-3">
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save"></i> Simpan
                    </button>

                </form>

                <!-- LINK -->
                <div class="text-center mt-3 form-link">
                    <a href="<?= base_url('login') ?>">Kembali ke Login</a>
                </div>

            </div>

        </div>

    </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>