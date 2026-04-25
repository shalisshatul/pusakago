<style>
    body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        background: #f4f7fb;
    }

    .sidebar {
        width: 240px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;

        background: #ffffff;
        border-right: 1px solid #e9ecef;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);

        padding: 12px;
        overflow-y: auto;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: 8px;

        padding: 7px 10px;
        margin-bottom: 3px;

        border-radius: 8px;
        text-decoration: none;
        color: #495057;
        font-size: 14px;

        transition: 0.2s;
    }

    .sidebar a:hover {
        background: #e7f1ff;
        color: #0d6efd;
        transform: translateX(3px);
    }

    .sidebar b {
        color: #0d6efd;
    }

    .user-box {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #e9ecef;
        text-align: center;
    }

    .user-box img {
        border-radius: 50%;
        border: 2px solid #0d6efd;
        margin-top: 6px;
    }

    .role-text {
        font-size: 12px;
        color: #6c757d;
    }

    i {
        font-size: 16px;
    }
</style>

<div class="sidebar">

<!-- TITLE -->
<a href="#">
    <i class="bi bi-book-half"></i>
    <b>PusakaGo</b>App
</a>

<?php
$role = session()->get('role');
$idu  = session('id');
?>

<!-- ================= DASHBOARD ================= -->
<a href="<?= base_url('/') ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>

<!-- ================= ANGGOTA ================= -->
<?php if ($role == 'anggota'): ?>
    <a href="<?= base_url('peminjaman') ?>">
        <i class="bi bi-journal-bookmark"></i> Peminjaman
    </a>

    <a href="<?= base_url('pengembalian') ?>">
        <i class="bi bi-arrow-return-left"></i> Pengembalian
    </a>

    <a href="<?= base_url('rak') ?>">
        <i class="bi bi-grid-3x3"></i> Rak
    </a>
<?php endif; ?>

<!-- ================= PETUGAS ================= -->
<?php if ($role == 'petugas'): ?>
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
<?php endif; ?>

<!-- ================= ADMIN ================= -->
<?php if ($role == 'admin'): ?>
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
<?php endif; ?>
<!-- USER -->
<div class="user-box">
    Masuk sebagai:<br>
    <b><?= session('nama'); ?></b>
    <div class="role-text">(<?= $role; ?>)</div>

    <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="65">
</div>
<!-- ================= SETTING ================= -->
<a href="<?= base_url('users/edit/' . $idu) ?>">
    <i class="bi bi-gear"></i> Setting
</a>

<!-- ================= LOGOUT ================= -->
<a href="<?= base_url('/logout') ?>" class="text-danger">
    <i class="bi bi-box-arrow-right"></i> Logout
</a>



</div>