-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Jul 2018 pada 21.28
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recycle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `extensi` varchar(4) NOT NULL,
  `aktif` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `extensi`, `aktif`) VALUES
(1, 'Pakaian', '.jpg', '1'),
(2, 'Elektronik', '.jpg', '1'),
(3, 'Buku', '.jpg', '1'),
(4, 'Aksesoris', '.jpg', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pem` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `tgl_pem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal` int(11) NOT NULL,
  `jenis_paket` varchar(11) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `status` int(11) NOT NULL,
  `metode` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pem`, `id_produk`, `id_users`, `tgl_pem`, `subtotal`, `jenis_paket`, `harga_paket`, `catatan`, `status`, `metode`) VALUES
(7, 14, 7, '2018-07-01 17:49:28', 57000, 'OKE', 55000, 'HItam', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppc`
--

CREATE TABLE `ppc` (
  `id_ppc` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `ip_address` varchar(12) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ppc`
--

INSERT INTO `ppc` (`id_ppc`, `id_produk`, `ip_address`, `tgl`) VALUES
(14, 19, '::1', '2018-07-06 19:23:43'),
(15, 15, '::1', '2018-07-06 19:23:49'),
(16, 16, '::1', '2018-07-06 19:27:08'),
(17, 14, '::1', '2018-07-06 19:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint(20) NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `kondisi` tinyint(4) NOT NULL,
  `extensi` varchar(10) NOT NULL,
  `iklan` tinyint(4) NOT NULL DEFAULT '0',
  `aktif` enum('1','0') NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_users`, `nama`, `deskripsi`, `harga`, `kondisi`, `extensi`, `iklan`, `aktif`, `status`) VALUES
(14, 1, 3, 'Bambang', 'asd', 2000, 0, '.png', 0, '1', 0),
(15, 1, 3, 'Juki', 'sdad', 22222, 0, '.png', 0, '1', 0),
(16, 1, 3, 'asdasdasd', 'sssssss', 2147483647, 0, '.png', 0, '1', 0),
(17, 1, 3, 'zxc', '2asdasd', 2343043, 0, '.jpg', 0, '1', 0),
(18, 1, 3, 'test', '5121', 12212, 0, '.png', 0, '1', 0),
(19, 1, 3, 'asdasdasd', 'm,m,m,m,', 200000, 0, '.jpg', 0, '1', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `topup`
--

CREATE TABLE `topup` (
  `id_topup` bigint(20) NOT NULL,
  `id_users` int(11) NOT NULL,
  `keterangan` text,
  `jumlah` int(11) NOT NULL,
  `extensi` varchar(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `validasi` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `topup`
--

INSERT INTO `topup` (`id_topup`, `id_users`, `keterangan`, `jumlah`, `extensi`, `timestamp`, `validasi`) VALUES
(1, 3, 'asd', 4000, '.jpg', '2018-07-03 09:05:04', '1'),
(9, 3, 'Edit by admin', 1000, '', '2018-07-06 18:15:06', '1'),
(11, 3, 'Edit by admin', -1000, '', '2018-07-06 18:15:53', '1'),
(12, 9, 'add', 10000, '', '2018-07-06 18:17:36', '1'),
(13, 9, 'Edit by admin', 190000, '', '2018-07-06 18:20:13', '1'),
(14, 9, 'Edit by admin', -180000, '', '2018-07-06 18:20:32', '1'),
(15, 3, 'Edit by admin', 6000, '', '2018-07-06 18:52:00', '1'),
(17, 3, 'Iklan klik', -500, '', '2018-07-06 19:16:03', '1'),
(18, 3, 'Iklan klik', -500, '', '2018-07-06 19:17:17', '1'),
(19, 3, 'Iklan klik', -500, '', '2018-07-06 19:18:19', '1'),
(20, 3, 'Iklan klik', -500, '', '2018-07-06 19:18:24', '1'),
(21, 3, 'Iklan klik', -500, '', '2018-07-06 19:18:32', '1'),
(22, 3, 'Iklan klik', -500, '', '2018-07-06 19:18:50', '1'),
(23, 3, 'Iklan klik', -500, '', '2018-07-06 19:18:58', '1'),
(24, 3, 'Iklan klik', -500, '', '2018-07-06 19:19:11', '1'),
(25, 3, 'Iklan klik', -500, '', '2018-07-06 19:20:51', '1'),
(26, 3, 'Iklan klik', -500, '', '2018-07-06 19:21:08', '1'),
(27, 3, 'Iklan klik', -500, '', '2018-07-06 19:21:18', '1'),
(28, 3, 'Iklan klik', -500, '', '2018-07-06 19:21:24', '1'),
(29, 3, 'Edit by admin', -3500, '', '2018-07-06 19:22:56', '1'),
(30, 3, 'Iklan klik', -500, '', '2018-07-06 19:23:43', '1'),
(31, 3, 'Edit by admin', 500, '', '2018-07-06 19:25:44', '1'),
(32, 3, 'Iklan klik', -500, '', '2018-07-06 19:27:08', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trans` int(11) NOT NULL,
  `id_pem` int(11) NOT NULL,
  `bukti_foto` text NOT NULL,
  `tgl_upload_bukti` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `no_resi` varchar(20) NOT NULL DEFAULT '0',
  `resi_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_trans`, `id_pem`, `bukti_foto`, `tgl_upload_bukti`, `status`, `no_resi`, `resi_foto`) VALUES
(2, 7, './bukti/logo_apotek.jpg', '2018-07-02 00:51:17', 2, '12345657654', './bukti_resi/logo_apotek.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` bigint(20) NOT NULL,
  `id_produk` bigint(20) NOT NULL,
  `tipe_user` enum('admin','mahasiswa','user') NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `komentar` text NOT NULL,
  `aktif` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_produk`, `tipe_user`, `id_user`, `timestamp`, `komentar`, `aktif`) VALUES
(1, 11, 'user', 1, '2018-06-23 16:09:24', 'asasa', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` bigint(20) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota_kab` int(11) NOT NULL,
  `telp` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `extensi` varchar(4) NOT NULL,
  `aktif` enum('1','0') NOT NULL,
  `level` varchar(11) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `no_rek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `nim`, `username`, `password`, `nama`, `alamat`, `kota_kab`, `telp`, `email`, `extensi`, `aktif`, `level`, `nama_bank`, `no_rek`) VALUES
(1, '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'a', '', 0, 0, '', '.jpg', '1', 'admin', '', 0),
(3, '123456', 'asd', '7815696ecbf1c96e6894b779456d330e', 'asd', 'kali malang', 35, 2123456, 'asd@asd.com', '', '1', 'mahasiswa', 'BNI', 132132132),
(7, '', 'zxc', '5fa72358f0b4fb4f2c5d7de8c9a41846', 'zxc', 'cakung', 322, 2132323, '', '', '1', 'user', '', 0),
(8, '', 'fghaaaaa', '0f98df87c7440c045496f705c7295344', 'aaaaaaaa', '', 0, 0, '', '', '1', 'user', '', 0),
(9, '', 'bnm', 'bd93b91d4a5e9a7a5fcd1fad5b9cb999', 'bnm', 'bekasi', 1, 0, '', '', '1', 'user', '', 0),
(10, '12341321', 'ghj', 'ea7d201d1cdd240f3798b2dc51d6adcb', 'ghj', '', 32, 0, '', '', '1', 'mahasiswa', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pem`);

--
-- Indexes for table `ppc`
--
ALTER TABLE `ppc`
  ADD PRIMARY KEY (`id_ppc`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`id_topup`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ppc`
--
ALTER TABLE `ppc`
  MODIFY `id_ppc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `topup`
--
ALTER TABLE `topup`
  MODIFY `id_topup` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
