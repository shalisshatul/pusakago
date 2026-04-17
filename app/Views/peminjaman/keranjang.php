<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Keranjang Peminjaman</h2>

<?php $cart = session()->get('cart'); ?>

<?php if ($cart): ?>
    <ul>
        <?php foreach ($cart as $id): ?>
            <li>Buku ID: <?= $id ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="<?= base_url('peminjaman/checkout') ?>">
        Kirim Permintaan
    </a>

<?php else: ?>
    <p>Keranjang kosong</p>
<?php endif; ?>

<?= $this->endSection() ?>