-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2026 pada 12.54
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
(22, '30082008', 'pulang', 1, 4, 10, '2023', 10, 9, ': Menceritakan petualangan Bujang, seorang anak rimba Sumatra yang memiliki keberanian luar biasa dan direkrut oleh Tauke Besar ke kota. Ia dididik menjadi sosok yang pintar dan ahli bertarung hingga menjadi orang kepercayaan dalam keluarga penguasa shadow economy. Fokus ceritanya adalah perjuangan Bujang menghadapi masa lalu dan arti \"pulang\" ke jati diri yang sebenarnya. ', '1776668120_384f1f71c6bd2db5ac0f.webp'),
(23, '3008203', 'bandung after rain', 1, 4, 20, '2014', 52, 32, 'Novel romansa setebal 282 halaman ini menceritakan kisah Hemachandra (Hema) yang penuh penyesalan setelah hubungannya dengan Rania (Ra) berakhir tepat sebulan sebelum hari jadi mereka yang ke-7. Berlatar di Kota Bandung yang melankolis, cerita ini mengeksplorasi tema kehilangan, jati diri, dan proses memahami arti cinta yang sesungguhnya.', '1776668210_bde0a5d41e47876bc997.jpg'),
(25, '	6026064060', 'PISIKOTES TNI POLRI', 10, 17, 21, '2026', 15, 12, 'buku tes pisikotes terbaru tahun ini', '1776700159_7f0cffaa7c44bd31a438.png'),
(26, '978-602-5710-55-1', 'TOP No. 1 TKA (Tes Kemampuan Akademik) SMA/MA IPA 2025/2026', 11, 19, 22, '2025', 10, 10, 'Menggunakan metode pembelajaran bertahap, dilengkapi ringkasan materi padat serta ribuan soal drilling (latihan) beserta kunci jawaban dan pembahasan mendalam.', '1776700667_ebd797e21fe34e129d5e.avif'),
(27, ' 978-623-8618-01-9', 'Buku Paten UTBK SNBT TPS 2025 (Tes Potensi Skolastik) Update Terbaru', 12, 20, 23, '2024', 20, 16, 'Buku ini berfokus pada 7 subtes TPS. Dilengkapi dengan Field Report (FR) soal asli 2023-2024, paket drilling soal, prediksi SNBT, bonus simulasi android, dan video bedah soal. Sangat cocok untuk penguatan dasar.', '1776701073_d806b1acbf5524194603.png');

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
(139, 161, 26, 1),
(140, 162, 23, 1),
(141, 163, 25, 1),
(142, 164, 23, 1),
(143, 165, 25, 1),
(144, 166, 27, 1),
(145, 167, 25, 1),
(146, 168, 23, 1),
(147, 169, 25, 1),
(148, 170, 23, 1),
(149, 171, 25, 1),
(150, 172, 22, 1),
(151, 173, 23, 1),
(152, 174, 23, 1),
(153, 175, 25, 1),
(154, 176, 23, 1),
(155, 177, 25, 1),
(156, 178, 23, 1),
(157, 179, 23, 1),
(158, 181, 23, 1),
(159, 182, 28, 1),
(160, 183, 22, 1),
(161, 184, 22, 1),
(162, 185, 23, 1),
(163, 186, 23, 1),
(164, 187, 25, 1),
(165, 188, 23, 1),
(166, 189, 23, 1),
(167, 190, 22, 1),
(168, 191, 28, 1),
(169, 192, 23, 1),
(170, 193, 23, 1),
(171, 194, 23, 1),
(172, 195, 23, 1),
(173, 196, 23, 1),
(174, 197, 23, 1),
(175, 198, 23, 1),
(176, 199, 23, 1),
(177, 200, 23, 1),
(178, 201, 25, 1),
(179, 202, 22, 1),
(180, 203, 23, 1),
(181, 204, 25, 1),
(182, 205, 23, 1),
(183, 205, 27, 1),
(184, 206, 25, 1),
(185, 207, 23, 1),
(186, 207, 27, 1),
(187, 208, 25, 1),
(188, 209, 23, 1),
(189, 210, 23, 1);

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
  `metode` enum('ambil','antar') DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `id`, `metode`, `petugas_id`) VALUES
