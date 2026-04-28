<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PusakaGo</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        /* =========================
        BODY (SAMAKAN LOGIN THEME)
        ========================= */
        body {
            font-family: "Segoe UI", sans-serif;
            background: #ffffff;
        }

        /* =========================
        SIDEBAR (DARK GLASS STYLE)
        ========================= */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;

            background: rgba(20, 38, 66, 0.75);
            backdrop-filter: blur(12px);

            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.2);

            padding: 15px;

            display: flex;
            flex-direction: column;

            color: white;
        }

        /* link sidebar default */
        .sidebar a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            padding: 10px;
            border-radius: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
            transition: 0.2s;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        /* =========================
        CONTENT AREA
        ========================= */
        .content {
            margin-left: 250px;
            padding: 25px;
        }

        /* =========================
        RESPONSIVE
        ========================= */
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

    <!-- SIDEBAR -->
    <div class="sidebar">
        <?= $this->include('layouts/menu') ?>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>