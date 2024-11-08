-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 03:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdrone`
--

-- --------------------------------------------------------

--
-- Table structure for table `belanja`
--

CREATE TABLE `belanja` (
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `belanja`
--

INSERT INTO `belanja` (`id_produk`, `jumlah`, `id_user`) VALUES
(6, 2, 15),
(5, 13, 15),
(8, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `etalase`
--

CREATE TABLE `etalase` (
  `merk` varchar(100) NOT NULL,
  `desk` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `id_etalase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etalase`
--

INSERT INTO `etalase` (`merk`, `desk`, `gambar`, `harga`, `id_etalase`) VALUES
('DJI MAVIC 3 PRO', '4/3 CMOS Hasselblad Camera | Dual Tele Cameras | Cine Only Tri-Camera Apple ProRes Support | 43-Min Max Flight Time | Omnidirectional Obstacle Sensing | 15km HD Video Transmission', 'dji mavic 3 pro.png', 53190000.00, 4),
('DJI MINI 4 PRO', 'Under 249 g | 4K/60fps HDR True Vertical Shooting | Omnidirectional Obstacle Sensing | Extended Battery Life | 20km FHD Video Transmission | ActiveTrack 360°', 'di mini 4 pro.png', 12000000.00, 5),
('DJI Air 3S', '1″ CMOS Primary Camera | Dual-Camera 4K/60fps HDR Video & 14 Stops of Dynamic Range | Free Panorama, Seamless and Detailed | Nightscape Omnidirectional Obstacle Sensing | Next-Gen Smart RTH With Enhanced Precision | 45-Min Flight Time, 20km Video Transmission', 'dji air 3s.png', 24100000.00, 6),
('DJI Mini 3', 'Under 249 g | Extended Battery Life | 4K HDR Video | True Vertical Shooting | Intelligent Features | 38kph (Level 5) Wind Resistance', 'dji mini 3.png', 5700000.00, 7),
('DJI Avata 2', 'Immersive Flight Experience | Intuitive Motion Control | Easy ACRO | Tight Shots in Super-Wide 4K | Built-In Propeller Guard | Hassle-Free POV Content', 'dji avata 2.png', 16500000.00, 8),
('DJI NEO', '135 g, Light & Portable | Palm Takeoff & Landing | AI Subject Tracking, QuickShots | Multiple Control Options | 4K Ultra-Stabilized Video | Full-Coverage Propeller Guards', 'dji neo.png', 5500000.00, 11),
('DJI Inspire 3', 'Full-Frame 8K ProRes RAW/CDNG | 1/1.8-inch Ultra-Wide Night-Vision FPV Camera | Dual Aircraft Frame Configurations: Tilt Boost & 360° Pan | O3 Pro Video Transmission with Dual-Control | Centimeter-Level RTK Positioning and Waypoint Pro | Supports DJI Transmission/Master Wheels/Three-Channel Follow Focus', 'dji inspire 3.png', 200000000.00, 12),
('Phantom 4 Pro V2.0', '1\" 20 MP sensor and 5-direction obstacle sensing.', 'phantom.png', 33000000.00, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `namaLengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`, `namaLengkap`) VALUES
(13, 'p', 'akmalprtm043@gmail.com', '$2y$10$SOXDoIzia/Z6EbZZxoW1SudRTYITiX5TT39a1rYoFlc/DkWLOsqmS', 'admin', 'Akmal Alvian Pratama'),
(14, 'r', 'r@gmail.com', '$2y$10$1ycAxPf0FoVgB7MFovFYqe/Gk/H1jkSCoEnw.2qwfVmnWgPDcw/bm', 'user', 'Rifqi'),
(15, 'v', 'v@gmail.com', '$2y$10$TDrT8ARiyFokr/8Ur/qGsOpjpU0gXhVMUC/7/bDGO8u/2EuZ7jlS2', 'user', 'Vicky Ahmad Fernanda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `belanja`
--
ALTER TABLE `belanja`
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `etalase`
--
ALTER TABLE `etalase`
  ADD PRIMARY KEY (`id_etalase`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `belanja`
--
ALTER TABLE `belanja`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `etalase`
--
ALTER TABLE `etalase`
  MODIFY `id_etalase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `belanja`
--
ALTER TABLE `belanja`
  ADD CONSTRAINT `etalase-belanja` FOREIGN KEY (`id_produk`) REFERENCES `etalase` (`id_etalase`),
  ADD CONSTRAINT `user-belanja` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
