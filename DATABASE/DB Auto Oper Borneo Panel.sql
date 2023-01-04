-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2019 at 03:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panel_sosmed`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` varchar(1500) NOT NULL,
  `tanggal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Frendy Santoso', 'Jangan lupa subscribe like dan share', '15 Nov 2019 14:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `instagram` varchar(30) NOT NULL,
  `facebook` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `jabatan`, `whatsapp`, `instagram`, `facebook`) VALUES
(1, 'Frendy Santoso', 'Developer', '85654008642', 'frndysntoso', 'frendymagic'),
(2, 'Frendy Santoso', 'YouTuber', '85654008642', 'frndysntoso', 'frendymagic');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_saldo`
--

CREATE TABLE `riwayat_saldo` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `aksi` varchar(100) NOT NULL,
  `saldo` bigint(20) NOT NULL,
  `efek` enum('- Saldo','+ Saldo') NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `waktu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_saldo`
--

INSERT INTO `riwayat_saldo` (`id`, `username`, `aksi`, `saldo`, `efek`, `tanggal`, `waktu`) VALUES
(1, 'admin', 'Melakukan pembelian dengan trx ; ', 100, '- Saldo', '09 Nov 2019', '9:34:28'),
(2, 'frendysantoso', 'Mengisikan saldo via Admin', 10000, '+ Saldo', '13 Nov 2019', '10:59:33'),
(3, 'admin', 'Melakukan pembelian dengan trx ; 247321', 2970, '- Saldo', '13 Nov 2019', '13:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_sosmed`
--

CREATE TABLE `riwayat_sosmed` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `layanan` varchar(250) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `target` varchar(100) NOT NULL,
  `trx` bigint(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `start_count` bigint(20) NOT NULL,
  `remains` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_sosmed`
--

INSERT INTO `riwayat_sosmed` (`id`, `username`, `layanan`, `jumlah`, `harga`, `target`, `trx`, `status`, `tanggal`, `waktu`, `start_count`, `remains`) VALUES
(1, 'admin', 'Instagram Followers 1', 10, 100, 'jlfkajsdlfkj', 0, 'Process', '09 Nov 2019', '9:34:28', 0, 0),
(2, 'admin', 'Google Post +1', 20, 2970, 'http://ajlsdkfjalskdjflaskdf.asdofamsdkf', 247321, 'Error', '13 Nov 2019', '13:55:50', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `layanan` varchar(250) NOT NULL,
  `kategori` varchar(250) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `min` bigint(20) NOT NULL,
  `max` bigint(20) NOT NULL,
  `provider_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `layanan`, `kategori`, `harga`, `min`, `max`, `provider_id`) VALUES
(1, 'Instagram Views BP 1 [999K] [REAL - INSTANT]', '*LAYANAN MURAH DAN REKOMENDASI*', 518, 500, 999000, 1),
(2, 'Instagram Auto View', 'Instagram Auto Comments / Impressions / Saves', 2300, 20, 1000000, 2),
(3, ' Youtube Shares', 'Youtube Likes / Comments /', 40250, 500, 150000, 3),
(4, 'SoundCloud Followers R1', 'SoundCloud', 39100, 20, 1000000, 4),
(5, ' SoundCloud Plays', 'SoundCloud', 1725, 20, 10000000, 5),
(6, 'Pinterest Followers', 'Pinterest', 46200, 20, 1000000000, 6),
(7, ' Telegram Channel Members', 'Telegram', 35650, 100, 25000, 7),
(8, 'Telegram Post Views', 'Telegram', 75900, 100, 5000, 8),
(9, 'Google Followers', 'Google', 126500, 100, 7000, 9),
(10, 'Google Website +1', 'Google', 286000, 50, 5000, 10),
(11, 'Google Post +1', 'Google', 148500, 20, 2000, 11),
(12, 'Google Reshares', 'Google', 148500, 20, 2000, 12),
(13, 'Instagram Views  [300k Per Day]', 'Instagram Views', 2185, 100, 999000, 13),
(14, 'Instagram Story Views UNLIMITED (USERNAME ONLY) (S', 'Instagram Story / Impressions / Saves /  Reach', 6325, 50, 10000000, 14),
(15, 'Instagram Story Views [20k] (USERNAME ONLY) (S2)', 'Instagram Story / Impressions / Saves /  Reach', 10925, 100, 20000, 15),
(16, 'Instagram Impressions [20k] [INSTANT] (S1)', 'Instagram Story / Impressions / Saves /  Reach', 1150, 500, 20000, 16),
(17, '	Instagram Auto Views (Fast Speed)', 'Instagram Auto Comments / Impressions / Saves', 3450, 100, 60000, 17),
(18, 'Twitter Views (INSTANT)', 'Twitter Views / Impressions / Live / Comments', 27600, 100, 1000000, 18),
(19, 'Twitter Impressions (INSTANT)', 'Twitter Views / Impressions / Live / Comments', 27600, 100, 1000000, 19),
(20, 'Instagram Impressions [1M]', 'Instagram Auto Comments / Impressions / Saves', 2415, 100, 1000000, 20),
(21, 'Instagram Story Views [30K]', 'Instagram Story / Impressions / Saves /  Reach', 6094, 100, 30000, 21),
(22, 'Instagram Last Story S1 - Only Username - No Refun', 'Instagram Story / Impressions / Saves /  Reach', 3105, 500, 10000, 22),
(23, 'IGTV Random Comments [1M]', 'Instagram TV', 36800, 10, 10000000, 23),
(24, 'IGTV Random Emoji Comments [1M]', 'Instagram TV', 36800, 10, 10000000, 24),
(25, 'Website Traffic [1M] ', 'Website Traffic', 2760, 1000, 100000000, 25),
(26, 'Website Traffic [10M] [WW]', 'Website Traffic', 10580, 100, 100000000, 26),
(27, 'Website Traffic From Facebook [10M] [WW]', 'Website Traffic', 10580, 100, 1000000000, 27),
(28, 'Website Traffic From Instagram [10M] [WW] ', 'Website Traffic', 10580, 100, 1000000000, 28),
(29, 'Instagram - Live Video Likes ( INSTANT )', 'Instagram Live Video', 10235, 200, 100000, 29),
(30, 'Instagram Impressions [1M] REAL', 'Instagram Likes / Likes + Impressions', 1495, 100, 10000000, 30),
(31, 'Instagram Impressions [100K] ', 'Instagram Likes / Likes + Impressions', 4083, 10, 1000000, 31),
(32, 'Facebook Video Views (10K-20K) Instant Start', 'Facebook Video Views / Live Stream', 4428, 1000, 100000000, 32),
(33, '  Instagram - TV Random Comments [ Instant ]', 'Instagram TV', 40423, 10, 1000000, 33),
(34, 'Instagram Story Views [15K] [ALL POSTS]', 'Instagram Story / Impressions / Saves /  Reach', 196, 100, 15000, 34),
(35, 'Instagram Impressions [10M] [EXPLORE - HOME - LOCA', 'Instagram Story / Impressions / Saves /  Reach', 1553, 100, 2147483647, 35),
(36, 'Instagram Story Views [MALE] [30K] ', 'Instagram Story / Impressions / Saves /  Reach', 7935, 20, 30000, 36),
(37, 'Instagram Story Views [FEMALE] [30K] ', 'Instagram Story / Impressions / Saves /  Reach', 7935, 20, 30000, 37),
(38, 'Ä°nstagram Saves 15K', 'Instagram Story / Impressions / Saves /  Reach', 213, 100, 15000, 38),
(39, 'Youtube - Likes [ Ultrafast ] [ Max 400k ] SUPER I', 'Youtube Likes / Comments /', 143000, 100, 400000, 39),
(40, 'Twitter Poll Votes [10M] !', 'Twitter Poll Votes', 16790, 100, 2147483647, 40),
(41, 'Twitter Followers [5K] [MIX] [7 DAYS REFILL]', 'Twitter Followers', 79200, 20, 5000, 41),
(42, 'SoundCloud Likes [1M] ', 'SoundCloud', 33925, 20, 10000000, 42),
(43, 'Instagram - Story Views [LAST STORY ONLY] [ Max - ', 'Instagram Story / Impressions / Saves /  Reach', 2530, 20, 30000, 43),
(44, 'Instagram - Highlights Views [ Max - 20k ] INSTANT', 'Instagram Story / Impressions / Saves /  Reach', 39560, 20, 20000, 44),
(45, 'Instagram Auto Views + Impressions [10M] [EXPLORE ', 'Instagram Story / Impressions / Saves /  Reach', 2013, 100, 1000000, 45),
(46, 'Instagram - Story Views [ Superfast ] INSTANT', 'Instagram Story / Impressions / Saves /  Reach', 288, 100, 100000, 46),
(47, ' Youtube - Likes [ NON DROP ] [ 100K/DAY ] [ Start', 'Youtube Likes / Comments /', 390500, 100, 1000000, 47),
(48, 'Facebook Video Views | Speed 300k - 500k ( Instant', 'Facebook Video Views / Live Stream', 2759, 100, 1000000000, 48),
(49, 'Youtube Likes ( Super Fast ) [ Min 10 : Max 10k ] ', 'Youtube Likes / Comments /', 149600, 10, 10000, 49),
(50, 'Instagram Views Real Indonesia [10K]', 'Instagram Views', 575, 100, 10000, 50),
(51, 'Telegram Channnel Members [100K] ', 'Telegram', 37950, 100, 100000, 51),
(52, 'Youtube Live Stream Views [MONETIZABLE] [REAL] ', 'Youtube Live Stream', 35363, 5000, 5000, 52),
(53, 'Facebook Video Views (10K-20K) Instant Start 2', 'Facebook Video Views / Live Stream', 2473, 100, 100000, 53),
(54, 'Twitter Followers ( Min 25 | Max 2500 ) ( No Refil', 'Twitter Followers', 57420, 500, 2500, 54),
(55, 'Instagram Photo Impression + Location + Explore +H', ' Instagram Highlights / Profile Visits / Reach', 1139, 100, 100000, 55),
(56, 'Instagram Highlight Views [25K]', ' Instagram Highlights / Profile Visits / Reach', 42550, 20, 25000, 56),
(57, 'Instagram Video Reach [MIN 100 MAX 30K]', ' Instagram Highlights / Profile Visits / Reach', 12190, 100, 30000, 57),
(58, 'Instagram Story Views [5K] - All Story BIG', 'Instagram Story / Impressions / Saves /  Reach', 1840, 500, 5000, 58),
(59, '  Instagram Views + Impressions [3M] [FROM HOME] ', 'Instagram Views', 805, 20, 3000000, 59),
(60, '  Youtube Comment Likes [UPVOTES] [50K] [REAL] ', 'Youtube Likes / Comments /', 101750, 100, 50000, 60),
(61, '  Youtube Comment DisLikes [DOWNVOTES] [100K] [REA', 'Youtube Likes / Comments /', 101750, 10, 100000, 61),
(62, 'Instagram Profile Visits / Views [20K] ', 'Instagram Story / Impressions / Saves /  Reach', 7130, 1000, 20000, 62),
(63, 'Youtube Premiere Waiting Views [+ Likes] [REAL] ,', 'Youtube Live Stream', 24150, 5000, 5000, 63),
(64, 'Youtube DisLikes [3K] [REFILL 10DAYS] NEW ', 'Youtube Likes / Comments /', 96800, 5, 3000, 64),
(65, 'Youtube Likes [5K] [REFILL 10DAYS] NEW', 'Youtube Likes / Comments /', 96030, 5, 5000, 65),
(66, 'Youtube views [Monetized Views - No Refill] [Speed', 'Youtube Views', 15410, 1000, 5000, 66),
(67, '  Tik Tok Video Shares [10M]', 'TIKTOK', 2473, 100, 100000, 67),
(68, 'Youtube Views [10M] [FAST] [Râˆž] ', 'Youtube Views', 35765, 1000, 1000000, 68),
(69, 'Spotify Followers [100K] [FRANCE]', 'Spotify', 62590, 100, 5000, 69),
(70, 'Spotify Followers [PLAYLIST] [FRANCE] (5k)', 'Spotify', 62590, 100, 5000, 70),
(71, 'Spotify Plays [10M] [30Days Refill]', 'Spotify', 15525, 1000, 10000000, 71),
(72, 'Youtube Views [1M] [ Speed 30k - 50k ] Lifetime Gu', 'Youtube Views', 30360, 1000, 1000000, 72),
(73, 'Youtube Views [100K-300K] Lifetime Guaranteed [Rec', 'Youtube Views', 37375, 500, 1000000, 73),
(74, 'Youtube Views [ 100k-300k/day ] [ Life Time Guaran', 'Youtube Views', 34500, 500, 100000, 74),
(75, 'Bigo 1 Hours Live Stream Views [400]', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 40250, 1000, 1000, 75),
(76, 'Bigo 1 Hours Live Stream Views [500] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 71500, 1000, 1000, 76),
(77, ' Bigo 1 Hours Live Stream Views [600] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 115500, 1000, 1000, 77),
(78, ' Bigo 1 Hours Live Stream Views [700] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 154000, 1000, 1000, 78),
(79, 'CubeTV 1 Hours Live Stream Views [250] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 27600, 1000, 1000, 79),
(80, ' CubeTV 1 Hours Live Stream Views [500] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 42550, 1000, 1000, 80),
(81, 'NimoTV 1 Hours Live Stream Views [200]', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 27600, 1000, 1000, 81),
(82, ' NimoTV 1 Hours Live Stream Views [400]', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 44000, 1000, 1000, 82),
(83, 'NimoTV 1 Hours Live Stream Views [600] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 66000, 1000, 1000, 83),
(84, ' NimoTV 1 Hours Live Stream Views [800] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 93500, 1000, 1000, 84),
(85, ' NimoTV 1 Hours Live Stream Views [1K] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 121000, 1000, 1000, 85),
(86, 'Youtube views [Lifetime warranty] [SpeedUp 50 - 25', 'Youtube Views', 18055, 1000, 10000, 86),
(87, 'Youtube views [Monetized Views] No Refill - Start ', 'Youtube Views', 14318, 1000, 10000, 87),
(88, 'Youtube VIDEO Views [50K-100K/Day] ', 'Youtube Views', 28635, 1000, 100000000, 88),
(89, 'SoundCloud Plays [1.5M] [S1] ', 'SoundCloud', 633, 100, 1000000, 89),
(90, 'SoundCloud Plays [10M] [S2]', 'SoundCloud', 483, 5000, 1000000, 90),
(91, 'Facebook Page Likes [20K] - Refill 30Days ', 'Facebook Page Likes', 182050, 50, 20000, 91),
(92, 'Indonesia Traffic from Google [10K/Day] ', 'Website Traffic [Targeted]', 16330, 500, 50000, 92),
(93, 'Indonesia Traffic from Quora [2K/Day] ', 'Website Traffic [Targeted]', 16330, 500, 50000, 93),
(94, 'Indonesia Traffic from Tumblr [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 94),
(95, 'Indonesia Traffic from Pinterest [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 95),
(96, 'Indonesia Traffic from Twitter [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 96),
(97, 'Indonesia Traffic from Reddit [2K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 97),
(98, 'Indonesia Traffic from YouTube [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 98),
(99, 'Indonesia Traffic from Facebook [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 99),
(100, 'Indonesia Traffic from Instagram [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 100),
(101, 'Indonesia Traffic from Blogger.com [10K/Day]', 'Website Traffic [Targeted]', 16330, 500, 50000, 101),
(102, 'Youtube Views [50k-100k ] [Lifetime] ] [Special]', 'Youtube Views', 27600, 100, 2147483647, 102),
(103, 'Youtube Views - Up 100K/ day [FAST] Refill', 'Youtube Views', 26335, 1000, 2000000, 103),
(104, 'Youtube Views [10M] - 500K/Day [Refill]', 'Youtube Views', 31280, 100, 10000000, 104),
(105, 'Twitter Followers [500] - 50/Day [Refill 10Days] ', 'Twitter Followers', 58355, 100, 500, 105),
(106, ' Instagram Followers [10K] 0-30 MINUTE START [MINI', '*LAYANAN MURAH DAN REKOMENDASI*', 20125, 1000, 10000, 106),
(107, 'Instagram Likes [Max 10K] [ALWAYS INSTANT ]', 'Instagram Likes', 23575, 50, 10000, 107),
(108, ' Instagram Likes MAX 1K [HQ ACCOUNT] ', 'Instagram Likes', 31050, 500, 1000, 108),
(109, 'Instagram Likes [2K] - Fast - Exclusive', 'Instagram Likes', 26163, 100, 2000, 109),
(110, 'Facebook Photo / Post Likes [ 10K ] -  Start Insta', 'Facebook Post Likes / Comments / Shares / Events', 54560, 25, 10000, 110),
(111, 'Tik Tok Views - Speed 100k/Day', 'TIKTOK', 863, 1000, 5000000, 111),
(112, 'Tik Tok Shares [ 100k/Day ] Non Drop', 'TIKTOK', 2185, 1000, 10000000, 112),
(113, 'Facebook Post Likes [10K] Instant [ No refill ]', 'Facebook Post Likes / Comments / Shares / Events', 67870, 50, 10000, 113),
(114, 'Youtube Subscriber [Max 1500] Total 80K - 30 days ', 'Youtube Subscribers ', 355300, 5, 1500, 114),
(115, 'Facebook Post Likes [15K] - 2K/Day [ Refill 14Days', 'Facebook Post Likes / Comments / Shares / Events', 95150, 100, 15000, 115),
(116, 'Facebook Emoji Post Likes [10K] [RANDOM] ', 'Facebook Post Likes / Comments / Shares / Events', 44620, 100, 10000, 116),
(117, 'Instagram Followers [100K]  [REFILL 30 DAYS] - 15K', 'Instagram Followers [Refill] [Guaranteed] [NonDrop]', 75350, 100, 100000, 117),
(118, 'Instagram Likes [New 500K] - 5K/Day Instant', 'Instagram Likes', 33925, 20, 500000, 118),
(119, 'Instagram Likes [50k] - Speed 1k-2k/Day  Instant', 'Instagram Likes', 34385, 50, 50000, 119),
(120, 'Youtube Likes [5K] - 200/Day [Refill 30Days]', 'Youtube Likes / Comments /', 86900, 50, 5000, 120),
(121, 'Youtube Views [100M] [Refill 30Days] - 3M/Day', 'Youtube Views', 23575, 1000, 100000000, 121),
(122, 'Instagram Likes [Max 3K] - Exclusive ', 'Instagram Likes', 37260, 100, 3000, 122),
(123, 'Instagram Likes - Min 25 Max 1K HQ', 'Instagram Likes', 32315, 25, 200, 123),
(124, 'Shopee Followers [2K] [BOT] [INDONESIA] [KEDIP] [U', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 8050, 50, 2000, 124),
(125, 'Bukalapak Pelanggan Indonesia [BOT] [5K] [USERNAME', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 3450, 50, 5000, 125),
(126, 'Bukalapak Product Likes / Favorit Indonesia [5K] ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 2300, 50, 5000, 126),
(127, 'Bukalapak Product Views Indonesia [5K]', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 2875, 50, 5000, 127),
(128, 'Youtube Subscriber [10K] [REFILL 30DAYS] Start 0-4', 'Youtube Subscribers ', 305800, 50, 10000, 128),
(129, 'Instagram Followers [MAX 50K] - Instant 1hour ', 'Instagram Followers No Refill/Not Guaranteed', 86240, 300, 50000, 129),
(130, 'JANGAN DI ORDER YA [ 1K] [KHUSUS] PRIVAT FOLL [KOP', 'ZPRIVAT NOTE ORDER', 55000, 50, 1000, 130),
(131, 'JANGAN DI ORDER YA [ 5K] [KHUSUS] PRIVAT FOLL [KOP', 'ZPRIVAT NOTE ORDER', 55000, 50, 3500, 131),
(132, 'JANGAN DI ORDER YA [ 5K] [KHUSUS] PRIVAT LIKE YES ', 'ZPRIVAT NOTE ORDER', 55000, 50, 5000, 132),
(133, 'Shopee Followers [5K] [BOT] [INDONESIA] [KEDIP] [U', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 28750, 50, 5000, 133),
(134, '  Shopee Likes Indonesia Bot [5K] Shopee Favorite ', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 8625, 50, 5000, 134),
(135, 'PRIVAT [BOT] [4K] JANGAN ORDER YA BL FOLL', 'ZPRIVAT NOTE ORDER', 55000, 50, 4000, 135),
(136, 'PRIVAT [BOT] [4K] JANGAN ORDER YA BL LIKE', 'ZPRIVAT NOTE ORDER', 55000, 50, 4000, 136),
(137, 'PRIVAT [BOT] [4K] JANGAN ORDER YA BL VIEWS', 'ZPRIVAT NOTE ORDER', 55000, 50, 4000, 137),
(138, 'Twitter Followers [MAX 20K] No refill - Start 0-6 ', 'Twitter Followers', 57035, 500, 200000, 138),
(139, 'Instagram TV Views [5M/day] ', 'Instagram TV', 2243, 200, 100000000, 139),
(140, 'Instagram Followers [250K] [REFILL 30DAYS] - Insta', 'Instagram Followers [Refill] [Guaranteed] [NonDrop]', 67540, 100, 250000, 140),
(141, 'Youtube Views [10k-50k] High Retention - instant S', 'Youtube Views', 24380, 500, 2147483647, 141),
(142, 'Instagram Followers [MAX 10K] NO REFILL', 'Instagram Followers No Refill/Not Guaranteed', 47850, 100, 10000, 142),
(143, 'Ä°nstagram All Views Story [5k]', 'Instagram Story / Impressions / Saves /  Reach', 9545, 100, 5000, 143),
(144, 'Instagram All Story - Instant Start', 'Instagram Story / Impressions / Saves /  Reach', 3910, 100, 5000, 144),
(145, 'Ä°nstagram Last Story Max 5k', 'Instagram Story / Impressions / Saves /  Reach', 2645, 100, 5000, 145),
(146, ' Facebook Page Likes [MAX 25]  [30 Days Refill] 1-', 'Facebook Page Likes', 160270, 100, 25000, 146),
(147, 'Twitter Followers [4K] [30 Days Refill ] - Instant', 'Twitter Followers', 80190, 50, 4000, 147),
(148, 'Instagram Likes [MAX 100K] ', 'Instagram Likes', 26910, 20, 100000, 148),
(149, 'Instagram Views [3M] INSTANT', 'Instagram Views', 574, 500, 3000000, 149),
(150, 'Instagram Views [999K] INSTANT ', 'Instagram Views', 633, 500, 999000, 150),
(151, 'Instagram Views + Impressions [1M] Instant start', 'Instagram Views', 861, 500, 1000000, 151),
(152, 'Instagram Likes [MAX 500K]  - Instant', 'Instagram Likes', 24725, 20, 500000, 152),
(153, 'SHOPEE PRODUK TERJUAL 1 [ 500 PRODUK TERJUAL &20 L', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 132000, 500, 500, 153),
(154, 'PRODUK TERJUAL PAKET 2 [ 1K PRODUK TERJUAL &30 LOV', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 132000, 1000, 1000, 154),
(155, 'Instagram Views  Max 100k - Instant Recommended ', 'Instagram Views', 989, 1000, 10000000, 155),
(156, 'Instagram Views  Max 60k - INSTANT Superfast', 'Instagram Views', 2588, 100, 60000, 156),
(157, 'Instagram Views SuperFast - 500k/day', 'Instagram Views', 1242, 5000, 50000000, 157),
(158, 'Instagram Followers [MAX 20K] - Refill 15Days', 'Instagram Followers [Refill] [Guaranteed] [NonDrop]', 67650, 100, 20000, 158),
(159, 'Instagram Followers Indonesia [MIN 1K - MAX 1K] [B', 'Instagram Followers Indonesia', 88000, 1000, 1000, 159),
(160, 'Instagram Followers Indonesia [500] [ NEW  ] [ BET', 'Instagram Followers Indonesia', 73700, 100, 500, 160),
(161, 'Instagram Likes [Max 5k] Instant Start', 'Instagram Likes', 39790, 100, 5000, 161),
(162, 'Instagram Likes [ INSTANT ALWAYS] [10K]', 'Instagram Likes', 23575, 100, 10000, 162),
(163, 'Instagram Likes [Max 2K] Instant - 2Hours', 'Instagram Likes', 40710, 100, 2000, 163),
(164, 'Instagram Followers [25K] [Refill 15Days] - Instan', 'Instagram Followers [Refill] [Guaranteed] [NonDrop]', 75240, 100, 25000, 164),
(165, 'IGTV Views [100M] Instant - 500K/Day', 'Instagram TV', 1058, 50, 100000000, 165),
(166, 'Instagram Likes Indonesia [2K] NAIKIN PROFILE VISI', 'Instagram Likes Indonesia', 43700, 100, 1000, 166),
(167, 'PRODUK TERJUAL PAKET 3[1K PRODUK TERJUAL, 5 RATING', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 330000, 1000, 1000, 167),
(168, 'Instagram Likes [SLow] [ Max 50k]', 'Instagram Likes', 29785, 100, 50000, 168),
(169, 'Instagram Likes - Max 10K [ 5k/day] Instant Start', 'Instagram Likes', 36685, 10, 10000, 169),
(170, 'Instagram TV Views [1M/day] Instant', 'Instagram TV', 1139, 500, 10000000, 170),
(171, 'Instagram Saves [ Max 2k ]', 'Instagram Story / Impressions / Saves /  Reach', 523, 10, 2000, 171),
(172, 'Instagram Likes [ Max 100k ] INSTAN 1Hours', 'Instagram Likes', 41630, 20, 100000, 172),
(173, 'Instagram Likes Max [15K] [ INSTANT ]', 'Instagram Likes', 36225, 10, 10000, 173),
(174, 'Instagram TV Views [1M/day] [ Cheapest in market]', 'Instagram TV', 863, 500, 10000000, 174),
(175, 'Instagram Saves [ Max 2k ] INSTANT .', 'Instagram Story / Impressions / Saves /  Reach', 288, 50, 2000, 175),
(176, 'Instagram Followers FAST  - 2K - Instant Start - [', 'Instagram Followers No Refill/Not Guaranteed', 61600, 200, 1000, 176),
(177, 'Instagram Followers Indonesia MIN 1K MAX 1K [S2]', 'Instagram Followers Indonesia', 86900, 1000, 1000, 177),
(178, 'Instagram Likes Instant [200K] [ EMERGENCY ] [EXLU', 'Instagram Likes', 32200, 10, 200000, 178),
(179, 'Instagram Followers Indonesia [NEW DB] [Min 100 MA', 'Instagram Followers Indonesia', 88000, 100, 500, 179),
(180, 'Youtube Likes [ Max 5K ] - 30 Days Refill', 'Youtube Likes / Comments /', 78100, 50, 5000, 180),
(181, 'Youtube Subscribers [MAX 5K] - REFILL 30DAYS', 'Youtube Subscribers ', 194150, 10, 5000, 181),
(182, 'Tokopedia Followers Indonesia [ Max 5K ] INSTAN', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 32200, 50, 5000, 182),
(183, 'Tokopedia Product Wishlist [Max 5K] INSTANT', 'Shopee/BukaLapak/Tokopedia / BIGO / CubeTV / NimoTV/', 16675, 100, 5000, 183),
(184, 'Instagram Likes [20K] Instant ', 'Instagram Likes', 32545, 50, 20000, 184),
(185, 'Instagram Likes [1K] 20-50 Likes/ Hour', 'Instagram Likes', 19435, 20, 1000, 185),
(186, 'Instagram Likes [10K] Instant 0-6Hours', 'Instagram Likes', 25070, 20, 10000, 186),
(187, 'Instagram Likes [12K] INSTANT - Start', 'Instagram Likes', 27600, 50, 12000, 187),
(188, 'Instagram Likes + Impressions + Reach [5K]', 'Instagram Likes / Likes + Impressions', 31050, 20, 5000, 188),
(189, 'Instagram Views [10M] Instant', 'Instagram Views', 598, 200, 100000, 189),
(190, 'Instagram Views [500K] Instant - Fast', 'Instagram Views', 804, 100, 1000000, 190),
(191, 'IGTV Views [5M] Instant - 1Hours', 'Instagram TV', 978, 200, 5000000, 191),
(192, 'Instagram Followers [ Max 20K] Up 2-3k/day - Refil', 'Instagram Followers [Refill] [Guaranteed] [NonDrop]', 83490, 100, 20000, 192),
(193, 'Instagram Views + Impressions + Profile Visit [ 10', 'Instagram Views', 1438, 500, 10000000, 193),
(194, 'IG Impressions + Profile Visits [250K] - Super Ins', ' Instagram Highlights / Profile Visits / Reach', 1265, 250, 250000, 194);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` varchar(50) NOT NULL,
  `saldo` bigint(20) NOT NULL,
  `saldo_terpakai` bigint(20) NOT NULL,
  `nohp` bigint(20) NOT NULL,
  `status` enum('On','Off') NOT NULL,
  `tgl_reg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `saldo`, `saldo_terpakai`, `nohp`, `status`, `tgl_reg`) VALUES
(1, 'admin', '$2y$10$L6ekfjktkd3iO1sGnmZaZOC3zxVchtva3.ZxxmadL9rD2gDsOKx4O', 'Admin', 996930, 3070, 85654008642, 'On', 'Sekarang'),
(3, 'member', '$2y$10$cC3ieqHYQsIyaX1xvNxoiO53K7aDRRalycY8lUArLz01ussvj7Cuq', 'Member', 10000, 0, 9709801394, 'On', '13 Nov 2019 14:28:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_saldo`
--
ALTER TABLE `riwayat_saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_sosmed`
--
ALTER TABLE `riwayat_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat_saldo`
--
ALTER TABLE `riwayat_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_sosmed`
--
ALTER TABLE `riwayat_sosmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
