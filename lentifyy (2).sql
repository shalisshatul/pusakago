-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Apr 2026 pada 20.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lentifyy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `tersedia` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `isbn`, `judul`, `id_kategori`, `id_penulis`, `id_penerbit`, `tahun_terbit`, `jumlah`, `tersedia`, `deskripsi`, `cover`) VALUES
(22, '30082008', 'pulang', 1, 4, 10, '2023', 7, -2, 'ini ', '1776668120_384f1f71c6bd2db5ac0f.webp'),
(23, '3008203', 'bandung after rain', 1, 4, 13, '2014', 52, 44, 'di bandung', '1776668210_bde0a5d41e47876bc997.jpg'),
(25, '	6026064060', 'PISIKOTES TNI POLRI', 10, 17, 21, '2026', 15, 5, 'buku tes pisikotes terbaru tahun ini', '1776700159_7f0cffaa7c44bd31a438.png'),
(26, '978-602-5710-55-1', 'TOP No. 1 TKA (Tes Kemampuan Akademik) SMA/MA IPA 2025/2026', 11, 19, 22, '2025', 10, 3, 'Menggunakan metode pembelajaran bertahap, dilengkapi ringkasan materi padat serta ribuan soal drilling (latihan) beserta kunci jawaban dan pembahasan mendalam.', '1776700667_ebd797e21fe34e129d5e.avif'),
(27, ' 978-623-8618-01-9', 'Buku Paten UTBK SNBT TPS 2025 (Tes Potensi Skolastik) Update Terbaru', 12, 20, 23, '2024', 20, 19, 'Buku ini berfokus pada 7 subtes TPS. Dilengkapi dengan Field Report (FR) soal asli 2023-2024, paket drilling soal, prediksi SNBT, bonus simulasi android, dan video bedah soal. Sangat cocok untuk penguatan dasar.', '1776701073_d806b1acbf5524194603.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) UNSIGNED NOT NULL,
  `id_pengembalian` int(11) UNSIGNED DEFAULT NULL,
  `jumlah_denda` decimal(10,2) NOT NULL,
  `bukti_pembayaran` text DEFAULT NULL,
  `metode` varchar(20) DEFAULT NULL,
  `status` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL,
  `id_peminjaman` int(11) UNSIGNED NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detail`, `id_peminjaman`, `id_buku`, `jumlah`) VALUES
(96, 122, 26, 1),
(97, 123, 25, 1),
(98, 124, 25, 1),
(99, 125, 23, 1),
(100, 126, 23, 1),
(101, 127, 25, 1),
(102, 128, 26, 1),
(103, 129, 23, 1),
(104, 130, 22, 1),
(105, 131, 22, 1),
(106, 132, 22, 1),
(107, 133, 25, 1),
(108, 134, 23, 1),
(109, 135, 25, 1),
(110, 136, 23, 1),
(111, 137, 22, 1),
(112, 137, 23, 1),
(113, 138, 25, 1),
(114, 138, 26, 1),
(115, 139, 26, 1),
(116, 139, 25, 1),
(117, 140, 25, 1),
(118, 141, 23, 1),
(119, 142, 22, 1),
(120, 143, 25, 1),
(121, 144, 22, 1),
(122, 145, 22, 1),
(123, 146, 22, 1),
(124, 147, 22, 1),
(125, 148, 22, 1),
(126, 149, 22, 1),
(127, 149, 23, 1),
(128, 150, 22, 1),
(129, 151, 25, 1),
(130, 152, 22, 1),
(131, 153, 25, 1),
(132, 154, 26, 1),
(133, 155, 23, 1),
(134, 156, 25, 1),
(135, 157, 23, 1),
(136, 158, 26, 1),
(137, 159, 22, 1),
(138, 160, 27, 1),
(139, 161, 26, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `is_deleted`) VALUES
(1, 'Novel', 0),
(2, 'Komik', 0),
(3, 'Pelajaran', 0),
(4, 'komik', 0),
(5, 'bjdbsjbdj', 1),
(6, 'series', 0),
(7, 'vinsen', 1),
(8, 'series', 0),
(9, 'pelajaran', 0),
(10, 'pisikologi', 0),
(11, 'TES KEMAMPUAN AKADEMIK', 0),
(12, 'latihan ', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) UNSIGNED NOT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('menunggu','diantar','dipinjam','dikembalikan') DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `metode` enum('ambil','antar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `id`, `metode`) VALUES
(157, '2026-04-24', '2026-04-29', 'dikembalikan', 2, 'ambil'),
(158, '2026-04-24', '2026-04-29', 'dikembalikan', 2, 'ambil'),
(160, '2026-04-24', '2026-04-29', 'dikembalikan', 2, 'ambil'),
(161, '2026-04-24', '2026-04-29', 'dikembalikan', 2, 'ambil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','diambil','selesai') DEFAULT 'menunggu',
  `tanggal_ambil` date DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `is_deleted`) VALUES
(1, 'pt.jaya', '', 1),
(2, 'pt.jaya', '', 1),
(3, 'wee', '', 0),
(4, 'pt.calon', '', 0),
(5, 'gg', '', 0),
(6, '55', '', 1),
(7, '11', '', 0),
(8, 'pp', '', 0),
(9, 'wee', '', 0),
(10, 'wisyouall', '', 0),
(11, '55', '', 0),
(12, 'gg', '', 0),
(13, 'cv.yy', '', 0),
(14, 'dgvdjkvd', '', 0),
(15, 'gg', '', 0),
(16, 'shalis', 'sumedang', 1),
(17, 'cv.guee', 'subang', 1),
(18, 'cv.guee', 'subang', 0),
(19, 'pt.calon', '', 1),
(20, 'granmedia.bandung', '', 1),
(21, 'forum edukasi', '', 1),
(22, 'granmedia', '', 1),
(23, 'Tim Tentor Paten', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) UNSIGNED NOT NULL,
  `id_peminjaman` int(11) UNSIGNED DEFAULT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `denda` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tanggal_dikembalikan`, `denda`) VALUES
