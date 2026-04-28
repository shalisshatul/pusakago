<style>
    /* =========================
BODY
========================= */
    body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        background: #fcfcfc;
    }

    /* =========================
SIDEBAR
========================= */
    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;

        background: rgba(20, 38, 66, 0.75);
        backdrop-filter: blur(12px);

        border-right: 1px solid rgba(79, 172, 254, 0.25);
        box-shadow: 5px 0 25px rgba(0, 0, 0, 0.05);

        padding: 15px 12px;
        overflow-y: auto;
    }

    /* scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(79, 172, 254, 0.3);
        border-radius: 10px;
    }

    /* =========================
BRAND
========================= */
    .brand {
        display: flex;
        align-items: center;
        gap: 10px;

        font-size: 18px;
        font-weight: 800;
        color: #f8fbff;

        padding: 10px 12px;
        margin-bottom: 10px;
    }

    /* =========================
MENU TITLE
========================= */
    .menu-title {
        font-size: 11px;
        font-weight: 700;
        color: rgb(255, 255, 255);

        margin: 12px 10px 6px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* =========================
MENU LINK
========================= */
    .sidebar a {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 10px 12px;
        margin-bottom: 6px;

        border-radius: 12px;
        text-decoration: none;

        color: #fcfdff;
        font-size: 14px;
        font-weight: 500;

        transition: 0.25s ease;
    }



    /* icon */
    .sidebar i {
        font-size: 17px;
    }

    /* =========================
USER BOX (SESUAI LOGIN THEME)
========================= */
    .user-box {
        margin-top: 15px;
        padding: 12px;

        border-radius: 14px;

        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);

        text-align: center;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    /* foto user */
    .user-box img {
        border-radius: 50%;
        border: 2px solid rgba;
        margin-top: 8px;
    }

    /* role */
    .role-text {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
    }

    /* logout hover */
    .sidebar a.text-danger:hover {
        background: linear-gradient(135deg, #ff4d4d, #ff7a7a);
        color: white;
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
            <a href="<?= base_url('penarikan') ?>">
                <i class="bi bi-truck"></i> Penarikan
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
            <a href="<?= base_url('rak') ?>">
                <i class="bi bi-grid"></i> Rak
            </a>
            <a href="<?= base_url('peminjaman') ?>">
                <i class="bi bi-journal-text"></i> Peminjaman
            </a>

            <a href="<?= base_url('pengembalian') ?>">
                <i class="bi bi-arrow-return-left"></i> Pengembalian
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

            <!-- 🔥 TAMBAHAN YANG KAMU MINTA -->
            <a href="<?= base_url('peminjaman') ?>">
                <i class="bi bi-journal-text"></i> Peminjaman
            </a>
            <a href="<?= base_url('penarikan') ?>">
                <i class="bi bi-truck"></i> Penarikan
            </a>

            <a href="<?= base_url('pengembalian') ?>">
                <i class="bi bi-arrow-return-left"></i> Pengembalian
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