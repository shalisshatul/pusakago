<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$petugas     = ['filter' => 'role:petugas'];
$anggota     = ['filter' => 'role:anggota'];
$intRole   = ['filter' => 'role:admin, petugas'];
$allRole   = ['filter' => 'role:admin, petugas, anggota'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

$routes->get('/users/create', 'Users::create'); // form tambah user
$routes->post('/users/store', 'Users::store'); // aksi simpan user

$routes->get('/users', 'Users::index', $intRole); // menampilkan data user hanya untuk admin dan petugas
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole); // form edit user
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole); // aksi hapus user

$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole); // aksi detail user
$routes->get('users/print', 'Users::print', $allRole); // aksi print data user
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole); // aksi kirim ke whatsapp
// =======================
// 📚 ROUTES BUKU
// =======================

// 🔍 Menampilkan semua buku (SEMUA ROLE)
$routes->get('buku', 'Buku::index');

// 🔍 Detail buku (SEMUA ROLE)
$routes->get('buku/detail/(:num)', 'Buku::detail/$1');

// ➕ Form tambah buku (ADMIN & PETUGAS)
$routes->get('buku/create', 'Buku::create', ['filter' => 'role:admin,petugas']);

// 💾 Simpan buku (ADMIN & PETUGAS)
$routes->post('buku/store', 'Buku::store', ['filter' => 'role:admin,petugas']);

// ✏️ Form edit buku (ADMIN & PETUGAS)

$routes->get('buku/edit/(:num)', 'Buku::edit/$1', ['filter' => 'role:admin,petugas']);

// 🔄 Update buku (ADMIN & PETUGAS)
$routes->post('buku/update/(:num)', 'Buku::update/$1', ['filter' => 'role:admin,petugas']);

// ❌ Hapus buku (ADMIN & PETUGAS)
$routes->get('buku/delete/(:num)', 'Buku::delete/$1', ['filter' => 'role:admin,petugas']);
//kategori
$routes->get('kategori', 'Kategori::index');
$routes->get('kategori/create', 'Kategori::create');
$routes->post('kategori/store', 'Kategori::store');
$routes->get('kategori/edit/(:num)', 'Kategori::edit/$1');
$routes->post('kategori/update/(:num)', 'Kategori::update/$1');
$routes->get('kategori/delete/(:num)', 'Kategori::delete/$1', ['filter' => 'role:admin,petugas']);
//penulis
$routes->get('penulis', 'Penulis::index');
$routes->get('penulis/create', 'Penulis::create');
$routes->post('penulis/store', 'Penulis::store');
$routes->get('penulis/edit/(:num)', 'Penulis::edit/$1');
$routes->post('penulis/update/(:num)', 'Penulis::update/$1');
$routes->get('penulis/delete/(:num)', 'Penulis::delete/$1');
//penerbit
$routes->get('penerbit', 'Penerbit::index');
$routes->get('penerbit/create', 'Penerbit::create');
$routes->post('penerbit/store', 'Penerbit::store');
$routes->get('penerbit/edit/(:num)', 'Penerbit::edit/$1');
$routes->post('penerbit/update/(:num)', 'Penerbit::update/$1');
$routes->get('penerbit/delete/(:num)', 'Penerbit::delete/$1');
//rak
$routes->get('rak', 'Rak::index');
$routes->get('rak/create', 'Rak::create');
$routes->post('rak/store', 'Rak::store');
$routes->get('rak/edit/(:num)', 'Rak::edit/$1');
$routes->post('rak/update/(:num)', 'Rak::update/$1');
$routes->get('rak/delete/(:num)', 'Rak::delete/$1');
// PEMINJAMAN
$routes->get('peminjaman', 'Peminjaman::index');
$routes->get('peminjaman/create', 'Peminjaman::create');
$routes->post('peminjaman/store', 'Peminjaman::store');
$routes->get('peminjaman/setujui/(:num)', 'Peminjaman::setujui/$1');

$routes->post('peminjaman/update/(:num)', 'Peminjaman::update/$1');
$routes->get('peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1');
$routes->get('peminjaman/delete/(:num)', 'Peminjaman::delete/$1');
$routes->get('peminjaman/detail/(:num)', 'Peminjaman::detail/$1');
$routes->get('peminjaman/print/(:num)', 'Peminjaman::print/$1');

$routes->get('transaksi/(:num)', 'Transaksi::index/$1');
$routes->post('transaksi/proses', 'Transaksi::prosesBayar');



// PENGIRIMAN
$routes->get('pengiriman/antar/(:num)', 'Pengiriman::antar/$1');

$routes->get('pengiriman/sampai/(:num)', 'Pengiriman::sampai/$1');

// PENGEMBALIAN
$routes->get('pengembalian/create/(:num)', 'Pengembalian::create/$1');
$routes->get('pengembalian', 'Pengembalian::index');
$routes->post('pengembalian/store', 'Pengembalian::store');

//
$routes->get('/backup', 'Backup::index');
//
$routes->get('/restore', 'Restore::index');
$routes->post('/restore/auth', 'Restore::auth');
$routes->get('/restore/form', 'Restore::form');
$routes->post('/restore/process', 'Restore::process');
//
// HALAMAN DENDA
$routes->get('denda/(:num)', 'Denda::index/$1');

// PROSES BAYAR DENDA
$routes->post('denda/bayar', 'Denda::bayar');

// DELETE (ADMIN)
$routes->get('pengembalian/delete/(:num)', 'Pengembalian::delete/$1');

// PENARIKAN

$routes->get('transaksi/bayar/(:num)', 'Transaksi::bayar/$1');
$routes->post('transaksi/proses', 'Transaksi::proses');
$routes->get('penarikan/detail/(:num)', 'Penarikan::detail/$1');
$routes->get('penarikan', 'Penarikan::index');
$routes->get('penarikan/hapus/(:num)', 'Penarikan::hapus/$1');

$routes->get('penarikan/proses/(:num)', 'Penarikan::proses/$1');
$routes->get('penarikan/ambil/(:num)', 'Penarikan::ambil/$1');
$routes->get('penarikan/selesai/(:num)', 'Penarikan::selesai/$1');
$routes->get('penarikan/bayar/(:num)', 'Penarikan::bayar/$1');
//dashboard
$routes->get('/', 'Dashboard::index', $authFilter);
$routes->get('/dashboard', 'Dashboard::index', $authFilter);

$routes->get('dashboard/stats', 'Dashboard::stats', $authFilter);
