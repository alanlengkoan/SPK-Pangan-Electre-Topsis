-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2019 pada 06.25
-- Versi server: 5.7.24
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_pangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternative` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternative`, `name`) VALUES
('1', 'Jagung'),
('2', 'Kedelai'),
('3', 'Ubi Jalar'),
('4', 'Kacang Hijau');

--
-- Trigger `tb_alternatif`
--
DELIMITER $$
CREATE TRIGGER `hapus_alternatif` BEFORE DELETE ON `tb_alternatif` FOR EACH ROW BEGIN
    DELETE FROM tb_evaluasi WHERE id_alternative = old.id_alternative;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_evaluasi`
--

CREATE TABLE `tb_evaluasi` (
  `id_alternative` smallint(5) UNSIGNED NOT NULL,
  `id_criteria` tinyint(3) UNSIGNED NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_evaluasi`
--

INSERT INTO `tb_evaluasi` (`id_alternative`, `id_criteria`, `value`) VALUES
(1, 1, 4),
(1, 2, 2),
(1, 3, 2),
(1, 4, 2),
(1, 5, 2),
(2, 1, 4),
(2, 2, 2),
(2, 3, 2),
(2, 4, 3),
(2, 5, 1),
(3, 1, 3),
(3, 2, 2),
(3, 3, 2),
(3, 4, 2),
(3, 5, 1),
(4, 1, 3),
(4, 2, 2),
(4, 3, 2),
(4, 4, 2),
(4, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_history`
--

CREATE TABLE `tb_history` (
  `id_history` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` text,
  `lokasi` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tgl_akses` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_history`
--

INSERT INTO `tb_history` (`id_history`, `nama`, `alamat`, `lokasi`, `bulan`, `tgl_akses`) VALUES
(4, 'asri', 'tets', 6, 2, '2019-09-11 12:12:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_criteria` tinyint(3) UNSIGNED NOT NULL,
  `criteria` varchar(100) DEFAULT NULL,
  `bulan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_criteria`, `criteria`, `bulan`) VALUES
(1, 'Jenis Tanah', NULL),
(2, 'Curah Hujan', '[{\"id_bulan\":\"1\",\"bulan\":\"Januari\",\"value\":\"250\"},{\"id_bulan\":\"2\",\"bulan\":\"Februari\",\"value\":\"220\"},{\"id_bulan\":\"3\",\"bulan\":\"Maret\",\"value\":\"178\"},{\"id_bulan\":\"4\",\"bulan\":\"April\",\"value\":\"240\"},{\"id_bulan\":\"5\",\"bulan\":\"Mei\",\"value\":\"200\"},{\"id_bulan\":\"6\",\"bulan\":\"Juni\",\"value\":\"220\"},{\"id_bulan\":\"7\",\"bulan\":\"Juli\",\"value\":\"245\"},{\"id_bulan\":\"8\",\"bulan\":\"Agustus\",\"value\":\"245\"},{\"id_bulan\":\"9\",\"bulan\":\"September\",\"value\":\"230\"},{\"id_bulan\":\"10\",\"bulan\":\"Oktober\",\"value\":\"200\"},{\"id_bulan\":\"11\",\"bulan\":\"November\",\"value\":\"210\"},{\"id_bulan\":\"12\",\"bulan\":\"Desember\",\"value\":\"222\"}]'),
(3, 'Drainase', NULL),
(4, 'pH', NULL),
(5, 'Ketinggian Tempat', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria_lokasi`
--

CREATE TABLE `tb_kriteria_lokasi` (
  `id_kriteria` int(255) NOT NULL,
  `id_lokasi` int(255) DEFAULT NULL,
  `kriteria` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria_lokasi`
--

INSERT INTO `tb_kriteria_lokasi` (`id_kriteria`, `id_lokasi`, `kriteria`) VALUES
(23, 4, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"1\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"5\":\"200\",\"6\":\"220\",\"7\":\"245\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"1\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"3\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"2\"}]'),
(24, 5, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"4\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"1\":\"250\",\"2\":\"220\",\"3\":\"178\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"2\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]'),
(25, 6, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"4\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"2\":\"220\",\"3\":\"178\",\"4\":\"240\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"2\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]'),
(26, 7, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"2\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"6\":\"220\",\"7\":\"245\",\"8\":\"245\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"3\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]'),
(27, 8, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"3\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"4\":\"240\",\"5\":\"200\",\"6\":\"220\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"1\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]'),
(28, 9, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"4\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"10\":\"200\",\"11\":\"210\",\"12\":\"222\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"4\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]'),
(29, 10, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"2\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":2,\"data_bulan\":{\"3\":\"178\",\"4\":\"240\",\"5\":\"200\"},\"ket\":\"Menengah (200-300 mm/bulan)\"},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"2\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]'),
(30, 11, '[{\"id_kriteria\":\"1\",\"kriteria\":\"Jenis Tanah\",\"weight\":\"4\"},{\"id_kriteria\":\"2\",\"kriteria\":\"Curah Hujan\",\"weight\":null,\"data_bulan\":{\"12\":\"222\",\"13\":null,\"14\":null},\"ket\":null},{\"id_kriteria\":\"3\",\"kriteria\":\"Drainase\",\"weight\":\"2\"},{\"id_kriteria\":\"4\",\"kriteria\":\"pH\",\"weight\":\"2\"},{\"id_kriteria\":\"5\",\"kriteria\":\"Ketinggian Tempat\",\"weight\":\"1\"}]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(5, 'Desa Bumiayu'),
(6, 'Desa Sumberjo'),
(7, 'Desa Sugihwaras'),
(8, 'Desa Banua Baru'),
(9, 'Desa Sidorejo'),
(10, 'Desa Bumimulyo'),
(11, 'Desa Kebun Sari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ranking`
--

CREATE TABLE `tb_ranking` (
  `id_ranking` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `hasil_electre` text NOT NULL,
  `hasil_topsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ranking`
--

INSERT INTO `tb_ranking` (`id_ranking`, `id_lokasi`, `hasil_electre`, `hasil_topsis`) VALUES
(0, 5, '{\"1\":1,\"2\":1,\"3\":0,\"4\":0}', '{\"2\":0.6540672953078929,\"1\":0.6090717558372857,\"3\":0,\"4\":0}'),
(0, 6, '{\"1\":1,\"2\":1,\"3\":0,\"4\":0}', '{\"2\":0.6540672953078929,\"1\":0.6090717558372857,\"3\":0,\"4\":0}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', '$2y$10$8zWX9pN/1wDgkFG7BvDslOJjGm3V58PCkasCvaPu1//E9ndv/C9L6', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
