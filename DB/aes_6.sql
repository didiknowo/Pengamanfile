-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 07:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aes_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `file_name_source` varchar(255) DEFAULT NULL,
  `file_name_finish` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `password` varchar(16) NOT NULL,
  `tgl_upload` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `username`, `file_name_source`, `file_name_finish`, `file_url`, `file_size`, `password`, `tgl_upload`, `status`, `keterangan`) VALUES
(221022001, 'sabto', '49531-surat-balasan.docx', '17373-surat-balasan.rda', 'file_encrypt/17373-surat-balasan.rda', 52.2549, '202cb962ac59075b', '2022-10-22 04:19:51', '1', '123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `verifikasi` enum('Ya','Tidak','Blokir') NOT NULL,
  `join_date` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `fullname`, `job_title`, `img`, `verifikasi`, `join_date`, `last_activity`, `status`, `token`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin1@gmail.com', 'Dhui', 'Data Security', 'admin20221006011325.jpg', 'Ya', '2022-02-20 08:48:55', '2022-10-26 05:14:59', '2', ''),
('saputra', '202cb962ac59075b964b07152d234b70', 'didik8736@gmail.com', 'saputra', 'user', NULL, 'Ya', '2022-10-22 03:11:04', '2022-10-22 03:11:04', '2', 'cc568b738d22b28baefe97e3e6bd739af528c9d737147538d033937160541315'),
('didik', '81dc9bdb52d04dc20036dbd8313ed055', 'didik8736@gmail.com', 'didik', 'user', NULL, 'Ya', '2022-10-07 01:26:40', '2022-10-07 01:27:33', '2', 'fc77f50010f5df3ac2170df652808f46f61566ea86b36d4b17299581b6b8716b'),
('siti', '202cb962ac59075b964b07152d234b70', 'didik8736@gmail.com', 'siti', 'user', NULL, 'Tidak', '2022-10-22 03:21:06', '2022-10-22 03:21:06', '2', '136f91e33076b62e9e20a3f21908b70ef1ff2533da8e5137c9e12767fe2ba246'),
('sabto', '202cb962ac59075b964b07152d234b70', 'didik8736@gmail.com', 'sabto', 'user', NULL, 'Ya', '2022-10-22 03:37:34', '2022-10-22 04:19:55', '2', '49efada4d3c3e3655073556981444881b9fb20d570fe9ddedb90c9b2f6a20638');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221022002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
