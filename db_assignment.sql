-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jun 2023 pada 02.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_assignment`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_blokir`
--

CREATE TABLE `tb_blokir` (
  `id` int(11) NOT NULL,
  `id_pengguna` varchar(20) NOT NULL,
  `kd_projek` varchar(20) NOT NULL,
  `alasan` text NOT NULL,
  `blokir_by` varchar(50) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_blokir`
--

INSERT INTO `tb_blokir` (`id`, `id_pengguna`, `kd_projek`, `alasan`, `blokir_by`, `created_at`) VALUES
(15, '51', '4338jc', 'test\r\n', 'Nadia Shivana', '2023-06-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chat`
--

CREATE TABLE `tb_chat` (
  `id` int(11) NOT NULL,
  `chat` text NOT NULL,
  `id_pengguna` varchar(20) NOT NULL,
  `time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlpn` varchar(20) NOT NULL,
  `level` enum('Member','Leader','Administrator') NOT NULL,
  `logo` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `kd_projek` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `nama`, `username`, `password`, `email`, `tlpn`, `level`, `logo`, `status`, `kd_projek`, `created_at`, `update_at`) VALUES
(51, 'Nadia Shivana', 'admin', '123', 'nadiacantikk496@gmail.com', '082338928025', 'Administrator', 'profil1687653368.jpeg', 1, '0', '2023-06-23 14:25:29', '2023-06-25 19:00:06'),
(52, 'M.AMIRUL FAHMI', 'amirulfahmi148@gmail.com', '123', 'amirulfahmi148@gmail.com', '082338928025', 'Administrator', 'profil1687708399.jpeg', 1, '0361th', '2023-06-23 14:31:21', '2023-06-25 22:53:19'),
(56, 'amirul fahmi', 'amirul', '123', 'ujicoba@gmail.com', '082336959582', 'Leader', 'new-default.png', 1, '0361th', '2023-06-26 01:59:41', '2023-06-26 21:16:30'),
(57, 'Ramadhani', 'amfa', '123', 'fagnjsjh@gmail.com', '082336959582', 'Leader', 'new-default.png', 1, '0361th', '2023-06-26 08:12:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_projek`
--

CREATE TABLE `tb_projek` (
  `kode_projek` char(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `token_projek` char(6) NOT NULL,
  `progress_projek` int(5) NOT NULL,
  `target_selesai` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `created_at` date DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_projek`
--

INSERT INTO `tb_projek` (`kode_projek`, `nama`, `deskripsi`, `token_projek`, `progress_projek`, `target_selesai`, `status`, `created_by`, `created_at`, `update_at`) VALUES
('0361th', 'MANUFAKTUR', 'Website pengelolaan data desa', 'YRKIYK', 10, '2023-12-21', 1, '51', '2023-06-23', '2023-06-24 18:58:13'),
('4338jc', 'FahmiCode', 'Semangat Mengerjakan Tugas ini', 'SMT99U', 0, '2023-11-14', 1, '51', '2023-06-23', NULL),
('4753Vt', 'AMFATREKTURE', 'Aplikasi Pesanan Orang Malaysia', 'TGL47N', 41, '2025-06-24', 1, '51', '2023-06-23', '2023-06-24 18:48:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_task`
--

CREATE TABLE `tb_task` (
  `id_task` char(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hari` varchar(25) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('To Do','Planing','Development','Done') NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `penugasan` int(6) NOT NULL,
  `id_projek` int(6) NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_blokir`
--
ALTER TABLE `tb_blokir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `token_projek` (`kd_projek`);

--
-- Indeks untuk tabel `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_projek` (`kd_projek`);

--
-- Indeks untuk tabel `tb_projek`
--
ALTER TABLE `tb_projek`
  ADD PRIMARY KEY (`kode_projek`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `penugasan` (`penugasan`),
  ADD KEY `id_projek` (`id_projek`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_blokir`
--
ALTER TABLE `tb_blokir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