(205, '2026-04-28', '2026-05-03', 'dipinjam', 8, 'ambil', 3),
(206, '2026-04-28', '2026-05-03', 'dipinjam', 8, 'ambil', 3),
(207, '2026-04-28', '2026-05-03', 'dipinjam', 7, 'ambil', 3),
(208, '2026-04-28', '2026-05-03', 'dikembalikan', 7, 'antar', NULL),
(209, '2026-04-28', '2026-05-03', 'dipinjam', 7, 'antar', NULL),
(210, '2026-04-28', '2026-05-03', 'dipinjam', 7, 'ambil', 3);

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
  `petugas_id` int(11) DEFAULT NULL,
  `ongkir` int(11) DEFAULT 0,
  `status_bayar` enum('belum','dibayar') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penarikan`
--

INSERT INTO `penarikan` (`id_penarikan`, `id_peminjaman`, `alamat`, `biaya`, `status`, `tanggal_ambil`, `petugas_id`, `ongkir`, `status_bayar`) VALUES
(13, 201, 'sumedang', 10000.00, 'selesai', '2026-04-28', 3, 0, 'belum'),
(15, 204, 'sumedang', 10000.00, 'selesai', '2026-04-28', 3, 0, 'belum'),
(16, 208, 'talun', 10000.00, 'selesai', '2026-04-28', 3, 0, 'belum'),
(17, 209, 'sumedang', 10000.00, 'menunggu', NULL, NULL, 0, 'belum');

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
(10, 'wisyouall', '', 0),
(13, 'cv.yy', '', 1),
(14, 'dgvdjkvd', '', 1),
(15, 'gg', '', 1),
(16, 'shalis', 'sumedang', 1),
(17, 'cv.guee', 'subang', 1),
(18, 'cv.guee', 'subang', 1),
(19, 'pt.calon', '', 1),
(20, 'granmedia.bandung', '', 1),
(21, 'forum edukasi', '', 1),
(22, 'granmedia', '', 1),
(23, 'Tim Tentor Paten', '', 1),
(24, 'bukune', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) UNSIGNED NOT NULL,
  `id_peminjaman` int(11) UNSIGNED DEFAULT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `denda` decimal(10,2) NOT NULL,
  `status_denda` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tanggal_dikembalikan`, `denda`, `status_denda`) VALUES
