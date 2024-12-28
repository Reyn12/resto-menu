-- phpMyAdmin SQL Dump
CREATE DATABASE IF NOT EXISTS `resto_menu`;
USE `resto_menu`;

-- Struktur tabel untuk kategori
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `jumlah_item` int(11) DEFAULT 0,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data untuk tabel kategori
INSERT INTO `kategori` (`nama_kategori`, `icon`, `jumlah_item`) VALUES
('All Menu', '🍽️', 110),
('Breads', '🍞', 20),
('Cakes', '🍰', 20),
('Donuts', '🍩', 20),
('Pastries', '🥐', 20),
('Sandwich', '🥪', 20);

-- Struktur tabel untuk menu
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('tersedia','habis') DEFAULT 'tersedia',
  PRIMARY KEY (`id_menu`),
  FOREIGN KEY (`id_kategori`) REFERENCES `kategori`(`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data untuk tabel menu dengan gambar yang valid
INSERT INTO `menu` (`nama_menu`, `id_kategori`, `harga`, `gambar`, `deskripsi`, `status`) VALUES
('Beef Crowich', 6, 5.50, 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=500&h=400&fit=crop', 'Roti croissant dengan isian daging sapi panggang', 'tersedia'),
('Buttermilk Croissant', 5, 4.00, 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=500&h=400&fit=crop', 'Croissant lembut dengan butter premium', 'tersedia'),
('Cereal Cream Donut', 4, 2.45, 'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=500&h=400&fit=crop', 'Donut dengan topping sereal dan cream', 'tersedia'),
('Cheesy Cheesecake', 3, 3.75, 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&h=400&fit=crop', 'Cheesecake New York style', 'tersedia'),
('Cheezy Sourdough', 2, 4.50, 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?w=500&h=400&fit=crop', 'Roti sourdough dengan keju', 'tersedia'),
('Egg Tart', 5, 3.25, 'https://images.unsplash.com/photo-1626803775151-61d756612f97?w=500&h=400&fit=crop', 'Pastry dengan isian custard telur', 'tersedia'),
('Grains Pan Bread', 2, 4.50, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=500&h=400&fit=crop', 'Roti dengan campuran biji-bijian', 'tersedia'),
('Spinchoco Roll', 5, 4.00, 'https://images.unsplash.com/photo-1612182062633-9ff3b3598e96?w=500&h=400&fit=crop', 'Roll cake dengan filling coklat', 'tersedia'),
('Black Forest', 3, 5.00, 'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?w=500&h=400&fit=crop', 'Kue coklat dengan cherry', 'tersedia'),
('Solo Floss Bread', 2, 4.50, 'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?w=500&h=400&fit=crop', 'Roti dengan abon premium', 'tersedia');

-- Struktur tabel untuk pesanan
CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_pesanan` varchar(20) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('open','closed') DEFAULT 'open',
  `total` decimal(10,2) DEFAULT 0.00,
  `tipe_pesanan` enum('dine_in','take_away') DEFAULT 'dine_in',
  `nomor_meja` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Struktur tabel untuk detail pesanan
CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `subtotal` decimal(10,2) NOT NULL,
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan`(`id_pesanan`),
  FOREIGN KEY (`id_menu`) REFERENCES `menu`(`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
