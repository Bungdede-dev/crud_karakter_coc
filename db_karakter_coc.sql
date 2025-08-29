-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Aug 2025
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_karakter_coc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karakter_coc`
--

CREATE TABLE `tb_karakter_coc` (
  `id_karakter` int(11) NOT NULL,
  `kode_karakter` varchar(15) NOT NULL,
  `nama_karakter` varchar(50) NOT NULL,
  `tipe` enum('Hero','Troop','Spell','Defense') NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_karakter_coc`
--

INSERT INTO `tb_karakter_coc` (`id_karakter`, `kode_karakter`, `nama_karakter`, `tipe`, `gambar`, `deskripsi`) VALUES
(1, 'C001', 'Archer', 'Troop', 'archer.jpg', 'Pasukan jarak jauh dengan damage sedang, memiliki HP rendah.'),
(2, 'C002', 'Archer Queen', 'Hero', 'archer_queen.jpg', 'Hero dengan serangan jarak jauh dan skill Royal Cloak.'),
(3, 'C003', 'Balloon', 'Troop', 'balloon.jpg', 'Pasukan udara yang menjatuhkan bom ke bangunan pertahanan.'),
(4, 'C004', 'Barbarian', 'Troop', 'barbarian.jpg', 'Pasukan dasar dengan damage sedang dan HP rendah.'),
(5, 'C005', 'Barbarian King', 'Hero', 'barbarian_king.jpg', 'Hero pertama di CoC dengan skill Iron Fist.'),
(6, 'C006', 'Battle Machine', 'Hero', 'battle_machine.jpg', 'Hero eksklusif di Builder Base dengan skill Electric Hammer.'),
(7, 'C007', 'Bowler', 'Troop', 'bowler.jpg', 'Pasukan darat yang melempar batu besar dengan damage area.'),
(8, 'C008', 'Goblin', 'Troop', 'goblin.jpg', 'Pasukan tercepat dengan damage tinggi khusus untuk resource building.'),
(9, 'C009', 'Golem', 'Troop', 'golem.jpg', 'Tank dengan HP sangat tinggi, meledak menjadi Golemites saat mati.'),
(10, 'C010', 'Lava Hound', 'Troop', 'lava_hound.jpg', 'Pasukan udara tanky yang menyerang Air Defense, pecah jadi Lava Pups.'),
(11, 'C011', 'Miner', 'Troop', 'miner.jpg', 'Pasukan unik yang menyerang dengan menggali bawah tanah.'),
(12, 'C012', 'P.E.K.K.A', 'Troop', 'pekka.jpg', 'Pasukan darat dengan damage besar dan armor kuat.'),
(13, 'C013', 'Sneaky Archer', 'Troop', 'sneaky_archer.jpg', 'Pasukan spesial di Builder Base dengan kemampuan menghilang sementara.'),
(14, 'C014', 'Valkyrie', 'Troop', 'valkyrie.jpg', 'Pasukan wanita dengan kapak ganda, serangan area putar.'),
(15, 'C015', 'Wall Breaker', 'Troop', 'wall_breaker.jpg', 'Pasukan pembawa bom yang meledakkan tembok musuh.'),
(16, 'C016', 'Wizard', 'Troop', 'wizard.jpg', 'Pasukan penyihir dengan serangan sihir jarak jauh dan damage besar.');

--
-- Indeks untuk tabel `tb_karakter_coc`
--
ALTER TABLE `tb_karakter_coc`
  ADD PRIMARY KEY (`id_karakter`);

--
-- AUTO_INCREMENT untuk tabel `tb_karakter_coc`
--
ALTER TABLE `tb_karakter_coc`
  MODIFY `id_karakter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
