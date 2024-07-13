-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.18-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk si-inventory
CREATE DATABASE IF NOT EXISTS `si-inventory` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `si-inventory`;

-- membuang struktur untuk table si-inventory.permintaan
CREATE TABLE IF NOT EXISTS `permintaan` (
  `id_permintaanpembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `kode_permintaan` varchar(15) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `id_video` varchar(50) NOT NULL,
  `status_permintaan` enum('Meminta','Ditolak','Setuju') NOT NULL,
  PRIMARY KEY (`id_permintaanpembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel si-inventory.permintaan: ~0 rows (lebih kurang)
DELETE FROM `permintaan`;
/*!40000 ALTER TABLE `permintaan` DISABLE KEYS */;
INSERT INTO `permintaan` (`id_permintaanpembelian`, `id_user`, `kode_permintaan`, `tgl_permintaan`, `id_video`, `status_permintaan`) VALUES
	(1, 2, 'PP20240713001', '2024-07-13', 'VD20240713001', 'Meminta');
/*!40000 ALTER TABLE `permintaan` ENABLE KEYS */;

-- membuang struktur untuk table si-inventory.user_petugas
CREATE TABLE IF NOT EXISTS `user_petugas` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_user` varchar(100) NOT NULL,
  `level` enum('admin','customer') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel si-inventory.user_petugas: ~4 rows (lebih kurang)
DELETE FROM `user_petugas`;
/*!40000 ALTER TABLE `user_petugas` DISABLE KEYS */;
INSERT INTO `user_petugas` (`id_user`, `nama`, `jabatan`, `phone`, `email`, `password`, `foto_user`, `level`) VALUES
	(1, 'Darsirah', 'Manager', '082311707366', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'female-3.png', 'admin'),
	(2, 'Silvia Wastuti', 'Custumer', '087516756155', 'customer@gmail.com', 'b39f008e318efd2bb988d724a161b61c6909677f', 'female-2.png', 'customer'),
	(3, 'Oni Melani', 'Custumer', '0270458776', 'customerb@gmail.com', 'b39f008e318efd2bb988d724a161b61c6909677f', 'female-1.png', 'customer'),
	(4, 'Cengkir Ramadan', 'Custumer', '07347864847', 'customerc@gmail.com', 'b39f008e318efd2bb988d724a161b61c6909677f', 'male-1.png', 'customer');
/*!40000 ALTER TABLE `user_petugas` ENABLE KEYS */;

-- membuang struktur untuk table si-inventory.video
CREATE TABLE IF NOT EXISTS `video` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `kode_barang` varchar(15) NOT NULL,
  `video` varchar(50) NOT NULL,
  `file` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel si-inventory.video: ~0 rows (lebih kurang)
DELETE FROM `video`;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` (`id_barang`, `id_user`, `kode_barang`, `video`, `file`, `tanggal`) VALUES
	(1, 1, 'VD20240713001', 'Cara menambahkan Icon di Android Studio', 'Cara_menambahkan_Icon_di_Android_Studio.mp4', '2024-07-13');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
