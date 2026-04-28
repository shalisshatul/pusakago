<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Akses Restore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        /* =========================
        BODY (SAMA PERSIS LOGIN SPLIT THEME)
        ========================= */
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;

            /* kiri gelap - kanan biru (seperti login kamu) */
            background: linear-gradient(90deg, #2b4366);
        }

        /* =========================
        CENTER CONTAINER
        ========================= */
        .login-container {
            height: 100vh;
        }

        /* =========================
        CARD RESTORE (SAMAKAN LOGIN BOX)
        ========================= */
        .card {
            border: none;
            border-radius: 18px;

            /* dark glass seperti login box */
            background: rgba(43, 63, 95, 0.78);
            backdrop-filter: blur(12px);

            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);

            color: white;
        }

        /* =========================
        HEADER CARD
        ========================= */
        .card-header {
            background: transparent;
            border-bottom: none;
            text-align: center;
        }

        .title {
            font-weight: 700;
            color: white;
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.7);
        }

        /* =========================
        INPUT FORM
        ========================= */
        .form-control {
            border-radius: 12px;
            padding: 11px 14px;

            background: rgba(255, 255, 255, 0.08);
            border: none;

            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control:focus {
            box-shadow: none;
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }

        label {
            color: rgba(255, 255, 255, 0.8);
        }

        /* =========================
        BUTTON (SAMAKAN LOGIN)
        ========================= */
        .btn-custom {
            background: linear-gradient(135deg, #6c9edf, #3f6fb5);
            border: 1px solid rgba(255, 255, 255, 0.15);

            color: white;
            border-radius: 12px;

            transition: 0.3s ease;
            padding: 10px;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(108, 158, 223, 0.35);
            filter: brightness(1.08);
        }

        /* =========================
        CHECKBOX
        ========================= */
        .form-check-label {
            color: rgba(255, 255, 255, 0.8);
        }

        /* =========================
        ALERT
        ========================= */
        .alert {
            border-radius: 10px;
        }

        /* ICON */
        .icon {
            font-size: 45px;
        }
    </style>
</head>

<body>

    <div class="container login-container d-flex justify-content-center align-items-center">
        <div class="col-md-4">

            <div class="card p-4">

                <div class="card-header">

                    <div class="icon">🔐</div>

                    <h4 class="title mt-2">Akses Restore Database</h4>

                    <p class="small">Masukkan password untuk melanjutkan</p>

                </div>

                <div class="card-body">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger text-center">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('restore/auth') ?>" method="post">

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" onclick="togglePassword()">
                            <label class="form-check-label">Tampilkan Password</label>
                        </div>

                        <button type="submit" class="btn btn-custom btn-block w-100">
                            Masuk
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            x.type = x.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>