-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 03:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'Indah Nilam Sari', 'indah@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `perihal` text NOT NULL,
  `tgl_kirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor_surat`, `tanggal_surat`, `penerima`, `perihal`, `tgl_kirim`) VALUES
(9, 'PLN/2024/001', '2024-06-20', 'Bagian Kepegawaian', 'Undangan Rapat', '2024-06-21'),
(10, 'PLN/2024/002', '2024-06-21', 'Direktur Utama', 'Laporan Keuangan', '2024-06-20'),
(11, 'PLN/2024/003', '2024-06-22', 'Kepala Divisi Pemasaran', 'Proposal Penjualan', '2024-06-23'),
(12, 'PLN/2024/004', '2024-06-23', 'Bagian Teknik', 'Permintaan Peralatan', '2024-06-24'),
(13, 'PLN/2024/005', '2024-06-24', 'Bagian Sumber Daya Manusia', 'Pengumuman Rekrutmen', '2024-06-25'),
(14, 'PLN/2024/006', '2024-06-25', 'Bagian Keuangan', 'Pembayaran Tagihan', '2024-06-26'),
(15, 'PLN/2024/007', '2024-06-26', 'Bagian Legal', 'Kontrak Kerjasama', '2024-06-27'),
(16, 'PLN/2024/008', '2024-06-27', 'Bagian Produksi', 'Jadwal Produksi Bulan Depan', '2024-06-28'),
(17, 'PLN/2024/009', '2024-06-28', 'Bagian IT', 'Pemeliharaan Sistem', '2024-06-29'),
(18, 'PLN/2024/010', '2024-06-29', 'Bagian Penjualan', 'Laporan Penjualan Triwulan', '2024-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `perihal` text DEFAULT NULL,
  `tgl_terima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal_surat`, `pengirim`, `perihal`, `tgl_terima`) VALUES
(30, 'SM/2024/001', '2024-06-20', 'PT. ABC Indonesia', 'Undangan Rapat', '2024-06-21'),
(31, 'SM/2024/002', '2024-06-21', 'CV. XYZ Teknik', 'Pembahasan Proyek Baru', '2024-06-20'),
(32, 'SM/2024/003', '2024-06-22', 'PT. PQR Mandiri', 'Pengajuan Cuti', '2024-06-23'),
(33, 'SM/2024/004', '2024-06-23', 'Perusahaan Jaya Abadi', 'Permintaan Penawaran', '2024-06-24'),
(34, 'SM/2024/005', '2024-06-24', 'PT. Sejahtera Sentosa', 'Surat Keterangan', '2024-06-25'),
(35, 'SM/2024/006', '2024-06-25', 'CV. Berkah Jaya', 'Laporan Bulanan', '2024-06-26'),
(36, 'SM/2024/007', '2024-06-26', 'PT. Cahaya Baru', 'Permohonan Izin', '2024-06-27'),
(37, 'SM/2024/008', '2024-06-27', 'PT. Maju Jaya Abadi', 'Pengumuman Internal', '2024-06-28'),
(38, 'SM/2024/009', '2024-06-28', 'CV. Teknologi Mandiri', 'Penawaran Kerjasama', '2024-06-29'),
(39, 'SM/2024/010', '2024-06-29', 'PT. Bumi Makmur Sentosa', 'Proposal Proyek', '2024-06-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
