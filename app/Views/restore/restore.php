<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Restore Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5.3 -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(90deg, #2b4366);
            min-height: 100vh;
        }

        .restore-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #2b4366, #2b4366);
            border-bottom: none;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="restore-wrapper">

        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow-lg">

                <!-- Header -->
                <div class="card-header text-white p-3">
                    <h4 class="mb-0">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Restore Database
                    </h4>
                    <small class="opacity-75">Proses pemulihan data sistem</small>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    <!-- Flash Message -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Warning -->
                    <div class="alert alert-warning d-flex">
                        <i class="bi bi-shield-exclamation me-2 fs-5"></i>
                        <div>
                            <strong>Peringatan!</strong><br>
                            Restore akan <b>menimpa seluruh data database</b>.<br>
                            Pastikan Anda sudah melakukan backup terlebih dahulu.
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="<?= base_url('restore/process') ?>" method="post" enctype="multipart/form-data"
                        onsubmit="return confirm('Yakin ingin restore database? Semua data akan ditimpa!')">

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-file-earmark-code me-1"></i>
                                File SQL
                            </label>
                            <input type="file" name="file_sql" class="form-control" accept=".sql" required>
                            <small class="text-muted">Format file harus .sql</small>
                        </div>

                        <div class="d-flex gap-2 mt-4">

                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-arrow-repeat me-1"></i>
                                Restore
                            </button>

                            <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>