(37, 160, '2026-04-25', 0.00),
(38, 161, '2026-04-27', 0.00),
(39, 161, '2026-04-27', 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','dikirim','sampai') DEFAULT 'menunggu',
  `tanggal_kirim` date DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_peminjaman`, `alamat`, `biaya`, `status`, `tanggal_kirim`, `id`) VALUES
(1, 86, 'cikaramas', 10000.00, 'sampai', '2026-04-20', 3),
(2, 87, 'tanjungmedar', 10000.00, 'menunggu', NULL, NULL),
(3, 88, 'tanjungmedar', 10000.00, 'sampai', '2026-04-20', 3),
(4, 91, 'sembir', 10000.00, 'sampai', '2026-04-20', 3),
(5, 138, 'bogor', 10000.00, 'dikirim', '2026-04-21', NULL),
(6, 139, 'jogja', 10000.00, 'sampai', '2026-04-21', NULL),
(7, 140, 'padasuka', 10000.00, 'sampai', '2026-04-22', NULL),
(8, 142, 'bogor', 10000.00, 'menunggu', NULL, NULL),
(9, 143, 'jogja', 10000.00, 'sampai', '2026-04-22', NULL),
(10, 144, 'surga', 10000.00, 'sampai', '2026-04-22', NULL),
(11, 145, 'bogor', 10000.00, 'sampai', '2026-04-22', NULL),
(12, 146, 'cci', 10000.00, 'sampai', '2026-04-22', NULL),
(13, 150, 'bogor', 10000.00, 'menunggu', NULL, NULL),
(14, 151, 'bogor', 10000.00, 'sampai', '2026-04-24', NULL),
(15, 152, 'sumedang', 10000.00, 'dikirim', '2026-04-24', NULL),
(16, 153, 'cimanggung', 10000.00, 'dikirim', '2026-04-24', NULL),
(17, 154, 'sembir', 10000.00, 'sampai', '2026-04-24', NULL),
(18, 159, 'bogor', 10000.00, 'sampai', '2026-04-24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`, `is_deleted`) VALUES
(1, 'ute', 0),
(3, 'cc', 1),
(4, 'shalis', 0),
(5, 'gg', 0),
(6, '55', 0),
(7, '11', 0),
(8, 'pp', 0),
(9, 'shalis', 0),
(10, 'awan', 0),
(11, 'cc', 1),
(12, 'shalis', 0),
(13, 'jaka', 0),
(15, 'shalis', 1),
(17, 'karlina S.Hi', 0),
(18, 'shalis', 0),
(19, 'Nada Salsabila, S.Pd.', 0),
(20, 'Tim Tentor Paten', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `lokasi`, `is_deleted`) VALUES
(5, 'penelitian', 'lantai 1', 0),
(6, 'rak ke-3 ', 'lantai 3', 0),
(8, 'rak 2', 'lantai 3', 0),
(9, '300 - 400', 'lantai-1', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak_buku`
--

CREATE TABLE `rak_buku` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rak_buku`
--

INSERT INTO `rak_buku` (`id`, `id_buku`, `id_rak`) VALUES
(8, 14, 2),
(11, 21, 7),
(12, 20, 6),
(15, 24, 6),
(16, 25, 5),
(18, 27, 8),
(19, 23, 6),
(20, 26, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) UNSIGNED NOT NULL,
  `id_peminjaman` int(11) UNSIGNED NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`, `foto`, `status`, `created_at`) VALUES
(1, 'shalis', 'shalis', 'shalis', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'admin', '1775925135_1c4fe27cc17702005d2e.jpg', 'aktif', '2026-04-11 04:29:04'),
(2, 'shatul', 'shatul', 'shatul', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'anggota', '1775925156_05e8f86175ed1e29324c.png', 'aktif', '2026-04-11 04:30:02'),
(3, 'khoeriah', 'khoeriah', 'khoeriah', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'petugas', '1775925184_4825e8b3176aed4dc82c.jpg', 'aktif', '2026-04-11 04:30:50'),
(5, 'nanda', 'shalis.shatul31@smk.belajar.id', 'nanda', '$2y$10$LJIB00OVcTMACmerQQaJOOusSxepHQgtBwRZxVbeJ5yItyDAXpo1i', 'admin', NULL, 'aktif', '2026-04-11 15:29:06'),
(6, 'iis sadiyah', 'iis.sadiyah7@smk.belajar.id', 'iscntqjelita', '$2y$10$RGMaL5G3s6uayuqjkJoU4uiWRoULhCdXd6HIztTZ7Jx.pT0Es2kqC', 'anggota', '1775927871_d049127176194eb8e8bc.jpg', 'aktif', '2026-04-11 17:17:51'),
(7, 'nanda', 'nanda@gmail.com', 'dede', '$2y$10$iuG.TrWT.zy0T8HtZeBCeukB0s/NUC6260fBGoTBLB12yBf51lt4a', 'anggota', '1776668836_2658f36bd2d9599ad1c1.jpg', 'aktif', '2026-04-20 07:07:17'),
(8, 'iis sadiyah', 'iis@gmail.com', 'iis', '$2y$10$Dpcd./kAQSi7kCB1/8bf3uI1HyTKLlXnFEFFSLuRj9y/iopO1C3Jm', 'anggota', '1776790396_5ee416f412a0ae6863e0.jpg', 'aktif', '2026-04-21 16:51:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penulis` (`id_penulis`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `id_pengembalian` (`id_pengembalian`);

--
-- Indeks untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_user_peminjaman` (`id`);

--
-- Indeks untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `fk_peminjaman` (`id_peminjaman`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`),
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`);

--
-- Ketidakleluasaan untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`id_pengembalian`) REFERENCES `pengembalian` (`id_pengembalian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_user_peminjaman` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `fk_peminjaman` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
