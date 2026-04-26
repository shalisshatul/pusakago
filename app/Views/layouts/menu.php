<<style>
    /* =========================
       BODY / LATAR BELAKANG HALAMAN
       ========================= */
    body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        background: linear-gradient(135deg, #74a9ff, #dbe9ff);
    }

    /* =========================
       SIDEBAR UTAMA
       ========================= */
    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;

        background: linear-gradient(180deg, #ffffff 0%, #f0f6ff 100%);

        border-right: 1px solid rgba(13, 110, 253, 0.15);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);

        padding: 15px 12px;
        overflow-y: auto;

        /* 🔥 SEMUA HURUF SIDEBAR TEBAL */
        font-weight: 600;
    }

    /* =========================
       BRAND / LOGO APLIKASI
       ========================= */
    .brand {
        display: flex;
        align-items: center;
        gap: 10px;

        font-size: 18px;
        font-weight: 800; /* lebih tebal */
        color: rgb(0, 0, 0);

        padding: 10px 12px;
        margin-bottom: 10px;
    }

    /* =========================
       SECTION MENU
       ========================= */
    .menu-section {
        margin-top: 10px;
    }

    .menu-title {
        font-size: 11px;
        font-weight: 800; /* lebih tebal */
        color: rgb(0, 0, 0);

        margin: 12px 10px 6px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* =========================
       LINK MENU SIDEBAR
       ========================= */
    .sidebar a {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 10px 12px;
        margin-bottom: 6px;

        border-radius: 12px;
        text-decoration: none;

        color: rgb(0, 0, 0);
        font-size: 14px;

        font-weight: 600; /* 🔥 bikin menu lebih tebal */

        transition: 0.25s;
    }

    .sidebar a:hover {
        background: linear-gradient(90deg, rgba(30,94,255,0.12), rgba(30,94,255,0.05));
        color: #1e5eff;
        transform: translateX(5px);
    }

    .sidebar a.active {
        background: linear-gradient(90deg, #1e5eff, #4f8cff);
        color: #fff;
        box-shadow: 0 8px 18px rgba(30,94,255,0.25);
    }

    .sidebar i {
        font-size: 17px;
    }

    /* =========================
       USER BOX
       ========================= */
    .user-box {
        margin-top: 15px;
        padding: 12px;

        border-radius: 14px;
        background: linear-gradient(180deg, #f8fbff, #eef4ff);
        text-align: center;

        border: 1px solid rgba(30,94,255,0.1);

        font-weight: 600;
    }

    /* FOTO USER */
    .user-box img {
        border-radius: 50%;
        border: 2px solid rgb(179, 190, 218);
        margin-top: 8px;
    }

    /* ROLE TEXT */
    .role-text {
        font-size: 12px;
        color: rgb(66, 94, 150);
        font-weight: 500; /* tetap agak ringan */
    }
</style>
<div class="sidebar">

    <!-- BRAND -->
    <div class="brand">
        <i class="bi bi-book-half"></i>
        PusakaGo
    </div>

<?php
$role = session()->get('role');
$idu  = session('id');
?>

    <!-- DASHBOARD -->
    <div class="menu-section">
        <div class="menu-title">Menu Utama</div>

        <a href="<?= base_url('/') ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>

<?php if ($role == 'anggota'): ?>
    <div class="menu-section">
        <div class="menu-title">Anggota</div>

        <a href="<?= base_url('peminjaman') ?>">
            <i class="bi bi-journal-bookmark"></i> Peminjaman
        </a>

        <a href="<?= base_url('pengembalian') ?>">
            <i class="bi bi-arrow-return-left"></i> Pengembalian
        </a>

        <a href="<?= base_url('rak') ?>">
            <i class="bi bi-grid-3x3-gap"></i> Rak
        </a>
    </div>
<?php endif; ?>

<?php if ($role == 'petugas'): ?>
    <div class="menu-section">
        <div class="menu-title">Petugas</div>

        <a href="<?= base_url('/users') ?>">
            <i class="bi bi-people"></i> Users
        </a>

        <a href="<?= base_url('buku') ?>">
            <i class="bi bi-book"></i> Buku
        </a>

        <a href="<?= base_url('peminjaman') ?>">
            <i class="bi bi-journal-text"></i> Peminjaman
        </a>

        <a href="<?= base_url('pengembalian') ?>">
            <i class="bi bi-arrow-return-left"></i> Pengembalian
        </a>

        <a href="<?= base_url('rak') ?>">
            <i class="bi bi-grid"></i> Rak
        </a>

        <a href="<?= base_url('penarikan') ?>">
            <i class="bi bi-truck"></i> Penarikan
        </a>
    </div>
<?php endif; ?>

<?php if ($role == 'admin'): ?>
    <div class="menu-section">
        <div class="menu-title">Administrator</div>

        <a href="<?= base_url('/users') ?>">
            <i class="bi bi-people"></i> Users
        </a>

        <a href="<?= base_url('buku') ?>">
            <i class="bi bi-book"></i> Buku
        </a>

        <a href="<?= base_url('kategori') ?>">
            <i class="bi bi-tags"></i> Kategori
        </a>

        <a href="<?= base_url('penulis') ?>">
            <i class="bi bi-pencil"></i> Penulis
        </a>

        <a href="<?= base_url('penerbit') ?>">
            <i class="bi bi-building"></i> Penerbit
        </a>

        <a href="<?= base_url('rak') ?>">
            <i class="bi bi-grid"></i> Rak
        </a>

        <a href="<?= base_url('backup') ?>" class="text-success">
            <i class="bi bi-database"></i> Backup
        </a>
    </div>
<?php endif; ?>

    <!-- USER -->
    <div class="menu-section">
        <div class="menu-title">Akun</div>

        <div class="user-box">
            Masuk sebagai:<br>
            <b><?= session('nama'); ?></b>
            <div class="role-text">(<?= $role; ?>)</div>

            <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="60">
        </div>

        <a href="<?= base_url('users/edit/' . $idu) ?>">
            <i class="bi bi-gear"></i> Setting
        </a>

        <a href="<?= base_url('/logout') ?>" class="text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

</div>