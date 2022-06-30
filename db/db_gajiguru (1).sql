-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2021 pada 03.07
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gajiguru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `email` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`email`, `password`, `role`) VALUES
('bendahara@gmail.com', '202cb962ac59075b964b07152d234b70', 3),
('Desprayoga@gmail.com', '84eb13cfed01764d9c401219faa56d53', 4),
('enny@gmail.com', '11364907cf269dd2183b64287156072a', 4),
('fatimah@gmail.com', '568628e0d993b1973adc718237da6e93', 4),
('kurikulum@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
('Mardiana@gmail.com', 'ce08becc73195df12d99d761bfbba68d', 4),
('Margareta@gmail.com', 'dc5e819e186f11ef3f59e6c7d6830c35', 4),
('martha@gmail.com', 'dc5c7986daef50c1e02ab09b442ee34f', 4),
('MuhammadIdris@gmail.com', '9e94b15ed312fa42232fd87a55db0d39', 4),
('operator@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
('Parmawati@gmail.com', 'e88a49bccde359f0cabb40db83ba6080', 4),
('shirly@gmail.com', '95b09698fda1f64af16708ffb859eab9', 4),
('soleha@gmail.com', '336d5ebc5436534e61d16e63ddfca327', 4),
('Sukmadiyati@gmail.com', 'a13ee062eff9d7295bfc800a11f33704', 4),
('Syarnubi@gmail.com', 'ea20a043c08f5168d4409ff4144f32e2', 4),
('Zulkifli@gmail.com', '93dd4de5cddba2c733c65f233097f05a', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_laporan`
--

CREATE TABLE `detail_laporan` (
  `id` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `jam_mengajar` decimal(13,2) DEFAULT 0.00,
  `transport` decimal(13,2) DEFAULT 0.00,
  `gaji_pokok` decimal(13,2) DEFAULT 0.00,
  `wali_kelas` decimal(13,2) DEFAULT 0.00,
  `piket` decimal(13,2) DEFAULT 0.00,
  `bon` decimal(13,2) DEFAULT 0.00,
  `koprasi_sekolah` decimal(13,2) DEFAULT 0.00,
  `uang_amal` decimal(13,2) DEFAULT 0.00,
  `koprasi_yplp` decimal(13,2) DEFAULT 0.00,
  `iuran_pgri` decimal(13,2) DEFAULT 0.00,
  `total` decimal(13,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_laporan`
--

INSERT INTO `detail_laporan` (`id`, `id_laporan`, `nip`, `jam_mengajar`, `transport`, `gaji_pokok`, `wali_kelas`, `piket`, `bon`, `koprasi_sekolah`, `uang_amal`, `koprasi_yplp`, `iuran_pgri`, `total`) VALUES
(20, 7, '0004', '50000.00', '25000.00', '750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '20000.00', '805000.00'),
(21, 7, '002', '225000.00', '49999.00', '1850000.00', '0.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '40000.00', '2105000.00'),
(22, 7, '005', '50000.00', '25000.00', '1835000.00', '0.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '40000.00', '1890000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_pegawai`
--

CREATE TABLE `guru_pegawai` (
  `nip` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `tmpt_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(20) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru_pegawai`
--

INSERT INTO `guru_pegawai` (`nip`, `email`, `nama`, `alamat`, `tmpt_lahir`, `tgl_lahir`, `jk`, `telp`, `id_jabatan`, `status`) VALUES
('-', 'soleha@gmail.com', 'soleha', 'jalan sama', 'palembang', '2021-05-07', 'Perempuan', '0845121448', 11, 1),
('0004', 'shirly@gmail.com', 'shirly', 'jalan', 'palembang', '2021-05-05', 'Perempuan', '0845121448', 12, 1),
('001', 'martha@gmail.com', 'Martha Chandralela,S.Pd,M.Si', 'jalan harapan', 'palembang', '2021-05-01', 'Perempuan', '0845121448', 1, 1),
('002', 'Zulkifli@gmail.com', 'zulkifli,S.Pd', 'jalan kemenangan', 'palembang', '2021-05-10', 'Laki - Laki', '0812365485', 2, 1),
('003', 'Parmawati@gmail.com', 'Parmawati,S.pd', 'jalan kenagan', 'palembang', '2021-05-14', 'Perempuan', '0711258123', 3, 1),
('004', 'enny@gmail.com', 'Enny eryani,S.Pd', 'jalan lama', 'palembang', '2021-05-18', 'Perempuan', '0711258123', 4, 1),
('005', 'Mardiana@gmail.com', 'Mardiana,S.pd', 'jalan ujung', 'palembang', '2021-05-11', 'Perempuan', '0845121448', 5, 1),
('006', 'fatimah@gmail.com', 'Fatimah,S.Pd', 'jalan perjuanagan', 'palembang', '2021-05-12', 'Perempuan', '0845121448', 6, 1),
('007', 'MuhammadIdris@gmail.com', 'Muhammad Idris,S.pd', 'jalan kemarin', 'palembang', '2021-05-03', 'Laki - Laki', '0845121448', 0, 1),
('008', 'Sukmadiyati@gmail.com', 'Sukmadiyati,S.pd', 'jalan operasional', 'palembang', '2021-05-08', 'Laki - Laki', '0711258123', 0, 1),
('009', 'Margareta@gmail.com', 'Margareta,S.pd', 'jalan pagi', 'palembang', '2021-05-16', 'Perempuan', '0812365485', 0, 1),
('010', 'Syarnubi@gmail.com', 'Syarnubi', 'jalan ku', 'palembang', '2021-05-05', 'Laki - Laki', '0711258123', 7, 1),
('011', 'Desprayoga@gmail.com', 'Desprayoga,M.pd', 'jalan siang', 'palembang', '2021-05-11', 'Laki - Laki', '0845121448', 12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(35) NOT NULL,
  `gaji` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji`) VALUES
(0, 'Guru/Guru Honerer', 0),
(1, 'Kepala Sekolah', 40000),
(2, 'Wakil kurikulum', 1850000),
(3, 'wakil kesiswaan', 1845000),
(4, 'wakil sarana dan prasarana', 1840000),
(5, 'wakil humas', 1835000),
(6, 'bendahara', 1820000),
(7, 'kepala TU', 750000),
(8, 'operator sekolah', 1600000),
(9, 'pengelola labor', 400000),
(10, 'Pengelola Perpus', 500000),
(11, 'pegawai bersih-bersih', 700000),
(12, 'pegawai', 750000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_mengajar`
--

CREATE TABLE `jam_mengajar` (
  `id` int(11) NOT NULL,
  `tgl_mengajar` date NOT NULL,
  `nip` varchar(25) NOT NULL,
  `lama_mengajar` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jam_mengajar`
--

INSERT INTO `jam_mengajar` (`id`, `tgl_mengajar`, `nip`, `lama_mengajar`) VALUES
(16, '2021-05-27', '002', 5),
(17, '2021-05-27', '003', 3),
(18, '2021-05-27', '004', 4),
(19, '2021-05-27', '005', 2),
(20, '2021-05-27', '006', 4),
(21, '2021-05-27', '009', 2),
(22, '2021-05-28', '0004', 2),
(23, '2021-05-28', '002', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(2) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `bulan`, `tahun`, `tgl_buat`, `status`) VALUES
(7, 5, 2021, '2021-05-27 17:14:47', 1),
(8, 6, 2021, '2021-05-28 06:17:50', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `piket`
--

CREATE TABLE `piket` (
  `id_piket` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `hari_piket` varchar(59) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `piket`
--

INSERT INTO `piket` (`id_piket`, `nip`, `hari_piket`, `keterangan`) VALUES
(11, '002', 'senin', 'piket siang'),
(12, '004', 'senin', 'piket pagi'),
(13, '005', 'selasa', 'piket sore'),
(14, '010', 'selasa', 'piket siang'),
(15, '003', 'senin', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan`
--

CREATE TABLE `potongan` (
  `id_potongan` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `jenis` varchar(40) NOT NULL,
  `tgl` date NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `potongan`
--

INSERT INTO `potongan` (`id_potongan`, `nip`, `jenis`, `tgl`, `nominal`, `keterangan`) VALUES
(23, '003', 'Bon', '2021-05-27', '50000', NULL),
(24, '003', 'Koprasi Sekolah', '2021-05-27', '50000', NULL),
(25, '003', 'Uang Amal', '2021-05-27', '20000', NULL),
(26, '-', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(27, '001', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(28, '002', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(29, '003', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(30, '004', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(31, '005', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(32, '006', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(33, '007', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(34, '008', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(35, '009', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(36, '010', 'Iuaran PGRI', '2021-05-27', '20000', NULL),
(37, '-', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(38, '0004', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(39, '001', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(40, '002', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(41, '003', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(42, '004', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(43, '005', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(44, '006', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(45, '007', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(46, '008', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(47, '009', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(48, '010', 'Iuaran PGRI', '2021-05-28', '20000', NULL),
(49, '011', 'Iuaran PGRI', '2021-05-28', '20000', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wali_kelas`
--

INSERT INTO `wali_kelas` (`id`, `nip`, `kelas`, `keterangan`) VALUES
(6, '003', '9.1', ''),
(7, '009', '9.2', ''),
(8, '007', '9.3', ''),
(9, '008', '9.4', ''),
(10, '011', '9.5', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `detail_laporan`
--
ALTER TABLE `detail_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `guru_pegawai`
--
ALTER TABLE `guru_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jam_mengajar`
--
ALTER TABLE `jam_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jam_nip` (`nip`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `piket`
--
ALTER TABLE `piket`
  ADD PRIMARY KEY (`id_piket`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`id_potongan`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_laporan`
--
ALTER TABLE `detail_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `jam_mengajar`
--
ALTER TABLE `jam_mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `piket`
--
ALTER TABLE `piket`
  MODIFY `id_piket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `potongan`
--
ALTER TABLE `potongan`
  MODIFY `id_potongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_laporan`
--
ALTER TABLE `detail_laporan`
  ADD CONSTRAINT `detail_laporan_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `guru_pegawai`
--
ALTER TABLE `guru_pegawai`
  ADD CONSTRAINT `fk_gurupegawai_email` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_gurupegawai_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jam_mengajar`
--
ALTER TABLE `jam_mengajar`
  ADD CONSTRAINT `fk_jam_nip` FOREIGN KEY (`nip`) REFERENCES `guru_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `piket`
--
ALTER TABLE `piket`
  ADD CONSTRAINT `fk_piket_nip` FOREIGN KEY (`nip`) REFERENCES `guru_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `potongan`
--
ALTER TABLE `potongan`
  ADD CONSTRAINT `fk_potongan_nip` FOREIGN KEY (`nip`) REFERENCES `guru_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD CONSTRAINT `fk_wk_nip` FOREIGN KEY (`nip`) REFERENCES `guru_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
