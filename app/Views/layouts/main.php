<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PusakaGo</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f4f7fb;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;

            background: #ffffff;
            border-right: 1px solid #e9ecef;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);

            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 25px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .content {
                margin-left: 70px;
            }

            .sidebar span {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <?= $this->include('layouts/menu') ?>
    </div>

    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>