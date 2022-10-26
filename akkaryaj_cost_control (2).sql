-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 05:32 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akkaryaj_cost_control`
--

-- --------------------------------------------------------

--
-- Table structure for table `akk_hutang`
--

CREATE TABLE `akk_hutang` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `nominal` int(16) NOT NULL,
  `note` text NOT NULL,
  `is_pay` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `pay_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_hutang`
--

INSERT INTO `akk_hutang` (`id`, `project_id`, `nominal`, `note`, `is_pay`, `created_at`, `pay_at`, `created_by`, `updated_by`) VALUES
(1, 8, 1000000, 'tes', 1, '2020-05-08 01:45:35', '2020-05-09 09:29:49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akk_inventory`
--

CREATE TABLE `akk_inventory` (
  `id` bigint(20) NOT NULL,
  `material_id` int(12) NOT NULL,
  `qty` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_inventory`
--

INSERT INTO `akk_inventory` (`id`, `material_id`, `qty`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 1, 4, '2020-04-03 04:51:05', '2020-04-28 08:04:49', 1),
(2, 2, 230, '2020-04-03 04:52:36', '2020-04-28 05:17:50', 1),
(9, 4, 80, NULL, '2020-05-06 08:39:10', 1),
(5, 3, 6400, '2020-04-26 09:40:39', '2020-04-26 09:43:05', 4),
(14, 7, 150, '2020-04-28 05:18:31', '2020-04-28 05:18:41', 1),
(10, 5, 1600, NULL, '2020-04-28 05:30:13', 1),
(13, 6, 10, NULL, '2020-04-28 07:32:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `akk_inventory_project`
--

CREATE TABLE `akk_inventory_project` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `material_id` int(12) NOT NULL,
  `qty` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_inventory_project`
--

INSERT INTO `akk_inventory_project` (`id`, `project_id`, `material_id`, `qty`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 4, 4, 30, '2020-04-03 04:51:05', '2020-04-03 08:02:03', 1),
(2, 4, 2, 49, '2020-04-03 04:52:36', '2020-04-03 08:01:56', 1),
(3, 12, 6, 10, '2020-04-13 04:57:39', '2020-04-13 04:58:06', 6),
(5, 4, 3, 1100, '2020-04-26 09:40:39', '2020-04-26 09:43:05', 4),
(6, 12, 3, 500, '2020-04-26 10:12:45', NULL, 4),
(7, 8, 6, 0, '2020-04-27 14:44:24', '2020-05-03 06:23:40', 4),
(9, 8, 1, 101, '2020-04-28 07:34:18', '2020-04-28 08:04:49', 1),
(10, 19, 7, 1, '2020-05-04 10:43:01', NULL, 4),
(11, 8, 4, 20, '2020-05-06 08:39:10', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akk_pengajuan`
--

CREATE TABLE `akk_pengajuan` (
  `id` bigint(20) NOT NULL,
  `project_id` int(10) NOT NULL DEFAULT 0,
  `rap_id` int(10) NOT NULL DEFAULT 0,
  `total_pengajuan` int(12) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(10) DEFAULT NULL,
  `is_pengajuan_confirm` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_pengajuan`
--

INSERT INTO `akk_pengajuan` (`id`, `project_id`, `rap_id`, `total_pengajuan`, `created_at`, `updated_at`, `last_updated_by`, `is_pengajuan_confirm`) VALUES
(3, 4, 2, 0, '2020-03-24 01:23:37', '0000-00-00 00:00:00', 1, 0),
(4, 6, 4, 0, '2020-04-06 12:29:42', NULL, 1, 0),
(5, 11, 6, 0, '2020-04-08 15:21:28', NULL, 1, 0),
(6, 12, 7, 0, '2020-04-13 03:42:45', NULL, 4, 0),
(7, 8, 5, 0, '2020-04-28 04:25:20', NULL, 4, 0),
(8, 19, 9, 0, '2020-05-04 10:17:51', NULL, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `akk_pengajuan_approval`
--

CREATE TABLE `akk_pengajuan_approval` (
  `id` bigint(20) NOT NULL,
  `pengajuan_id` bigint(20) NOT NULL DEFAULT 0,
  `is_send_cash` int(2) DEFAULT 0 COMMENT '0: not send , 1:sent',
  `pengajuan_biaya_id` bigint(20) NOT NULL DEFAULT 0,
  `jumlah_approval` int(15) NOT NULL DEFAULT 0,
  `note_app` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_pengajuan_approval`
--

INSERT INTO `akk_pengajuan_approval` (`id`, `pengajuan_id`, `is_send_cash`, `pengajuan_biaya_id`, `jumlah_approval`, `note_app`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 3, 1, 2, 55000000, '', '2020-03-26 00:01:40', '2020-03-29 14:58:04', 1),
(3, 3, 1, 1, 100000000, '', '2020-03-26 01:20:52', '2020-03-30 02:24:07', 1),
(4, 3, 1, 3, 25000000, '', '2020-03-26 01:49:08', '2020-04-02 02:51:44', 1),
(5, 3, 0, 4, 46000001, 'tes note', '2020-03-26 01:53:37', '2020-04-14 07:57:14', 1),
(6, 4, 1, 5, 105000000, '', '2020-04-06 14:37:37', '2020-04-07 13:32:13', 1),
(7, 4, 1, 6, 120000000, '', '2020-04-06 14:48:55', '2020-04-07 13:33:22', 1),
(8, 5, 1, 7, 500000000, '', '2020-04-08 15:23:20', '2020-04-08 15:32:23', 1),
(9, 5, 1, 8, 110000000, '', '2020-04-08 15:23:32', '2020-04-08 15:32:44', 1),
(10, 3, 1, 10, 100000000, '', '2020-04-11 03:06:33', '2020-04-19 12:53:40', 1),
(11, 3, 0, 11, 20000000, 'tx', '2020-04-11 03:06:41', '2020-04-26 04:39:14', 1),
(12, 4, 1, 12, 30000000, '', '2020-04-11 03:11:22', '2020-04-11 03:11:37', 1),
(13, 4, 1, 13, 20000000, '', '2020-04-11 03:23:02', '2020-04-11 03:27:17', 1),
(14, 6, 1, 15, 450000, '', '2020-04-13 03:55:29', '2020-04-13 14:26:54', 1),
(15, 6, 1, 16, 100000000, '', '2020-04-13 03:55:39', '2020-04-13 14:26:09', 1),
(16, 3, 1, 14, 9000000, 'tes', '2020-04-14 07:57:53', '2020-04-21 06:40:32', 1),
(17, 6, 1, 20, 50000000, NULL, '2020-04-17 16:42:06', '2020-04-17 16:42:38', 1),
(18, 6, 1, 21, 13000000, NULL, '2020-04-18 01:24:19', '2020-04-18 01:24:34', 1),
(19, 3, 1, 22, 9800000, NULL, '2020-04-18 04:25:42', '2020-04-18 04:26:14', 1),
(20, 3, 1, 23, 98000000, NULL, '2020-04-18 04:31:48', '2020-04-18 04:32:13', 1),
(21, 3, 1, 24, 99000000, 'tes pembelian-I', '2020-04-19 00:23:10', '2020-04-19 00:24:01', 1),
(22, 3, 1, 25, 20000000, NULL, '2020-04-19 04:16:35', '2020-04-19 04:17:58', 1),
(23, 3, 1, 26, 21000000, NULL, '2020-04-19 04:16:44', '2020-04-19 04:18:07', 1),
(24, 3, 1, 27, 10000000, NULL, '2020-04-21 06:55:26', '2020-04-21 06:56:17', 1),
(25, 7, 1, 28, 100000000, NULL, '2020-04-28 04:26:26', '2020-04-28 09:12:29', 1),
(26, 7, 1, 29, 10000000, '', '2020-05-04 09:59:02', '2020-05-04 10:04:32', 2),
(27, 7, 1, 30, 1000000, NULL, '2020-05-04 10:02:37', '2020-05-04 10:10:40', 2);

-- --------------------------------------------------------

--
-- Table structure for table `akk_pengajuan_biaya`
--

CREATE TABLE `akk_pengajuan_biaya` (
  `id` bigint(20) NOT NULL,
  `pengajuan_id` bigint(20) NOT NULL DEFAULT 0,
  `is_approved` int(2) DEFAULT 0 COMMENT '0=no , 1=approved',
  `rap_biaya_id` bigint(20) NOT NULL DEFAULT 0,
  `jumlah_pengajuan` int(10) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_pengajuan_biaya`
--

INSERT INTO `akk_pengajuan_biaya` (`id`, `pengajuan_id`, `is_approved`, `rap_biaya_id`, `jumlah_pengajuan`, `note`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 3, 1, 4, 100000000, '', '2020-03-24 10:00:51', '2020-03-26 01:26:46', 1),
(2, 3, 0, 5, 60000001, 'tes', '2020-03-24 10:06:10', '2020-04-14 07:51:18', 4),
(3, 3, 1, 4, 25000000, '', '2020-03-25 00:38:10', '2020-03-26 01:49:54', 1),
(4, 3, 1, 6, 46000000, '', '2020-03-25 00:39:13', '2020-04-14 07:57:14', 1),
(5, 4, 1, 22, 105000000, '', '2020-04-06 12:57:37', '2020-04-06 14:50:04', 1),
(6, 4, 1, 23, 120000000, '', '2020-04-06 12:58:00', '2020-04-06 14:48:55', 1),
(7, 5, 1, 28, 500000000, '', '2020-04-08 15:21:56', '2020-04-08 15:23:20', 1),
(8, 5, 1, 29, 110000000, '', '2020-04-08 15:22:25', '2020-04-08 15:27:34', 1),
(9, 5, 0, 29, 20000000, 'ada note', '2020-04-08 15:24:46', '2020-04-14 07:16:31', 4),
(10, 3, 1, 8, 100000000, '', '2020-04-11 03:05:58', '2020-04-11 03:06:33', 1),
(11, 3, 0, 20, 22000000, '', '2020-04-11 03:06:11', '2020-04-26 05:50:30', 4),
(12, 4, 1, 27, 30000000, '', '2020-04-11 03:10:48', '2020-04-11 03:11:22', 1),
(13, 4, 1, 25, 20000000, '', '2020-04-11 03:22:36', '2020-04-11 03:23:02', 1),
(14, 3, 1, 4, 10000000, '', '2020-04-13 03:33:32', '2020-04-21 06:39:54', 1),
(15, 6, 1, 32, 500000, '', '2020-04-13 03:43:04', '2020-04-13 14:39:38', 1),
(16, 6, 1, 31, 100000000, '', '2020-04-13 03:43:22', '2020-04-13 14:26:09', 1),
(17, 5, 0, 29, 100000000, 'tes note', '2020-04-14 06:47:24', NULL, 4),
(20, 6, 1, 30, 50000000, 'tes pembelian', '2020-04-17 16:34:16', '2020-04-17 16:42:06', 1),
(21, 6, 1, 30, 13000000, 'tambahan', '2020-04-18 01:23:46', '2020-04-18 01:24:19', 1),
(22, 3, 1, 7, 98000000, 'tes pembelian 1', '2020-04-18 04:25:08', '2020-04-18 04:25:42', 1),
(23, 3, 1, 14, 98000000, 'tes pembelian 2', '2020-04-18 04:31:11', '2020-04-18 04:31:48', 1),
(24, 3, 1, 8, 100000000, 'tes pembelian-2', '2020-04-19 00:22:25', '2020-04-19 00:23:36', 1),
(25, 3, 1, 15, 20000000, 'tes pembelian-3', '2020-04-19 04:15:37', '2020-04-19 04:16:35', 1),
(26, 3, 1, 20, 21000000, '', '2020-04-19 04:16:08', '2020-04-19 04:16:44', 1),
(27, 3, 1, 13, 10000000, 'tx rp', '2020-04-21 06:48:14', '2020-04-21 06:55:26', 1),
(28, 7, 1, 34, 100000000, 'tes', '2020-04-28 04:25:36', '2020-04-28 04:26:26', 1),
(29, 7, 1, 35, 10000000, '', '2020-05-04 09:55:03', '2020-05-04 10:03:30', 2),
(30, 7, 1, 35, 1000000, '', '2020-05-04 09:55:19', '2020-05-04 10:02:37', 2),
(31, 7, 0, 34, 500000, '', '2020-05-04 09:55:27', NULL, 4),
(32, 8, 0, 36, 100000, '', '2020-05-04 10:18:10', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `akk_rap`
--

CREATE TABLE `akk_rap` (
  `id` bigint(20) NOT NULL,
  `project_id` int(12) NOT NULL,
  `total_biaya` int(11) DEFAULT 0,
  `is_rap_confirm` int(2) NOT NULL DEFAULT 0 COMMENT '0=not confirm 1=confirm',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_rap`
--

INSERT INTO `akk_rap` (`id`, `project_id`, `total_biaya`, `is_rap_confirm`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 2, 0, 0, '2020-03-21 04:36:50', NULL, 1),
(2, 4, 0, 1, '2020-03-24 01:18:00', '2020-04-26 05:48:43', 1),
(4, 6, 0, 1, '2020-04-05 04:58:23', '2020-04-09 04:29:03', 1),
(5, 8, 0, 1, '2020-04-08 14:56:05', '2020-05-05 12:27:22', 2),
(6, 11, 0, 1, '2020-04-08 15:13:45', '2020-04-08 15:18:39', 1),
(7, 12, 0, 1, '2020-04-13 03:19:27', '2020-04-13 03:42:27', 2),
(8, 13, 0, 0, '2020-04-21 07:07:17', NULL, 2),
(9, 19, 0, 0, '2020-05-04 10:13:29', '2020-05-04 13:34:59', 2),
(10, 20, 0, 0, '2020-05-04 13:25:05', '2020-05-04 13:25:52', 2);

-- --------------------------------------------------------

--
-- Table structure for table `akk_rap_biaya`
--

CREATE TABLE `akk_rap_biaya` (
  `id` bigint(20) NOT NULL,
  `rap_id` bigint(20) NOT NULL,
  `kategori_biaya_id` bigint(20) NOT NULL,
  `jenis_biaya_id` bigint(20) NOT NULL,
  `nama_jenis_rap` varchar(60) NOT NULL,
  `nama_pekerjaan` varchar(80) NOT NULL,
  `jumlah_biaya` int(100) NOT NULL,
  `jumlah_aktual` int(100) DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akk_rap_biaya`
--

INSERT INTO `akk_rap_biaya` (`id`, `rap_id`, `kategori_biaya_id`, `jenis_biaya_id`, `nama_jenis_rap`, `nama_pekerjaan`, `jumlah_biaya`, `jumlah_aktual`, `note`, `created_at`, `updated_at`, `last_update_by`) VALUES
(1, 0, 1, 1, 'Gaji', '', 100000000, NULL, '100000000', '2020-03-21 05:58:59', NULL, 1),
(2, 1, 1, 2, 'Honor konsultan', 'honor konsultan', 5000000, NULL, '5000000', '2020-03-21 06:02:00', NULL, 1),
(3, 1, 1, 2, 'Honor buruh', 'honor buruh', 50000000, NULL, 'tes', '2020-03-21 06:11:10', NULL, 1),
(4, 2, 1, 1, 'Gaji & Lembur', 'Gaji & Lembur', 100000000, NULL, '', '2020-03-22 01:38:38', NULL, 1),
(5, 2, 1, 1, 'Honor Konsultan', 'Honor Konsultan', 50000000, 55000000, '', '2020-03-22 01:39:45', '2020-04-02 05:03:17', 5),
(6, 2, 1, 2, 'Mungguh', 'Sipil', 5000000, NULL, '', '2020-03-22 01:40:25', NULL, 1),
(7, 2, 1, 2, 'Nanda', 'Listrik', 6000000, 4000000, '', '2020-03-22 01:40:54', '2020-04-18 04:30:00', 5),
(8, 2, 1, 3, 'Hence', 'Partisi & Plafond', 100000000, 179000000, '', '2020-03-22 01:41:22', '2020-04-21 06:08:27', 5),
(9, 2, 1, 3, 'Handriil', 'Handriil', 40000000, NULL, '', '2020-03-22 01:41:50', NULL, 1),
(10, 2, 1, 1, 'BBM Operasional', 'BBM Operasional', 6000000, NULL, '', '2020-03-22 01:42:17', NULL, 1),
(11, 2, 2, 4, 'Material & Bahan Langsung', 'Material & Bahan Langsung', 90000000, NULL, '', '2020-03-22 01:49:56', NULL, 1),
(12, 2, 2, 5, 'Alat Bantu', 'Alat Bantu', 46000000, NULL, '', '2020-03-22 01:50:20', NULL, 1),
(13, 2, 2, 4, 'Semen', 'Semen', 10000000, 9000000, '', '2020-03-22 01:53:45', '2020-04-21 06:57:49', 4),
(14, 2, 2, 5, 'Peralatan', 'Peralatan', 10000000, 68000000, '', '2020-03-22 01:54:12', '2020-04-18 04:32:38', 5),
(15, 2, 3, 9, 'Direksi keet', 'Direksi keet', 20000000, 10000005, '', '2020-03-22 01:55:40', '2020-04-19 04:21:34', 5),
(16, 2, 3, 9, 'Gudang', 'Gudang', 50000000, NULL, '', '2020-03-22 01:56:01', NULL, 1),
(17, 2, 3, 10, 'Pembersihan Lokasi', 'Pembersihan Lokasi', 10000000, 10000000, '', '2020-03-22 01:56:39', '2020-04-19 04:36:35', 5),
(18, 2, 4, 6, 'Sewa Kendaraan', 'Sewa Kendaraan', 10000000, 10000000, '', '2020-03-22 01:57:10', '2020-04-19 04:43:09', 4),
(19, 2, 4, 7, 'Test material', 'test material', 25000000, 10000000, '', '2020-03-22 01:57:33', '2020-04-19 04:58:37', 4),
(20, 2, 4, 8, 'Overhead', 'Overhead', 20000000, 10000000, '', '2020-03-22 01:57:55', '2020-04-19 04:40:49', 4),
(22, 4, 1, 1, 'Gaji', 'Gaji Honorer', 100000021, 105000000, NULL, '2020-04-05 14:03:41', '2020-04-09 13:57:36', 1),
(23, 4, 2, 4, 'Material & Bahan Langsung', 'Material & Bahan Langsung', 100000000, 0, '', '2020-04-05 14:05:04', '2020-04-09 14:03:36', 1),
(24, 4, 3, 9, 'Direksi keet', 'Direksi keet', 80000000, 0, '', '2020-04-05 14:06:11', NULL, 1),
(25, 4, 4, 6, 'Sewa Kendaraan', 'Sewa Kendaraan', 20000000, 20000000, '', '2020-04-05 14:07:38', '2020-04-11 03:30:25', 5),
(26, 4, 3, 9, 'Temp 1', 'Temp 1', 55000000, 0, '', '2020-04-06 15:09:32', NULL, 1),
(27, 4, 4, 6, 'Sewa Gedung', 'Sewa Gedung2', 30000000, 30000000, '', '2020-04-08 14:56:37', '2020-04-11 03:12:26', 4),
(28, 6, 1, 1, 'Gaji', 'Gaji Honorer', 50000000, 500000000, 'tes stream', '2020-04-08 15:16:01', '2020-04-08 15:43:19', 3),
(29, 6, 3, 9, 'Posko', 'Posko', 100000000, 110000000, 'tets stream ', '2020-04-08 15:18:21', '2020-04-08 15:37:24', 3),
(30, 7, 1, 1, 'tes hrb bug', 'tes harby bug', 50000000, 56000000, 'tes bug', '2020-04-13 03:33:00', '2020-04-19 12:11:08', 5),
(31, 7, 1, 2, 'Mungguh', 'Sipil', 245520000, 100000000, 'Test Trial Week 4', '2020-04-13 03:36:05', '2020-04-13 04:33:27', 4),
(32, 7, 2, 4, 'Semen', 'Semen', 1000000, 200000, '', '2020-04-13 03:36:45', '2020-04-17 16:05:28', 5),
(33, 2, 4, 7, 'Testing Tes', 'Testing Tes', 9000000, 0, 'aaa', '2020-04-21 06:21:44', '2020-04-21 06:26:17', 1),
(34, 5, 1, 1, 'Gaji Honorer', 'Gaji Honorer', 100000000, 52400000, '', '2020-04-28 04:24:04', '2020-05-02 05:42:56', 4),
(35, 5, 4, 6, 'Sewa Kendaraan', 'Sewa Kendaraan', 50000000, 11000000, 'tes', '2020-04-28 08:59:07', '2020-05-03 06:31:13', 4),
(36, 9, 1, 2, 'Mungguh', 'Listrik', 10000000, 0, '', '2020-05-04 10:14:43', NULL, 2),
(37, 9, 2, 4, 'Kabel', 'Kabel', 5000000, 0, '', '2020-05-04 10:15:08', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `log_inventory_organization`
--

CREATE TABLE `log_inventory_organization` (
  `id` bigint(20) NOT NULL,
  `material_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_inventory_organization`
--

INSERT INTO `log_inventory_organization` (`id`, `material_id`, `qty`, `project_id`, `note`, `created_at`, `created_by`) VALUES
(1, 5, 100, NULL, 'Penambahan inventory by Kas Besar', '2020-04-28 05:30:13', 1),
(2, 6, 20, NULL, 'Penambahan inventory melalui Kas Besar', '2020-04-28 05:48:56', 1),
(3, 6, 5, NULL, 'Pengurangan inventory melalui Kas Besar', '2020-04-28 05:49:28', 1),
(4, 6, 15, 8, 'Transfer Inventory', '2020-04-28 07:32:36', 1),
(5, 1, 10, 8, 'Transfer Inventory', '2020-04-28 07:34:18', 1),
(6, 1, 90, 8, 'Transfer Inventory', '2020-04-28 07:34:55', 1),
(7, 1, 5, NULL, 'Penambahan inventory melalui Kas Besar', '2020-04-28 08:01:33', 1),
(8, 1, 1, 8, 'Transfer Inventory', '2020-04-28 08:04:49', 1),
(9, 4, 20, 8, 'Transfer Inventory', '2020-05-06 08:39:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_mst_organization`
--

CREATE TABLE `log_mst_organization` (
  `id` int(11) NOT NULL,
  `cash_additional` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_mst_organization`
--

INSERT INTO `log_mst_organization` (`id`, `cash_additional`, `note`, `created_at`, `created_by`) VALUES
(1, 5000000, NULL, '2020-04-03 02:39:57', 1),
(2, 100000000, NULL, '2020-04-03 02:42:00', 1),
(3, 125000000, NULL, '2020-04-07 13:52:09', 1),
(4, 400000000, NULL, '2020-04-08 02:32:22', 2),
(5, 120000000, 'RETURN CASH PROJECT Project Pengusiran Corona', '2020-04-11 04:15:17', 1),
(6, 23000000, 'RETURN CASH PROJECT Project Pengusiran Corona', '2020-04-11 04:22:51', 1),
(13, 0, NULL, '2020-04-26 09:16:24', 2),
(14, 0, NULL, '2020-04-26 09:43:26', 1),
(11, 0, NULL, '2020-04-26 09:15:14', 2),
(12, 0, NULL, '2020-04-26 09:15:47', 2),
(16, 0, 'RETURN CASH PROJECT Project Test Trial Week 4', '2020-04-26 10:16:06', 1),
(15, 100000000, NULL, '2020-04-26 09:51:37', 1),
(17, 0, 'RETURN CASH PROJECT Project Test Trial Week 4', '2020-04-26 10:17:59', 1),
(18, 300000000, NULL, '2020-04-26 12:30:09', 2),
(19, 61000000, 'RETURN CASH PROJECT Project Tes RAP', '2020-04-27 14:10:25', 1),
(20, 2147483647, NULL, '2020-05-01 11:38:15', 2),
(21, 2147483647, NULL, '2020-05-02 05:12:05', 2),
(22, 346250000, NULL, '2020-05-02 05:13:25', 2),
(23, 100000000, NULL, '2020-05-04 09:21:39', 2),
(24, 300000000, NULL, '2020-05-04 09:28:29', 2),
(25, 5000000, 'tambah ex', '2020-05-06 07:06:51', 1),
(26, -5000000, 'kurang ex', '2020-05-06 07:07:29', 1),
(27, -8900000, 'kurang lagi', '2020-05-06 07:08:46', 1),
(28, 1000000, 'tmbh', '2020-05-06 07:17:51', 1),
(29, -1000000, 'krg', '2020-05-06 07:18:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_jenis_biaya`
--

CREATE TABLE `mst_jenis_biaya` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jenis_biaya`
--

INSERT INTO `mst_jenis_biaya` (`id`, `nama_jenis`, `id_kategori`, `created_at`) VALUES
(1, 'Umum', 1, '2020-04-08 14:38:29'),
(2, 'Mandor', 1, '2020-04-08 14:38:41'),
(3, 'subkontraktor', 1, '2020-04-08 14:38:51'),
(4, 'Material', 2, '2020-04-08 14:39:07'),
(5, 'Peralatan', 2, '2020-04-08 14:39:15'),
(6, 'Penyewaan', 4, '2020-04-08 14:39:35'),
(7, 'Testing', 4, '2020-04-08 14:39:47'),
(8, 'Overhead', 4, '2020-04-08 14:40:02'),
(9, 'Bangunan temp', 3, '2020-04-08 14:40:15'),
(10, 'Persiapan', 3, '2020-04-08 14:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kas`
--

CREATE TABLE `mst_kas` (
  `id` int(11) NOT NULL,
  `amount` int(200) NOT NULL,
  `kas_type` int(10) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kas`
--

INSERT INTO `mst_kas` (`id`, `amount`, `kas_type`, `created_by`, `created_at`) VALUES
(3, 2000000003, 1, 'harby', '2020-03-16 14:17:04'),
(4, 100000001, 2, 'harby', '0000-00-00 00:00:00'),
(6, 1000000000, 1, 'harby', '2020-03-16 15:06:55'),
(8, 10000004, 2, 'harby', '2020-03-16 15:07:05'),
(9, 570000000, 2, 'harby', '2020-03-16 14:54:30'),
(10, 808080899, 1, 'harby', '2020-03-16 15:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori_biaya`
--

CREATE TABLE `mst_kategori_biaya` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategori_biaya`
--

INSERT INTO `mst_kategori_biaya` (`id`, `nama_kategori`, `created_at`) VALUES
(1, 'Biaya Umum Proyek', '2020-03-21 05:47:28'),
(2, 'Biaya Material & Alat', '2020-03-21 05:47:28'),
(3, 'Bangunan Temporary & Persiapan', '2020-03-22 00:28:19'),
(4, 'Lain lain', '2020-03-22 00:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `mst_material`
--

CREATE TABLE `mst_material` (
  `id` int(11) NOT NULL,
  `material_name` varchar(50) NOT NULL,
  `unit` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_material`
--

INSERT INTO `mst_material` (`id`, `material_name`, `unit`) VALUES
(1, 'Semen', 'sack'),
(2, 'Pasir', 'kg'),
(3, 'Batu Bata', 'Pcs'),
(4, 'Genteng', 'Pcs'),
(5, 'Asbes', 'Pcs'),
(6, 'Baja', 'Ton'),
(7, 'Karton', 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `mst_office`
--

CREATE TABLE `mst_office` (
  `id` bigint(20) NOT NULL,
  `type_office_id` bigint(20) NOT NULL DEFAULT 0,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `project_name` varchar(50) NOT NULL DEFAULT '0' COMMENT 'nama office ',
  `cash_in_hand` int(15) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_office`
--

INSERT INTO `mst_office` (`id`, `type_office_id`, `user_id`, `project_name`, `cash_in_hand`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 1, 5, 'Office A', 360049995, '2020-03-27 03:00:22', '2020-04-21 06:08:27', 5),
(2, 2, 3, 'Project Test Stream', 3000000, NULL, '2020-04-18 02:42:03', 3),
(3, 2, 7, 'Project TESTING I', 0, '2020-04-26 05:57:13', NULL, 1),
(4, 2, 8, 'xx1', 0, '2020-05-02 05:14:25', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mst_office_type`
--

CREATE TABLE `mst_office_type` (
  `id` bigint(20) NOT NULL,
  `nama_type` varchar(50) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_office_type`
--

INSERT INTO `mst_office_type` (`id`, `nama_type`, `created_at`, `updated_at`) VALUES
(1, 'HO', '2020-03-27 01:14:55', NULL),
(2, 'GM', '2020-03-27 01:14:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_organization`
--

CREATE TABLE `mst_organization` (
  `id` int(10) NOT NULL,
  `organization_name` varchar(60) NOT NULL,
  `cash_in_hand` bigint(100) NOT NULL,
  `organization_address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_organization`
--

INSERT INTO `mst_organization` (`id`, `organization_name`, `cash_in_hand`, `organization_address`, `phone_number`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'PT AKKARYA JAYA PRATAMA', 2030000000, 'Bekasi ', '02188325000', '2020-03-19 13:28:27', '2020-05-06 07:18:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_param`
--

CREATE TABLE `mst_param` (
  `id` int(11) NOT NULL,
  `param` varchar(30) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_param`
--

INSERT INTO `mst_param` (`id`, `param`, `value`) VALUES
(1, 'kas_type', 'Kas Besar'),
(2, 'kas_type', 'Kas Office');

-- --------------------------------------------------------

--
-- Table structure for table `mst_project`
--

CREATE TABLE `mst_project` (
  `id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `project_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `project_location` varchar(100) COLLATE utf8_bin NOT NULL,
  `project_deadline` date NOT NULL,
  `cash_in_hand` bigint(11) DEFAULT 0,
  `rab_project` bigint(20) NOT NULL,
  `project_status` int(11) NOT NULL DEFAULT 0 COMMENT '0: On Progress, 1: Selesai',
  `project_progress` int(3) NOT NULL DEFAULT 0,
  `is_rap_fill` int(2) NOT NULL DEFAULT 0 COMMENT '0=empty 1=fill',
  `is_rap_confirm` int(2) NOT NULL DEFAULT 0 COMMENT '0=not confirm 1=confirm',
  `finish_at` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `last_updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mst_project`
--

INSERT INTO `mst_project` (`id`, `organization_id`, `project_name`, `project_location`, `project_deadline`, `cash_in_hand`, `rab_project`, `project_status`, `project_progress`, `is_rap_fill`, `is_rap_confirm`, `finish_at`, `created_at`, `updated_at`, `created_by`, `last_updated_by`) VALUES
(4, 1, 'Project Tes RAP', 'tambun belah sana', '2020-03-31', 0, 2200000000, 1, 100, 0, 0, '2020-04-30', '2020-03-22 08:26:26', '2020-04-27 21:10:25', 1, 1),
(6, 1, 'Project Pengusiran Corona', 'Wuhan China', '2020-04-17', 0, 500000000, 1, 100, 0, 0, '2020-04-10', '2020-04-05 10:09:49', '2020-04-11 12:35:50', 1, 1),
(8, 1, 'Project TESTING I', 'desa wanasari \r\ncibitung bekasi', '2020-04-10', 46600000, 900000001, 0, 40, 0, 0, NULL, '2020-04-07 20:59:58', '2020-05-09 10:12:08', 1, 1),
(11, 1, 'Project Test Stream', 'Bekasi', '2020-04-10', 0, 700000000, 1, 100, 0, 0, '2020-04-23', '2020-04-08 22:11:07', '2020-04-22 11:03:39', 1, 1),
(12, 1, 'Project Test Trial Week 4', 'Jakarta', '2020-04-30', 0, 1000000000, 1, 100, 0, 0, '2020-04-28', '2020-04-13 10:18:54', '2020-04-26 17:17:59', 2, 1),
(13, 1, 'tes', 'tes', '2020-05-13', 0, 900000000, 0, 0, 0, 0, NULL, '2020-04-13 13:47:29', NULL, 1, NULL),
(14, 1, 'tess', 'tess', '2020-04-15', 0, 399000000, 0, 0, 0, 0, NULL, '2020-04-13 21:46:16', '2020-04-14 06:02:56', 1, 1),
(15, 1, 'xx1', 'tes', '2020-04-30', 0, 500000000, 0, 0, 0, 0, NULL, '2020-04-28 15:53:13', '2020-04-28 15:56:35', 1, 1),
(16, 1, '\"Project 13\"', 'tes', '2020-04-30', 0, 1000000000, 0, 0, 0, 0, NULL, '2020-04-29 15:00:36', '2020-04-29 15:11:33', 1, 1),
(17, 1, 'Project Anu', 'tes', '2020-04-30', 0, 10000000, 0, 0, 0, 0, NULL, '2020-04-29 15:09:27', NULL, 1, NULL),
(18, 1, 'Project 12', 'tes', '2020-05-30', 0, 10000, 0, 0, 0, 0, NULL, '2020-04-29 15:11:12', NULL, 1, NULL),
(19, 1, 'Project Corona', 'Jakarta', '2020-05-22', 0, 100000000, 0, 40, 0, 0, NULL, '2020-05-04 17:13:15', '2020-05-04 17:41:51', 2, 4),
(20, 1, 'dd', 'bogor', '2020-05-06', 0, 1200000000, 0, 0, 0, 0, NULL, '2020-05-04 20:24:46', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_role`
--

CREATE TABLE `mst_role` (
  `id` bigint(20) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_role`
--

INSERT INTO `mst_role` (`id`, `role_name`) VALUES
(1, 'owner / superadmin'),
(2, 'general manager'),
(3, 'project manager'),
(4, 'finance officer'),
(5, 'logistic');

-- --------------------------------------------------------

--
-- Table structure for table `mst_status`
--

CREATE TABLE `mst_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_status`
--

INSERT INTO `mst_status` (`id`, `status_name`) VALUES
(0, 'on progress'),
(1, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE `mst_users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT 0 COMMENT '0:active , 1:non active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`id`, `fullname`, `username`, `password`, `role`, `is_active`, `created_at`, `updated_at`, `last_update_by`) VALUES
(1, 'harby anwardi', 'harby', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 0, '2020-04-26 03:28:33', '0000-00-00 00:00:00', 0),
(2, 'aulia harvy', 'aulia', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 1, '2020-04-26 03:28:33', '0000-00-00 00:00:00', 0),
(3, 'Kang Jalu', 'jalu', '5ebe2294ecd0e0f08eab7690d2a6ee69', 2, 0, '2020-04-26 03:28:33', '0000-00-00 00:00:00', 0),
(4, 'budi budian', 'budi', '5ebe2294ecd0e0f08eab7690d2a6ee69', 3, 0, '2020-04-26 03:28:33', '0000-00-00 00:00:00', 0),
(5, 'keuangan', 'keuangan', '5ebe2294ecd0e0f08eab7690d2a6ee69', 4, 0, '2020-04-26 03:28:33', '0000-00-00 00:00:00', 0),
(6, 'deni yul', 'deni', '5ebe2294ecd0e0f08eab7690d2a6ee69', 5, 0, '2020-04-26 03:28:33', '0000-00-00 00:00:00', 0),
(7, 'Helmi Dwi S', 'helmidwi', 'f1887d3f9e6ee7a32fe5e76f4ab80d63', 4, 0, '2020-04-26 03:38:03', '2020-04-26 04:23:34', 1),
(8, 'Ade S', 'ades', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 0, '2020-05-01 12:47:52', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trx_cash_remaining`
--

CREATE TABLE `trx_cash_remaining` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `destination_id` bigint(20) NOT NULL COMMENT '1 : office , 2 : project',
  `project_office_id` bigint(20) NOT NULL,
  `cash_remaining` bigint(20) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_cash_remaining`
--

INSERT INTO `trx_cash_remaining` (`id`, `project_id`, `destination_id`, `project_office_id`, `cash_remaining`, `note`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 4, 1, 1, 55799996, NULL, '2020-04-18 17:00:00', '2020-04-21 06:08:27', 5),
(2, 12, 1, 1, 4250001, NULL, '2020-04-18 17:00:00', '2020-04-19 12:11:08', 5),
(3, 12, 1, 2, 3000000, NULL, '2020-04-18 17:00:00', NULL, 0),
(4, 4, 2, 4, 2000000, NULL, '2020-04-19 04:40:49', '2020-04-21 06:57:49', 4),
(5, 8, 2, 8, 36600000, NULL, '2020-04-28 09:15:03', '2020-05-03 06:31:13', 4);

-- --------------------------------------------------------

--
-- Table structure for table `trx_pembelian_barang`
--

CREATE TABLE `trx_pembelian_barang` (
  `id` bigint(20) NOT NULL,
  `pengiriman_uang_id` bigint(20) NOT NULL,
  `destination_id` bigint(20) NOT NULL COMMENT '1 : office , 2 : project',
  `project_office_id` bigint(20) NOT NULL,
  `jumlah_uang_pembelian` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_pembelian_barang`
--

INSERT INTO `trx_pembelian_barang` (`id`, `pengiriman_uang_id`, `destination_id`, `project_office_id`, `jumlah_uang_pembelian`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(16, 1, 1, 1, 55000000, '2020-03-29 14:58:04', '2020-04-02 05:03:17', 0),
(17, 3, 1, 1, 100000000, '2020-03-30 02:24:07', '2020-04-01 08:54:19', 0),
(18, 4, 2, 4, 25000000, '2020-04-02 02:51:44', NULL, 0),
(19, 6, 1, 1, 105000000, '2020-04-07 13:32:13', '2020-04-07 13:38:24', 0),
(20, 7, 2, 6, 120000000, '2020-04-07 13:33:22', NULL, 0),
(21, 8, 1, 2, 500000000, '2020-04-08 15:32:23', '2020-04-08 15:43:19', 0),
(22, 9, 2, 11, 110000000, '2020-04-08 15:32:44', '2020-04-08 15:37:24', 0),
(23, 12, 2, 6, 30000000, '2020-04-11 03:11:37', '2020-04-11 03:12:26', 0),
(24, 13, 1, 2, 20000000, '2020-04-11 03:27:17', '2020-04-11 03:30:25', 0),
(25, 15, 2, 12, 100000000, '2020-04-13 04:06:25', '2020-04-13 04:33:27', 0),
(26, 14, 1, 1, 450000, '2020-04-13 04:06:45', NULL, 0),
(27, 26, 1, 1, 200000, '2020-04-17 16:05:28', NULL, 5),
(28, 27, 1, 1, 45000000, '2020-04-17 16:54:35', NULL, 5),
(29, 28, 1, 2, 10000000, '2020-04-18 02:42:03', NULL, 3),
(30, 29, 1, 1, 4000000, '2020-04-18 04:30:00', NULL, 5),
(31, 30, 1, 1, 68000000, '2020-04-18 04:32:38', NULL, 5),
(32, 31, 1, 1, 79000000, '2020-04-19 01:13:32', NULL, 5),
(33, 32, 1, 1, 10000005, '2020-04-19 04:21:34', NULL, 5),
(34, 33, 2, 4, 10000000, '2020-04-19 04:40:49', NULL, 4),
(35, 34, 1, 1, 100000000, '2020-04-21 06:08:27', NULL, 5),
(36, 36, 2, 4, 9000000, '2020-04-21 06:57:49', NULL, 4),
(37, 37, 2, 8, 50000000, '2020-04-28 09:15:03', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trx_pembelian_barang_remaining`
--

CREATE TABLE `trx_pembelian_barang_remaining` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `rap_biaya_id` bigint(20) NOT NULL,
  `destination_id` bigint(20) NOT NULL COMMENT '1 : office , 2 : project',
  `project_office_id` bigint(20) NOT NULL,
  `jumlah_uang_pembelian` bigint(20) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_pembelian_barang_remaining`
--

INSERT INTO `trx_pembelian_barang_remaining` (`id`, `project_id`, `rap_biaya_id`, `destination_id`, `project_office_id`, `jumlah_uang_pembelian`, `note`, `created_at`, `updated_at`, `last_updated_by`) VALUES
(1, 4, 17, 1, 1, 10000000, NULL, '2020-04-19 04:36:35', NULL, 5),
(2, 4, 18, 2, 4, 10000000, NULL, '2020-04-19 04:43:09', NULL, 4),
(3, 4, 19, 2, 4, 10000000, NULL, '2020-04-19 04:58:37', NULL, 4),
(4, 12, 30, 1, 1, 1000000, NULL, '2020-04-19 12:11:08', NULL, 5),
(5, 8, 35, 2, 8, 10000000, NULL, '2020-04-28 09:16:20', NULL, 4),
(6, 8, 34, 2, 8, 1200000, NULL, '2020-05-02 05:42:37', NULL, 4),
(7, 8, 34, 2, 8, 1200000, NULL, '2020-05-02 05:42:56', NULL, 4),
(8, 8, 35, 2, 8, 1000000, NULL, '2020-05-03 06:31:13', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trx_pengiriman_uang`
--

CREATE TABLE `trx_pengiriman_uang` (
  `id` bigint(20) NOT NULL,
  `organization_id` bigint(20) NOT NULL,
  `destination_id` bigint(20) NOT NULL COMMENT '1 : office , 2 : project',
  `project_office_id` bigint(20) NOT NULL,
  `pengajuan_approval_id` bigint(20) NOT NULL,
  `jumlah_uang` bigint(20) NOT NULL DEFAULT 0,
  `remaining_pembelian` bigint(20) NOT NULL DEFAULT 0,
  `is_buy` int(2) NOT NULL DEFAULT 0 COMMENT '0: no , 1:yes',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_updated_by` int(5) DEFAULT NULL,
  `buy_created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_pengiriman_uang`
--

INSERT INTO `trx_pengiriman_uang` (`id`, `organization_id`, `destination_id`, `project_office_id`, `pengajuan_approval_id`, `jumlah_uang`, `remaining_pembelian`, `is_buy`, `created_at`, `updated_at`, `last_updated_by`, `buy_created_at`) VALUES
(16, 1, 1, 1, 1, 55000000, 0, 1, '2020-03-29 14:58:04', '2020-04-02 05:03:17', 5, '2020-04-02 05:03:17'),
(17, 1, 1, 1, 3, 100000000, 0, 1, '2020-03-30 02:24:07', '2020-04-01 08:54:19', 1, '2020-04-01 08:54:19'),
(18, 1, 2, 4, 4, 25000000, 0, 0, '2020-04-02 02:51:44', NULL, 1, NULL),
(19, 1, 1, 1, 6, 105000000, 0, 1, '2020-04-07 13:32:13', '2020-04-07 13:38:24', 5, '2020-04-07 13:38:24'),
(20, 1, 2, 6, 7, 120000000, 0, 0, '2020-04-07 13:33:22', NULL, 1, NULL),
(21, 1, 1, 2, 8, 500000000, 0, 1, '2020-04-08 15:32:23', '2020-04-08 15:43:19', 3, '2020-04-08 15:43:19'),
(22, 1, 2, 11, 9, 110000000, 0, 1, '2020-04-08 15:32:44', '2020-04-08 15:37:24', 3, '2020-04-08 15:37:24'),
(23, 1, 2, 6, 12, 30000000, 0, 1, '2020-04-11 03:11:37', '2020-04-11 03:12:26', 4, '2020-04-11 03:12:26'),
(24, 1, 1, 2, 13, 20000000, 0, 1, '2020-04-11 03:27:17', '2020-04-11 03:30:25', 5, '2020-04-11 03:30:25'),
(25, 1, 2, 12, 15, 100000000, 0, 1, '2020-04-13 04:06:25', '2020-04-13 04:33:27', 4, '2020-04-13 04:33:27'),
(26, 1, 1, 1, 14, 450000, 250000, 2, '2020-04-13 04:06:45', '2020-04-17 16:05:28', 5, '2020-04-17 16:05:28'),
(27, 1, 1, 1, 17, 50000000, 5000000, 2, '2020-04-17 16:42:38', '2020-04-17 16:54:35', 5, '2020-04-17 16:54:35'),
(28, 1, 1, 2, 18, 13000000, 3000000, 2, '2020-04-18 01:24:34', '2020-04-18 02:42:03', 3, '2020-04-18 02:42:03'),
(29, 1, 1, 1, 19, 9800000, 5800000, 2, '2020-04-18 04:26:14', '2020-04-18 04:30:00', 5, '2020-04-18 04:30:00'),
(30, 1, 1, 1, 20, 98000000, 30000000, 2, '2020-04-18 04:32:13', '2020-04-18 04:32:38', 5, '2020-04-18 04:32:38'),
(31, 1, 1, 1, 21, 99000000, 20000000, 2, '2020-04-19 00:24:01', '2020-04-19 01:13:32', 5, '2020-04-19 01:13:32'),
(32, 1, 1, 1, 22, 20000000, 9999995, 2, '2020-04-19 04:17:58', '2020-04-19 04:21:34', 5, '2020-04-19 04:21:34'),
(33, 1, 2, 4, 23, 21000000, 11000000, 2, '2020-04-19 04:18:07', '2020-04-19 04:40:49', 4, '2020-04-19 04:40:49'),
(34, 1, 1, 1, 10, 100000000, 0, 1, '2020-04-19 12:53:40', '2020-04-21 06:08:27', 5, '2020-04-21 06:08:27'),
(35, 1, 2, 4, 16, 9000000, 0, 0, '2020-04-21 06:40:32', NULL, 1, NULL),
(36, 1, 2, 4, 24, 10000000, 1000000, 2, '2020-04-21 06:56:17', '2020-04-21 06:57:49', 4, '2020-04-21 06:57:49'),
(37, 1, 2, 8, 25, 100000000, 50000000, 2, '2020-04-28 09:12:29', '2020-04-28 09:15:03', 4, '2020-04-28 09:15:03'),
(38, 1, 2, 8, 26, 10000000, 0, 0, '2020-05-04 10:04:32', NULL, 2, NULL),
(39, 1, 2, 8, 27, 1000000, 0, 0, '2020-05-04 10:10:40', NULL, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akk_hutang`
--
ALTER TABLE `akk_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_inventory`
--
ALTER TABLE `akk_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_inventory_project`
--
ALTER TABLE `akk_inventory_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_pengajuan`
--
ALTER TABLE `akk_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_pengajuan_approval`
--
ALTER TABLE `akk_pengajuan_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_pengajuan_biaya`
--
ALTER TABLE `akk_pengajuan_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_rap`
--
ALTER TABLE `akk_rap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akk_rap_biaya`
--
ALTER TABLE `akk_rap_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_inventory_organization`
--
ALTER TABLE `log_inventory_organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_mst_organization`
--
ALTER TABLE `log_mst_organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_jenis_biaya`
--
ALTER TABLE `mst_jenis_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_kas`
--
ALTER TABLE `mst_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_kategori_biaya`
--
ALTER TABLE `mst_kategori_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_material`
--
ALTER TABLE `mst_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_office`
--
ALTER TABLE `mst_office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_office_type`
--
ALTER TABLE `mst_office_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_organization`
--
ALTER TABLE `mst_organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_param`
--
ALTER TABLE `mst_param`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_project`
--
ALTER TABLE `mst_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_role`
--
ALTER TABLE `mst_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_status`
--
ALTER TABLE `mst_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_cash_remaining`
--
ALTER TABLE `trx_cash_remaining`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_pembelian_barang`
--
ALTER TABLE `trx_pembelian_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_pembelian_barang_remaining`
--
ALTER TABLE `trx_pembelian_barang_remaining`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_pengiriman_uang`
--
ALTER TABLE `trx_pengiriman_uang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akk_hutang`
--
ALTER TABLE `akk_hutang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akk_inventory`
--
ALTER TABLE `akk_inventory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `akk_inventory_project`
--
ALTER TABLE `akk_inventory_project`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `akk_pengajuan`
--
ALTER TABLE `akk_pengajuan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `akk_pengajuan_approval`
--
ALTER TABLE `akk_pengajuan_approval`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `akk_pengajuan_biaya`
--
ALTER TABLE `akk_pengajuan_biaya`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `akk_rap`
--
ALTER TABLE `akk_rap`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `akk_rap_biaya`
--
ALTER TABLE `akk_rap_biaya`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `log_inventory_organization`
--
ALTER TABLE `log_inventory_organization`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `log_mst_organization`
--
ALTER TABLE `log_mst_organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mst_jenis_biaya`
--
ALTER TABLE `mst_jenis_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_kas`
--
ALTER TABLE `mst_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_kategori_biaya`
--
ALTER TABLE `mst_kategori_biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_material`
--
ALTER TABLE `mst_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_office`
--
ALTER TABLE `mst_office`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_office_type`
--
ALTER TABLE `mst_office_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_organization`
--
ALTER TABLE `mst_organization`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_param`
--
ALTER TABLE `mst_param`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_project`
--
ALTER TABLE `mst_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mst_role`
--
ALTER TABLE `mst_role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trx_cash_remaining`
--
ALTER TABLE `trx_cash_remaining`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trx_pembelian_barang`
--
ALTER TABLE `trx_pembelian_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `trx_pembelian_barang_remaining`
--
ALTER TABLE `trx_pembelian_barang_remaining`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trx_pengiriman_uang`
--
ALTER TABLE `trx_pengiriman_uang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
