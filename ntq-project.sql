-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2015 at 11:21 PM
-- Server version: 5.5.42
-- PHP Version: 5.4.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ntq-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `ct_id` int(5) NOT NULL,
  `ct_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ct_status` tinyint(1) NOT NULL,
  `ct_time_created` datetime NOT NULL,
  `ct_time_update` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ct_id`, `ct_name`, `ct_status`, `ct_time_created`, `ct_time_update`) VALUES
(1, 'Category 1', 1, '2015-06-04 06:22:12', '2015-06-17 02:15:06'),
(2, 'Category 1231', 1, '2015-06-04 06:18:10', '2015-06-22 12:51:43'),
(3, 'Category 2', 1, '2015-06-04 13:10:20', '2015-06-17 10:28:19'),
(4, 'Category 3', 0, '2015-06-04 07:19:16', '2015-06-17 12:01:02'),
(5, 'Category 4', 1, '2015-06-04 09:13:21', '2015-06-17 02:15:07'),
(6, 'Category 5', 1, '2015-06-07 12:55:40', NULL),
(7, 'Category 6', 1, '2015-06-07 12:58:16', NULL),
(13, 'Category 7', 0, '2015-06-07 11:54:53', '2015-06-10 03:55:54'),
(14, 'Category 8', 1, '2015-06-07 11:56:45', NULL),
(15, 'Category 9', 0, '2015-06-08 01:59:33', '2015-06-18 10:18:07'),
(16, 'Category 10', 0, '2015-06-08 02:00:10', '2015-06-10 03:55:54'),
(20, 'Category 11', 1, '2015-06-08 02:09:05', NULL),
(21, 'Category 12', 1, '2015-06-08 02:12:44', NULL),
(22, 'Category 14', 0, '2015-06-08 02:16:36', '2015-06-10 03:56:10'),
(24, 'Category 16', 1, '2015-06-08 02:18:56', '2015-06-08 03:14:26'),
(25, 'Category 17', 0, '2015-06-09 11:08:25', '2015-06-10 03:56:10'),
(26, 'Category 18', 1, '2015-06-09 11:10:04', '2015-06-10 12:11:41'),
(27, 'Category 30', 0, '2015-06-09 11:11:28', '2015-06-10 09:54:54'),
(28, 'Category 20', 1, '2015-06-10 12:10:35', '2015-06-10 12:10:54'),
(29, 'Category 21', 0, '2015-06-10 12:18:35', NULL),
(30, 'Category 22', 0, '2015-06-10 12:19:52', NULL),
(31, 'Category 23', 0, '2015-06-10 12:41:34', NULL),
(32, 'Category 24', 1, '2015-06-10 12:44:53', '2015-06-10 12:48:17'),
(35, 'Category 25', 0, '2015-06-10 01:13:13', NULL),
(38, 'Category 26', 1, '2015-06-10 01:30:09', NULL),
(39, 'Category 28', 0, '2015-06-10 01:36:33', '2015-06-10 01:47:07'),
(40, 'Category 29', 0, '2015-06-10 02:03:53', '2015-06-10 09:55:27'),
(41, 'Category 31', 1, '2015-06-10 10:45:40', NULL),
(42, 'Category 32', 1, '2015-06-10 10:57:02', NULL),
(43, 'Category 33', 0, '2015-06-12 09:45:09', '2015-06-12 09:45:29'),
(44, 'Category 35', 0, '2015-06-15 11:35:29', '2015-06-15 11:35:44'),
(45, 'Category 36', 1, '2015-06-16 09:11:13', NULL),
(46, 'Category 37', 1, '2015-06-17 11:27:38', '2015-06-17 11:27:55'),
(47, 'Category 38', 1, '2015-06-17 01:20:16', NULL),
(48, 'Category 39', 0, '2015-06-18 09:21:17', '2015-06-18 09:21:29'),
(49, 'Category 40', 1, '2015-06-18 10:05:48', NULL),
(50, 'Category 41', 1, '2015-06-18 10:07:48', '2015-06-18 10:08:04'),
(51, 'Category 42', 1, '2015-06-18 10:17:41', NULL),
(52, 'Category 43', 1, '2015-06-20 08:07:39', NULL),
(55, 'Category 50', 0, '2015-06-20 09:22:30', NULL),
(56, 'Category 1111', 0, '2015-06-20 09:28:02', NULL),
(57, 'Category 206', 1, '2015-06-20 09:29:43', NULL),
(58, 'Category 207', 1, '2015-06-20 09:29:55', NULL),
(59, 'Category 208', 1, '2015-06-20 09:32:08', NULL),
(60, 'Category 209', 1, '2015-06-20 09:34:21', NULL),
(61, 'Category 210', 1, '2015-06-20 09:34:51', NULL),
(62, 'Category 1900', 1, '2015-06-20 09:36:33', NULL),
(63, 'Category 999', 0, '2015-06-20 09:45:28', NULL),
(64, 'Category 189', 1, '2015-06-20 09:51:04', NULL),
(65, 'Category 2087', 1, '2015-06-20 09:52:14', NULL),
(66, 'Category 20877', 1, '2015-06-20 09:52:49', NULL),
(67, 'Category 20872', 1, '2015-06-20 09:54:59', NULL),
(68, 'Category 2062', 1, '2015-06-20 09:57:47', NULL),
(69, 'Category 20622', 1, '2015-06-20 09:58:25', NULL),
(70, 'Category 20322', 1, '2015-06-20 09:59:17', NULL),
(71, 'Category 2071', 1, '2015-06-20 10:02:32', NULL),
(72, 'Category 20612', 1, '2015-06-20 10:03:06', NULL),
(73, 'Category 433', 1, '2015-06-20 10:04:20', NULL),
(74, 'Category 4333', 1, '2015-06-20 10:05:59', NULL),
(75, 'Category 423', 1, '2015-06-20 10:08:11', NULL),
(76, 'Category 424', 1, '2015-06-20 10:08:32', NULL),
(77, '123', 1, '2015-06-20 10:09:46', NULL),
(78, 'Category 1232', 1, '2015-06-20 10:10:26', NULL),
(79, 'Category 4343', 1, '2015-06-20 10:10:49', NULL),
(80, 'ads', 1, '2015-06-20 10:11:59', NULL),
(81, 'adsd', 0, '2015-06-20 10:12:18', '2015-06-20 10:26:29'),
(82, 'Category 4322', 0, '2015-06-20 10:19:42', '2015-06-20 10:26:29'),
(83, 'Category 4331', 0, '2015-06-20 10:20:07', '2015-06-20 10:26:29'),
(88, '&lt;script&gt;2&lt;/script&gt;', 0, '2015-06-20 10:26:15', '2015-06-20 10:26:29'),
(89, 'Category 1234', 0, '2015-06-22 12:41:49', '2015-06-22 12:44:00'),
(90, 'Category 2081', 1, '2015-06-22 12:53:41', '2015-06-22 12:53:41'),
(91, '', 1, '2015-06-22 12:53:14', '2015-06-22 12:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pd_id` int(5) NOT NULL,
  `pd_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pd_price` int(10) NOT NULL,
  `pd_des` text COLLATE utf8_unicode_ci NOT NULL,
  `pd_img` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pd_status` tinyint(1) NOT NULL,
  `pd_time_created` datetime NOT NULL,
  `pd_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pd_id`, `pd_name`, `pd_price`, `pd_des`, `pd_img`, `pd_status`, `pd_time_created`, `pd_time_updated`) VALUES
(3, 'Product 3', 160000, 'product 3 product 3  product 3  product 3  product 3 ', 'bk.png', 0, '2015-06-16 02:04:42', '2015-06-17 11:12:55'),
(4, 'Product 4', 120000, 'Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4', 'bk.png', 1, '2015-06-16 03:31:16', '2015-06-17 11:44:09'),
(5, 'Product 5', 170000, 'skja ldj akl jdlsa jdklsaj kljdklajd klsj lkdajk lsjkl d', 'quan_ly_tai_khoan - New Page.png', 1, '2015-06-17 01:21:41', NULL),
(6, 'Product 6', 43243, 'sa,dm,as.,.as ', 'BPMN 2.0 - New Page(1).png', 0, '2015-06-18 10:21:42', '2015-06-18 10:23:12'),
(7, 'Product 7', 170000, 'skdljslj ljdlsakjdk las', 'quan_ly_tai_khoan - New Page.png', 1, '2015-06-18 10:24:39', '2015-06-18 10:25:16'),
(8, 'Product 9', 21321, 'asdsa asdas dasdsa', 'Screenshot from 2015-06-21 21:23:30.png', 1, '2015-06-22 01:23:20', NULL),
(10, 'Product 3', 21321, 'ghj ghjg gjghj', 'Screenshot from 2015-06-21 21:23:30.png', 1, '2015-06-22 01:27:58', '2015-06-22 01:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `privilege` tinyint(4) NOT NULL,
  `user_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_img` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_time_created` datetime NOT NULL,
  `user_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `status`, `privilege`, `user_email`, `user_img`, `user_time_created`, `user_time_updated`) VALUES
(1, 'bactv', '96e79218965eb72c92a549dd5a330112', 1, 1, NULL, '6.jpg', '0000-00-00 00:00:00', '2015-06-17 08:48:41'),
(4, 'User 1', 'sadsadsadsad90089', 1, 0, NULL, NULL, '2015-06-10 05:30:08', '2015-06-16 08:30:52'),
(5, 'User 2', 'sdsad89089as0d890as', 0, 0, NULL, NULL, '2015-06-03 10:07:37', '2015-06-16 08:30:59'),
(6, 'User 3', '345ca9e2eae58cef08b92066d47a7c42', 1, 0, NULL, 'Truong Van Bac.png', '2015-06-16 02:16:12', '2015-06-16 08:30:52'),
(7, 'User 4', '6face0b016a7b7662c2fcab45e9f6f91', 0, 0, 'kdaslkdlsad', 'Untitled.png', '2015-06-16 09:29:17', '2015-06-17 07:23:56'),
(8, 'User 5', '8c8f5c0eea0376fc6e4b8654eb00c7ee', 0, 0, 'bac.bkhn.k57@gmail.com', 'BPMN 2.0 - New Page(1).png', '2015-06-16 11:22:32', '2015-06-17 07:23:56'),
(9, 'User 6', 'f4e55449d8ef2e03307371d4e029d0a1', 0, 0, 'aslasl;dkls;akdls', 'quan_ly_tai_khoan - New Page.png', '2015-06-17 07:23:40', '2015-06-17 07:23:47'),
(10, 'User 7', '2302619b3b5e9d53ce1598b4324c35af', 1, 0, 'nklfdskl lklkdl ', 'BPMN 2.0 - New Page(1).png', '2015-06-17 08:21:16', NULL),
(11, 'User 8', 'e499959af02fb3af7bd997973b722e27', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', 'BPMN 2.0 - New Page(1).png', '2015-06-17 08:27:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ct_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pd_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
