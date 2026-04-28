<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <style>
        /* =========================
GLOBAL / BODY (BACKGROUND HALAMAN)
========================= */
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;

            /* warna utama aplikasi (tema login + sidebar) */
            background: #6c9edf;
        }

        /* =========================
LEFT PANEL (BAGIAN KIRI - TEKS / BRANDING)
========================= */
        .left-panel {
            background: rgba(14, 23, 39, 0.75);
            /* dark glass */
            backdrop-filter: blur(12px);

            color: white;
            height: 100vh;

            text-align: center;
            padding: 60px 40px;
        }

        /* judul besar di left panel */
        .left-panel h1 {
            font-weight: 800;
            letter-spacing: 2px;
        }

        /* deskripsi di left panel */
        .left-panel p {
            opacity: 0.9;
            font-size: 15px;
            line-height: 1.6;
        }

        /* =========================
RIGHT PANEL (AREA FORM LOGIN)
========================= */
        .right-panel {
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background: transparent;
        }

        /* =========================
LOGIN BOX (CARD LOGIN UTAMA)
========================= */
        .login-box {
            width: 100%;
            max-width: 380px;

            padding: 35px;
            border-radius: 18px;

            /* glass dark style biar nyatu sama sidebar */
            background: rgba(20, 38, 66, 0.75);
            backdrop-filter: blur(12px);

            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);

            color: white;
        }

        /* judul "Login Account" */
        .login-box h4 {
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }

        /* =========================
INPUT ICON (KIRI ICON USER / LOCK)
========================= */
        .input-group-text {
            background: rgba(255, 255, 255, 0.08);
            border: none;
            color: white;

            border-radius: 12px 0 0 12px;
        }

        /* =========================
INPUT FIELD (USERNAME & PASSWORD)
========================= */
        .form-control {
            border-radius: 12px;
            padding: 11px 14px;

            background: rgba(255, 255, 255, 0.08);
            border: none;

            color: white;
        }

        /* placeholder warna abu transparan */
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* saat input fokus */
        .form-control:focus {
            box-shadow: none;
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }

        /* =========================
BUTTON LOGIN (TOMBOL UTAMA)
========================= */
        .btn-primary {
            border-radius: 12px;
            padding: 11px;
            font-weight: 600;

            /* warna disamakan dengan tema aplikasi */
            background: linear-gradient(135deg, #6c9edf, #3f6fb5);
            border: 1px solid rgba(255, 255, 255, 0.15);

            color: #fff;
            transition: 0.3s ease;
        }

        /* hover tombol login */
        .btn-primary:hover {
            transform: translateY(-2px);

            box-shadow: 0 10px 20px rgba(108, 158, 223, 0.35);
            filter: brightness(1.08);
        }

        /* =========================
LINK (DAFTAR & RESTORE)
========================= */
        .form-link {
            font-size: 14px;
            color: white;
        }

        /* link normal */
        .form-link a {
            text-decoration: none;
            color: #ffffff;
            font-weight: 500;
            opacity: 0.85;
        }

        /* hover link */
        .form-link a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        /* =========================
RESPONSIVE (HP / TABLET)
========================= */
        @media (max-width: 768px) {

            /* sembunyikan panel kiri di HP */
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