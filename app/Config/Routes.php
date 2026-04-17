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

//  DETAIL BUKU (SEMUA ROLE)
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
// 📦 PEMINJAMAN
// ➕ Pinjam buku (anggota)
$routes->get('peminjaman/pinjam/(:num)', 'Peminjaman::pinjam/$1', [
    'filter' => 'role:anggota'
]);
// 🛒 Keranjang peminjaman (anggota)
$routes->get('peminjaman/keranjang', 'Peminjaman::keranjang', [
    'filter' => 'role:anggota'
]);
// 📋 List semua peminjaman (admin & petugas)
$routes->get('peminjaman', 'Peminjaman::index', [
    'filter' => 'role:admin,petugas'
]);
// ✅ Konfirmasi peminjaman (admin & petugas)
$routes->get('peminjaman/konfirmasi/(:num)', 'Peminjaman::konfirmasi/$1', [
    'filter' => 'role:admin,petugas']);
// 🔁 Pengembalian buku (admin & petugas)
$routes->get('peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1', [
  'filter' => 'role:admin,petugas']);