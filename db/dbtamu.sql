-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2017 at 09:59 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbltamu`
--

CREATE TABLE `tbltamu` (
  `kd_tamu` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `ket` varchar(100) NOT NULL,
  `kd_user` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltamu`
--

INSERT INTO `tbltamu` (`kd_tamu`, `nama`, `instansi`, `tujuan`, `tgl`, `jam`, `ket`, `kd_user`) VALUES
('TMU001', 'Sarah', 'kemendikbud', 'silahturahmi', '2017-01-21', '00:00:00', 'test', 'USR002'),
('TMU002', 'Azhari', 'test', 'test', '2016-12-01', '20:00:00', 'test', 'USR002'),
('TMU003', 'testing', 'test', 'test', '2017-01-21', '00:00:00', 'test', 'USR001'),
('TMU004', 'skdasdk', 'kaskdsakaaaaaaaa', 'kasfasfk', '2017-01-21', '16:00:00', 'vzcvxv', 'USR002'),
('TMU005', 'test', 'test', 'test', '2017-01-21', '21:27:00', 'test', 'USR002'),
('TMU006', 'a', 'skdk', 'kasdd', '2017-01-24', '14:49:00', 'jsdnasjd', 'USR001');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `kd_user` varchar(6) NOT NULL,
  `nm_lengkap` varchar(50) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL,
  `aktif` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`kd_user`, `nm_lengkap`, `nm_user`, `password`, `level`, `aktif`) VALUES
('USR001', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Y'),
('USR002', 'Tiny Toon', 'Tiny Toon', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'Y'),
('USR003', 'Mickey Mouse', 'Mouse', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'Y'),
('USR004', 'Jackie Chan', 'Jackie Chan', '26c322652770620e64ac90682eb6504c', 'Kepsek', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbltamu`
--
ALTER TABLE `tbltamu`
  ADD PRIMARY KEY (`kd_tamu`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`kd_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
