<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Akses Restore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>">

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height: 100vh;
        }

        .login-container {
            height: 100vh;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: none;
            border-bottom: none;
            text-align: center;
        }

        .title {
            font-weight: 700;
            color: #333;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
            border-color: #4facfe;
        }

        .btn-custom {
            background: linear-gradient(90deg, #4facfe, #007bff);
            color: white;
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }

        .icon {
            font-size: 50px;
            color: #007bff;
        }

        .form-check-label {
            font-size: 14px;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container login-container d-flex justify-content-center align-items-center">
        <div class="col-md-4">

            <div class="card p-4">

                <div class="card-header">
                    <i class="bi bi-shield-lock-fill icon"></i>
                    <h4 class="title mt-2">Akses Restore</h4>
                    <p class="text-muted small">Masukkan password untuk melanjutkan</p>
                </div>

                <div class="card-body">

                    <!-- ALERT -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger text-center">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('restore/auth') ?>" method="post">

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    class="form-control"
                                    placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" onclick="togglePassword()">
                            <label class="form-check-label">Tampilkan Password</label>
                        </div>

                        <button type="submit" class="btn btn-custom w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            x.type = x.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>