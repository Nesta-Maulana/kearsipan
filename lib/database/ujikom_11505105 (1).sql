-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3309
-- Generation Time: 04 Feb 2018 pada 07.31
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ujikom_11505105`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE IF NOT EXISTS `disposisi` (
`id` int(11) NOT NULL,
  `surat_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `disposisi_dari` int(11) NOT NULL,
  `disposisi_waktu` varchar(20) NOT NULL,
  `status_id` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `surat_id`, `deskripsi`, `disposisi_dari`, `disposisi_waktu`, `status_id`) VALUES
(12, 14, 'Mohon lanjutkan bang', 26, '04-02-2018 11:42:11', 2),
(13, 16, 'Lanjutkan ', 1, '04-02-2018 13:18:02', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi_detail`
--

CREATE TABLE IF NOT EXISTS `disposisi_detail` (
`id` int(11) NOT NULL,
  `disposisi_id` int(11) NOT NULL,
  `disposisi_untuk` int(11) NOT NULL,
  `waktu_lihat` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisi_detail`
--

INSERT INTO `disposisi_detail` (`id`, `disposisi_id`, `disposisi_untuk`, `waktu_lihat`) VALUES
(7, 12, 7, ''),
(8, 12, 13, '04-02-2018 13:05:24'),
(9, 13, 13, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`) VALUES
(3, 'Tim Bisnis Analis'),
(4, 'Tim Database Sistem'),
(5, 'Tim Marketing'),
(6, 'Tim Finance'),
(7, 'Tim Teknisi'),
(8, 'Tim Front End'),
(9, 'Tim Backend');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE IF NOT EXISTS `jenis_surat` (
`id` int(11) NOT NULL,
  `jenis_surat` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `jenis_surat`) VALUES
(1, 'Surat Masuk'),
(2, 'Surat Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_aktivitas`
--

CREATE TABLE IF NOT EXISTS `kode_aktivitas` (
  `kode_aktivitas` int(11) NOT NULL,
  `aktivitas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kode_aktivitas`
--

INSERT INTO `kode_aktivitas` (`kode_aktivitas`, `aktivitas`) VALUES
(1, 'Login Ke Aplikasi'),
(2, 'Logout Dari Aplikasi'),
(3, 'Mengarsipkan Surat Masuk '),
(4, 'Mengarsipkan Surat Keluar '),
(5, 'Membaca Disposisi Surat'),
(6, 'Melihat Surat'),
(7, 'Mengubah Data Pengguna'),
(8, 'Mengubah Data Jabatan'),
(9, 'Menambah Pengguna'),
(10, 'Menambah Jabatan'),
(11, 'Mendisposisikan Surat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`id` int(11) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'Sekretaris'),
(3, 'Pimpinan'),
(4, 'Staff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE IF NOT EXISTS `log_aktivitas` (
  `user_id` int(11) NOT NULL,
  `user_pengaruh` int(11) DEFAULT NULL,
  `id_aktivitas` int(11) NOT NULL,
  `deskripsi_aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`user_id`, `user_pengaruh`, `id_aktivitas`, `deskripsi_aktivitas`, `waktu`) VALUES
(1, NULL, 1, '', '2018-02-03 02:50:36'),
(1, NULL, 3, 'Dengan Kode Surat 032/TP/I/2018', '2018-02-03 03:44:59'),
(1, NULL, 3, 'Dari Tim Rekayasa Perangkat Lunak dengan kode surat 003/RPL/I/2018 ', '2018-02-03 06:50:56'),
(1, NULL, 3, 'Dari Tim Teknisi Jakarta dengan kode surat 004/TKJ/I/2018 ', '2018-02-03 06:52:42'),
(1, NULL, 3, 'Dari Perusahaan Listrik Negara dengan kode surat 012/PLN/I/2018 ', '2018-02-03 06:54:11'),
(1, NULL, 4, 'untuk CV Sumber Rejeki dengan kode surat 001/PTG/MRK/I/2018 ', '2018-02-03 08:09:04'),
(1, NULL, 1, '', '2018-02-03 09:38:10'),
(1, NULL, 1, '', '2018-02-04 01:06:15'),
(1, NULL, 9, ' bernama Helda Ramadiah', '2018-02-04 03:14:03'),
(1, NULL, 9, ' bernama Kevin Riski', '2018-02-04 03:18:36'),
(1, NULL, 7, ' dengan menghapus user bernama Kevin Riski', '2018-02-04 03:20:10'),
(1, NULL, 10, ' Dengan nama Tim Back End ', '2018-02-04 03:23:01'),
(1, NULL, 10, ' Dengan nama Tim Front End ', '2018-02-04 03:23:37'),
(1, NULL, 10, ' Dengan nama Tim Front End ', '2018-02-04 03:23:49'),
(1, NULL, 10, ' Dengan nama Tim Front End ', '2018-02-04 03:24:07'),
(1, NULL, 8, ' Sebelumnya Tim Back End Menjadi Tim Back Front End ', '2018-02-04 03:28:13'),
(1, NULL, 8, ' Menghapus jabatan  Tim Back Front End', '2018-02-04 03:29:33'),
(1, NULL, 10, ' Dengan nama Tim Front End ', '2018-02-04 03:29:47'),
(1, NULL, 10, ' Dengan nama Tim Backend ', '2018-02-04 03:29:52'),
(1, NULL, 3, 'Dari Kementrian Rekayasa Perangkat Lunak dengan kode surat 031/RPL/I/2018 ', '2018-02-04 03:31:25'),
(1, NULL, 4, 'untuk PT Agricon dengan kode surat 002/PTG/DVL/I/2018 ', '2018-02-04 03:43:41'),
(1, NULL, 9, ' bernama Cucu Cahyati', '2018-02-04 03:57:26'),
(26, NULL, 1, '', '2018-02-04 04:02:09'),
(26, NULL, 1, '', '2018-02-04 04:02:51'),
(26, NULL, 3, 'Dari sadsadsad dengan kode surat sadsadsa ', '2018-02-04 04:22:18'),
(26, NULL, 3, 'Dari sadsadsad dengan kode surat sadsad ', '2018-02-04 04:22:38'),
(26, NULL, 3, 'Dari asdsadsad dengan kode surat sadsadsad ', '2018-02-04 04:25:51'),
(1, NULL, 1, '', '2018-02-04 04:33:38'),
(26, NULL, 1, '', '2018-02-04 04:35:48'),
(26, NULL, 3, 'Dari wewewe dengan kode surat 1212121212 ', '2018-02-04 04:38:07'),
(26, NULL, 3, 'Dari TIM RPL dengan kode surat 001/RPL/I/2018 ', '2018-02-04 04:40:39'),
(26, 7, 11, ' Untuk ', '2018-02-04 04:42:25'),
(26, NULL, 4, 'untuk PT Agricon dengan kode surat 001/PTG/MRK/I/2018 ', '2018-02-04 04:45:52'),
(26, NULL, 1, '', '2018-02-04 04:49:33'),
(1, NULL, 1, '', '2018-02-04 04:54:36'),
(1, NULL, 9, ' bernama Ahmad Soebardjo', '2018-02-04 04:55:02'),
(27, NULL, 1, '', '2018-02-04 04:55:14'),
(27, NULL, 1, '', '2018-02-04 04:57:04'),
(27, NULL, 1, '', '2018-02-04 04:59:49'),
(1, NULL, 1, '', '2018-02-04 05:38:35'),
(1, NULL, 9, ' bernama Rendi Ihfanudin', '2018-02-04 05:41:30'),
(13, NULL, 1, '', '2018-02-04 05:41:55'),
(13, NULL, 1, '', '2018-02-04 05:45:01'),
(13, NULL, 1, '', '2018-02-04 05:45:56'),
(27, NULL, 1, '', '2018-02-04 05:48:48'),
(26, 13, 11, ' Untuk ', '2018-02-04 05:50:40'),
(13, NULL, 1, '', '2018-02-04 05:51:16'),
(1, NULL, 1, '', '2018-02-04 06:16:21'),
(1, NULL, 3, 'Dari Menteri Perikanan dengan kode surat 012/IKA/I/2018 ', '2018-02-04 06:17:38'),
(1, 13, 11, ' Untuk ', '2018-02-04 06:18:11'),
(1, NULL, 4, 'untuk Menteri Perikanan dengan kode surat 004/PTG/BE/I/2018 ', '2018-02-04 06:19:20'),
(27, NULL, 1, '', '2018-02-04 06:22:18'),
(1, NULL, 1, '', '2018-02-04 06:23:56'),
(1, NULL, 9, ' bernama dedi kusnadi', '2018-02-04 06:24:23'),
(1, NULL, 9, ' bernama Helda Ramadia', '2018-02-04 06:24:46'),
(26, NULL, 1, '', '2018-02-04 06:25:39'),
(26, NULL, 3, 'Dari Perusahaan Listrik dengan kode surat 123/PL/I/2018 ', '2018-02-04 06:29:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Penting'),
(2, 'Biasa'),
(3, 'Rahasia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE IF NOT EXISTS `surat` (
`id` int(11) NOT NULL,
  `surat_kode` varchar(30) NOT NULL,
  `surat_tanggal` varchar(20) NOT NULL,
  `surat_dari` varchar(50) NOT NULL,
  `surat_untuk` varchar(50) NOT NULL,
  `surat_subjek` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `kedatangan_surat` varchar(20) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `tipe_id` int(11) NOT NULL,
  `notifikasi` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id`, `surat_kode`, `surat_tanggal`, `surat_dari`, `surat_untuk`, `surat_subjek`, `deskripsi`, `kedatangan_surat`, `jenis_id`, `tipe_id`, `notifikasi`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(14, '001/RPL/I/2018', '30-01-2018', 'TIM RPL', 'PT Pandawa Technologies', 'Peninjauan Aplikasi Web', '&lt;p&gt;Disini dilakukan peninjauan kembali pada saat jam 12 nanti segera selesaikan&lt;/p&gt;\r\n', '04-02-2018', 1, 5, 1, '2018-02-04 04:40:38', NULL, '0000-00-00 00:00:00', 26),
(15, '001/PTG/MRK/I/2018', '04-02-2018', 'PT Pandawa Technologies', 'PT Agricon', 'Peninjauan Budget Harga', '&lt;p&gt;Akan dilakukan peninjauan akses harga aplikasi tersebut&lt;/p&gt;\r\n', '04-02-2018', 2, 5, 1, '2018-02-04 04:45:52', NULL, '2018-02-03 18:19:24', 26),
(16, '012/IKA/I/2018', '03-02-2018', 'Menteri Perikanan', 'PT Pandawa Technologies', 'Permohonan Pembuatan Aplikasi ', '&lt;p&gt;PErmohonan untuk dibuatkan aplikasi berbasis web untuk mengelola jumlah ikan yang ditangkap real&lt;/p&gt;\r\n', '04-02-2018', 1, 4, 1, '2018-02-04 06:17:38', NULL, '0000-00-00 00:00:00', 1),
(17, '004/PTG/BE/I/2018', '04-02-2018', 'PT Pandawa Technologies', 'Menteri Perikanan', 'FeedBack Untuk Pembuatan WEB', '&lt;p&gt;Saya akan menyelesaikannya pada 2019&lt;/p&gt;\r\n', '04-02-2018', 2, 5, 1, '2018-02-04 06:19:20', NULL, '0000-00-00 00:00:00', 1),
(18, '123/PL/I/2018', '03-02-2018', 'Perusahaan Listrik', 'PT Pandawa Technologies', 'Pembayaran Listrik', '&lt;p&gt;Anda harus membayar listrik mas&lt;/p&gt;\r\n', '04-02-2018', 1, 6, 0, '2018-02-04 06:29:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_file`
--

CREATE TABLE IF NOT EXISTS `surat_file` (
`id` int(11) NOT NULL,
  `surat_kode` varchar(30) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_file`
--

INSERT INTO `surat_file` (`id`, `surat_kode`, `file`) VALUES
(16, '001/RPL/I/2018', 'keuangan surat 3.pdf'),
(17, '001/PTG/MRK/I/2018', 'keuangan surat 2.pdf'),
(18, '012/IKA/I/2018', 'surat 3.jpg'),
(19, '004/PTG/BE/I/2018', 'penawaran BELLINI COMPANY.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_surat`
--

CREATE TABLE IF NOT EXISTS `tipe_surat` (
`id` int(11) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_surat`
--

INSERT INTO `tipe_surat` (`id`, `tipe`) VALUES
(3, 'Surat Penawaran'),
(4, 'Surat Dinas'),
(5, 'Surat Pemberitahuan'),
(6, 'Surat Peringatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `jk` enum('L','P') NOT NULL,
  `id_level` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `confirm_account` int(1) NOT NULL DEFAULT '0',
  `status_account` int(1) NOT NULL DEFAULT '0',
  `error_password` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `jk`, `id_level`, `id_jabatan`, `confirm_account`, `status_account`, `error_password`) VALUES
(1, 'system', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'System', 'L', 1, NULL, 1, 1, 1),
(7, 'lutfho.babe', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'Lutfhi Akhdan', 'L', 4, 4, 0, 1, 0),
(8, 'hasantion', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'Indra Hasan', 'L', 4, 5, 0, 1, 0),
(13, 'maulana.mama', 'bWF1bGFuYW1hbWE=', 'Maulana Nesta', 'P', 4, 7, 1, 1, 0),
(22, 'riski.kevin', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'Kevin Riski', 'L', 4, 7, 0, 1, 0),
(26, 'cucu_cahyati', 'Y3VjdW55YQ==', 'Cucu Cahyati', 'P', 2, NULL, 1, 1, 0),
(27, 'ahmad.bardjo', 'YmFyZGpv', 'Ahmad Soebardjo', 'L', 3, NULL, 1, 1, 0),
(28, 'rendi.ihfanudin', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'Rendi Ihfanudin', 'L', 4, 3, 0, 1, 0),
(29, 'dedi.kusnadi', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'dedi kusnadi', 'L', 4, 5, 0, 1, 0),
(30, 'helda.ramadia', 'a2VhcnNpcGFucGFuZGF3YTE2NQ==', 'Helda Ramadia', 'P', 2, NULL, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
 ADD PRIMARY KEY (`id`), ADD KEY `surat_id` (`surat_id`), ADD KEY `disposisi_dari` (`disposisi_dari`), ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `disposisi_detail`
--
ALTER TABLE `disposisi_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `disposisi_id` (`disposisi_id`), ADD KEY `disposisi_untuk` (`disposisi_untuk`), ADD KEY `disposisi_untuk_2` (`disposisi_untuk`), ADD KEY `disposisi_id_2` (`disposisi_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kode_aktivitas`
--
ALTER TABLE `kode_aktivitas`
 ADD PRIMARY KEY (`kode_aktivitas`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
 ADD KEY `user_id` (`user_id`), ADD KEY `user_pengaruh` (`user_pengaruh`), ADD KEY `id_aktivitas` (`id_aktivitas`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `surat_kode_2` (`surat_kode`), ADD KEY `surat_kode` (`surat_kode`), ADD KEY `surat_dari` (`surat_dari`), ADD KEY `surat_untuk` (`surat_untuk`), ADD KEY `jenis_id` (`jenis_id`), ADD KEY `tipe_id` (`tipe_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `surat_file`
--
ALTER TABLE `surat_file`
 ADD PRIMARY KEY (`id`), ADD KEY `surat_kode` (`surat_kode`);

--
-- Indexes for table `tipe_surat`
--
ALTER TABLE `tipe_surat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `id_jabatan` (`id_jabatan`), ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `disposisi_detail`
--
ALTER TABLE `disposisi_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `surat_file`
--
ALTER TABLE `surat_file`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tipe_surat`
--
ALTER TABLE `tipe_surat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`disposisi_dari`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `disposisi_ibfk_2` FOREIGN KEY (`surat_id`) REFERENCES `surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `disposisi_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `disposisi_detail`
--
ALTER TABLE `disposisi_detail`
ADD CONSTRAINT `disposisi_detail_ibfk_1` FOREIGN KEY (`disposisi_untuk`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `disposisi_detail_ibfk_2` FOREIGN KEY (`disposisi_id`) REFERENCES `disposisi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `log_aktivitas_ibfk_3` FOREIGN KEY (`id_aktivitas`) REFERENCES `kode_aktivitas` (`kode_aktivitas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `log_aktivitas_ibfk_4` FOREIGN KEY (`user_pengaruh`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat`
--
ALTER TABLE `surat`
ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `surat_ibfk_2` FOREIGN KEY (`tipe_id`) REFERENCES `tipe_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `surat_ibfk_3` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_file`
--
ALTER TABLE `surat_file`
ADD CONSTRAINT `surat_file_ibfk_1` FOREIGN KEY (`surat_kode`) REFERENCES `surat` (`surat_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