(66, 208, '2026-04-29', 0.00, 'belum_bayar'),
(67, 208, '2026-04-28', 0.00, 'belum_bayar');

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
  `id` int(11) DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_peminjaman`, `alamat`, `biaya`, `status`, `tanggal_kirim`, `id`, `petugas_id`) VALUES
(1, 86, 'cikaramas', 10000.00, 'sampai', '2026-04-20', 3, NULL),
(2, 87, 'tanjungmedar', 10000.00, 'menunggu', NULL, NULL, NULL),
(3, 88, 'tanjungmedar', 10000.00, 'sampai', '2026-04-20', 3, NULL),
(4, 91, 'sembir', 10000.00, 'sampai', '2026-04-20', 3, NULL),
(5, 138, 'bogor', 10000.00, 'dikirim', '2026-04-21', NULL, NULL),
(6, 139, 'jogja', 10000.00, 'sampai', '2026-04-21', NULL, NULL),
(7, 140, 'padasuka', 10000.00, 'sampai', '2026-04-22', NULL, NULL),
(8, 142, 'bogor', 10000.00, 'menunggu', NULL, NULL, NULL),
(9, 143, 'jogja', 10000.00, 'sampai', '2026-04-22', NULL, NULL),
(10, 144, 'surga', 10000.00, 'sampai', '2026-04-22', NULL, NULL),
(11, 145, 'bogor', 10000.00, 'sampai', '2026-04-22', NULL, NULL),
(12, 146, 'cci', 10000.00, 'sampai', '2026-04-22', NULL, NULL),
(13, 150, 'bogor', 10000.00, 'menunggu', NULL, NULL, NULL),
(14, 151, 'bogor', 10000.00, 'sampai', '2026-04-24', NULL, NULL),
(15, 152, 'sumedang', 10000.00, 'dikirim', '2026-04-24', NULL, NULL),
(16, 153, 'cimanggung', 10000.00, 'dikirim', '2026-04-24', NULL, NULL),
(17, 154, 'sembir', 10000.00, 'sampai', '2026-04-24', NULL, NULL),
(18, 159, 'bogor', 10000.00, 'sampai', '2026-04-24', NULL, NULL),
(19, 162, 'sumedang', 10000.00, 'sampai', '2026-04-25', 3, NULL),
(20, 165, 'cikaramas', 10000.00, 'menunggu', NULL, NULL, NULL),
(21, 168, 'cimanggung', 10000.00, 'sampai', '2026-04-25', 3, NULL),
(22, 173, 'tanjungmedar', 10000.00, 'sampai', '2026-04-25', 3, NULL),
(23, 174, 'bogor', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(24, 175, 'padasuka', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(25, 177, 'sumedang', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(26, 178, 'wetan', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(27, 179, 'sumedang', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(28, 180, 'cikaraas', 10000.00, 'menunggu', NULL, NULL, NULL),
(29, 181, 'cikaraas', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(30, 183, 'tanjungsari', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(31, 184, 'sembir', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(32, 186, 'alun alun', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(33, 187, 'padasuka', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(34, 188, 'ciwangsa', 10000.00, 'menunggu', NULL, NULL, NULL),
(35, 189, 'ciwangsa', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(36, 190, 'cirawang', 10000.00, 'menunggu', NULL, NULL, NULL),
(37, 191, 'cirawang\r\n', 10000.00, 'menunggu', NULL, NULL, NULL),
(38, 198, 'ciakar', 10000.00, 'sampai', '2026-04-25', NULL, 3),
(39, 199, 'sumedang', 10000.00, 'sampai', '2026-04-28', NULL, 3),
(40, 200, 'sumedang', 10000.00, 'sampai', '2026-04-28', NULL, 3),
(41, 201, 'sumedang', 10000.00, 'sampai', '2026-04-28', NULL, 3),
(42, 202, 'sumedang', 10000.00, 'sampai', '2026-04-28', NULL, 3),
(43, 204, 'sumedang', 10000.00, 'sampai', '2026-04-28', NULL, 3),
(44, 208, 'talun', 10000.00, 'sampai', '2026-04-28', NULL, 3),
(45, 209, 'sumedang', 10000.00, 'sampai', '2026-04-28', NULL, 3);

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
(1, 'ute', 1),
(3, 'cc', 1),
(4, 'shalis', 1),
(5, 'gg', 1),
(6, '55', 1),
(7, '11', 1),
(8, 'pp', 1),
(9, 'shalis', 1),
(10, 'awan', 1),
(11, 'cc', 1),
(12, 'shalis', 1),
(13, 'jaka', 1),
(15, 'shalis', 1),
(17, 'karlina S.Hi', 0),
(18, 'shalis', 0),
(19, 'Nada Salsabila, S.Pd.', 0),
(20, 'Tim Tentor Paten', 0),
(21, 'tere liye', 0),
(22, 'vania winola', 0),
(23, 'siti', 1);

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
(5, '200-250', 'lantai 1', 0),
(6, '001-100 ', 'lantai 3', 0),
(8, '100-200', 'lantai 3', 0),
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
(24, 28, 5),
(25, 27, 9),
(26, 23, 5),
(27, 26, 6),
(29, 25, 6),
(31, 22, 5),
(32, 29, 5);

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
  `status` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar',
  `bukti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_peminjaman`, `jenis`, `jumlah`, `tanggal`, `status`, `bukti`) VALUES
(40, 208, 'pengiriman', 10000.00, '2026-04-28 10:31:57', 'sudah_bayar', NULL),
(41, 209, 'pengiriman', 10000.00, '2026-04-28 10:35:55', 'sudah_bayar', NULL);

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
(2, 'shatul', 'shatu@gmail.com', 'shatul', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'anggota', '1775925156_05e8f86175ed1e29324c.png', 'aktif', '2026-04-11 04:30:02'),
(3, 'khoeriah', 'khoeriah', 'khoeriah', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'petugas', '1775925184_4825e8b3176aed4dc82c.jpg', 'aktif', '2026-04-11 04:30:50'),
(6, 'iis sadiyah', 'iis.sadiyah7@smk.belajar.id', 'iis', '$2y$10$RGMaL5G3s6uayuqjkJoU4uiWRoULhCdXd6HIztTZ7Jx.pT0Es2kqC', 'petugas', '1775927871_d049127176194eb8e8bc.jpg', 'aktif', '2026-04-11 17:17:51'),
(7, 'nanda', 'nanda@gmail.com', 'dede', '$2y$10$pqwVdWw7VP41v7nhCbOfL.VRtazWvXMZN0WOYeJsGCD.HyYppRwCS', 'anggota', '1776668836_2658f36bd2d9599ad1c1.jpg', 'aktif', '2026-04-20 07:07:17'),
(8, 'karisa wulan', 'karisa@gmail.com', 'karisa', '$2y$10$aYMq7S0EwoHzXT4SjTGR/.TZRdljC6bIu..IndQPwadUF8uLSf24y', 'anggota', '1777367189_a0125405d4c7406838c7.png', 'aktif', '2026-04-21 16:51:31');

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
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

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
  MODIFY `id_peminjaman` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
