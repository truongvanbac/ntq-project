-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2015 at 02:33 AM
-- Server version: 5.5.42
-- PHP Version: 5.5.26

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
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ct_id`, `ct_name`, `ct_status`, `ct_time_created`, `ct_time_update`) VALUES
(1, '&lt;script&gt;alert(1)&lt;/script&gt;', 1, '2015-06-04 06:22:12', '2015-07-21 01:28:21'),
(2, 'sadasdas', 0, '2015-06-04 06:18:10', '2015-07-21 01:28:11'),
(3, 'Category 2', 1, '2015-06-04 13:10:20', '2015-07-21 01:28:21'),
(39, 'Category 28', 0, '2015-06-10 01:36:33', '2015-07-21 01:28:11'),
(40, 'Category 29', 1, '2015-06-10 02:03:53', '2015-07-21 01:28:21'),
(155, 'hjkhjkhjkhj', 0, '2015-07-21 01:25:48', '2015-07-21 01:28:11'),
(156, 'asddddddd', 1, '2015-07-21 03:21:24', '2015-07-21 03:21:24'),
(157, 'ajdklsajkldsa', 1, '2015-07-21 03:23:04', '2015-07-21 03:23:04'),
(158, 'Category 1', 1, '2015-07-21 03:48:17', '2015-07-21 03:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pd_id` int(5) NOT NULL,
  `pd_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pd_price` int(10) NOT NULL,
  `pd_des` text COLLATE utf8_unicode_ci NOT NULL,
  `pd_img0` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pd_img1` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pd_img2` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pd_status` tinyint(1) NOT NULL,
  `pd_time_created` datetime NOT NULL,
  `pd_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pd_id`, `pd_name`, `pd_price`, `pd_des`, `pd_img0`, `pd_img1`, `pd_img2`, `pd_status`, `pd_time_created`, `pd_time_updated`) VALUES
(3, 'sasadasd', 1600005, 'product 3 product 3  product 3  product 3  product 3', '', '', '', 0, '2015-06-16 02:04:42', '2015-07-21 03:15:55'),
(4, 'Product 1', 120000, 'Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4', '', '', '', 0, '2015-06-16 03:31:16', '2015-07-20 09:14:07'),
(5, 'Product 5', 170000, 'skja ldj akl jdlsa jdklsaj kljdklajd klsj lkdajk lsjkl d', '', NULL, NULL, 1, '2015-06-17 01:21:41', '2015-07-21 10:10:51'),
(6, 'Product 6', 43243, 'sa,dm,as.,.as ', '1436842882gI_80186_DeskTime-Icon-250px.png', '1436842913tải xuống.jpg', '1436842953tải xuống.jpg', 1, '2015-06-18 10:21:42', '2015-07-14 10:02:33'),
(7, 'Product 7', 170000, 'skdljslj ljdlsakjdk las', 'quan_ly_tai_khoan - New Page.png', NULL, NULL, 1, '2015-06-18 10:24:39', '2015-07-08 09:30:56'),
(8, 'Product 9', 21321, 'asdsa asdas dasdsa', 'Screenshot from 2015-06-21 21:23:30.png', NULL, NULL, 1, '2015-06-22 01:23:20', '2015-07-08 09:30:56'),
(13, 'Product 333', 123, 'dssadas', '26312781.jpeg', NULL, NULL, 1, '2015-06-22 04:55:20', '2015-07-08 09:30:56'),
(14, 'Product 912', 21321, 'djksa jdklsaj ldjksal jd jakdl js  dakls jkdlas', '26312781.jpeg', NULL, NULL, 1, '2015-06-23 08:53:07', '2015-07-08 09:30:56'),
(15, 'Product 911', 321321, 'kljkd djklsa jdkjkdla jkdl ald jal', '26312781.jpeg', NULL, NULL, 1, '2015-06-23 08:53:48', '2015-07-08 09:30:56'),
(51, 'asdasad', 2132, 'asd ld;asl ;ds', '143528368526312781.jpeg', '1435284214doc1.docx', '', 0, '2015-06-26 08:53:54', '2015-06-26 09:03:34'),
(56, 'wqeeqw', 21312, 'dwq dq wqd dq qd', '143528639526312781.jpeg', '1435286395dfdffg5.jpg', '1435286395san42.jpg', 0, '2015-06-26 09:39:55', '2015-06-26 09:39:55'),
(57, 'sadads', 21312, 'sdad ads ads das', '1435286512san19.jpg', '', '1435286512san39.jpg', 0, '2015-06-26 09:41:52', '2015-06-26 09:41:52'),
(59, 'qwewe', 231, 'adssda', '1435286727dfdffg5.jpg', '143528689826312781.jpeg', '143528691926312781.jpeg', 0, '2015-06-26 09:45:27', '2015-06-26 09:48:39'),
(60, 'qweeweq', 213, 'asdasd ad ad', '1435287249san38.JPG', '1435287285dfdffg5.jpg', '1435287269san39.jpg', 1, '2015-06-26 09:54:09', '2015-06-26 09:54:45'),
(61, 'Product 123123', 213, 'adssad', '1435292574dfdffg5.jpg', '', '143529260226312781.jpeg', 0, '2015-06-26 11:22:26', '2015-06-26 11:23:40'),
(62, '213wqweqw', 13223, 'sadsadas', '143529490826312781.jpeg', '1435294939dfdffg5.jpg', '', 1, '2015-06-26 12:01:48', '2015-06-26 12:02:19'),
(65, 'dsadasdas123', 312312, 'sdadas', '', '1435300088san41.jpg', '1435300088san42.jpg', 1, '2015-06-26 01:28:08', '2015-06-26 01:28:22'),
(66, 'Product 9890890', 312312, 'adasdasdas', '1435300724san37.jpg', '1435300724san42.jpg', '1435300745san32.jpg', 0, '2015-06-26 01:38:44', '2015-06-26 01:39:05'),
(67, 'hgjghj', 7687, 'hjkhjk hjkhjk hjkhjk hjkhjk', '143531199826312781.jpeg', '1435311998dfdffg5.jpg', '1435312020san40.jpg', 0, '2015-06-26 04:46:38', '2015-06-26 04:47:00'),
(69, 'Product 99090', 0, 'adasd', '1435720642dfdffg5.jpg', '143572064226312781.jpeg', '', 0, '2015-07-01 10:17:22', '2015-07-01 10:23:27'),
(72, 'Product 9879', 21321, 'sadasd', '143573882526312781.jpeg', 'dfdffg5.jpg', 'san25.jpg', 0, '2015-07-01 03:20:25', '2015-07-01 03:29:40'),
(73, 'sadjksaljdk', 289731, 'askdklasdklak', '143573946426312781.jpeg', 'san38.JPG', '', 1, '2015-07-01 03:31:04', '2015-07-01 03:31:38'),
(74, 'sadlasjkld', 232173, 'daskl dksland dnkaldk nal', '143580132626312781.jpeg', '1435801326dfdffg5.jpg', 'san30.jpg', 0, '2015-07-02 08:42:06', '2015-07-02 08:42:26'),
(75, 'Product 989809', 8908, 'jkljkl', '1435805765dfdffg5.jpg', '143580595926312781.jpeg', '1435805974san41.jpg', 0, '2015-07-02 09:56:05', '2015-07-02 09:59:34'),
(76, 'weqwqeqwe', 123, 'dqwdqwq', '14358091421435809142dfdffg5.jpg', '143580917326312781.jpeg', NULL, 1, '2015-07-02 10:52:22', '2015-07-02 10:52:53'),
(77, 'qwewqeqw', 21312, 'dl;slda;ds', '1435809985143580998526312781.jpeg', '1435810184san13.jpg', NULL, 0, '2015-07-02 11:06:25', '2015-07-02 11:09:44'),
(100, 'asdasdasd', 123, 'sadsadasda', '1437460028asdsadsa.jpeg', '1437460015adsdsads.png', NULL, 1, '2015-07-21 01:26:55', '2015-07-21 01:27:08'),
(101, 'Category 1', 123, 'dassssssss', NULL, NULL, NULL, 1, '2015-07-21 03:55:55', '2015-07-21 03:55:55'),
(102, 'hjaskhdjksahdjkas', 213, 'dasdjla', '14374708800asdsadsa.jpeg', '14374708571adsdsads.png', '14374708802asdsdas.jpg', 1, '2015-07-21 04:26:55', '2015-07-21 04:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `privilege` tinyint(4) NOT NULL,
  `user_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_img` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_time_created` datetime NOT NULL,
  `user_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `pass`, `status`, `privilege`, `user_email`, `user_img`, `user_time_created`, `user_time_updated`) VALUES
(1, 'bactv123', '17041994', 1, 1, 'bac@gmail.com', '1437459630asdsdas.jpg', '0000-00-00 00:00:00', '2015-07-21 01:20:30'),
(4, 'user11111', '123456789', 1, 1, 'bac@gmail.com', NULL, '2015-06-10 05:30:08', '2015-07-21 04:23:07'),
(5, 'User 2', 'sdsad89089as0d890as', 0, 0, NULL, NULL, '2015-06-03 10:07:37', '2015-06-16 08:30:59'),
(6, 'User 3', '345ca9e2eae58cef08b92066d47a7c42', 1, 0, NULL, 'Truong Van Bac.png', '2015-06-16 02:16:12', '2015-06-16 08:30:52'),
(7, 'User 4', '6face0b016a7b7662c2fcab45e9f6f91', 0, 0, 'kdaslkdlsad', 'Untitled.png', '2015-06-16 09:29:17', '2015-06-17 07:23:56'),
(8, 'User 5', '5edb79884e2f55688b7ea75698703b66', 1, 0, NULL, 'BPMN 2.0 - New Page(1).png', '2015-06-16 11:22:32', '2015-07-10 05:02:18'),
(9, 'User 6', 'f4e55449d8ef2e03307371d4e029d0a1', 1, 0, 'aslasl;dkls;akdls', 'quan_ly_tai_khoan - New Page.png', '2015-06-17 07:23:40', '2015-07-10 05:02:18'),
(10, 'User 7', '2302619b3b5e9d53ce1598b4324c35af', 0, 0, 'nklfdskl lklkdl ', 'BPMN 2.0 - New Page(1).png', '2015-06-17 08:21:16', '2015-07-01 04:09:33'),
(11, 'User 8', 'e499959af02fb3af7bd997973b722e27', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', 'BPMN 2.0 - New Page(1).png', '2015-06-17 08:27:20', '2015-07-10 05:02:09'),
(28, 'User jdlsajkdlsasaldlsa', '81407417ed731bf7e7e02b678e1b7062', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '', '2015-07-02 10:22:31', '2015-07-21 10:10:16'),
(29, 'kalsjdklsa', 'e3dfca8676e5d0f06c1723fbff3d99fe', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '143581016026312781.jpeg', '2015-07-02 11:09:03', '2015-07-02 11:09:20'),
(30, 'User sakd21321', 'adf3b0d73c1f885bd2e7471de6d95bd4', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '1435821774dfdffg5.jpg', '2015-07-02 02:22:38', '2015-07-02 03:40:26'),
(31, 'sahdsahkdjksa', 'aa1f1f259058c547b9d083f50f346050', 1, 0, 'dasldklsa@asdsa.com', '1436340405quadratic-equations-solver-815725-l-280x280.png', '2015-07-08 02:26:03', '2015-07-08 02:26:45'),
(32, 'sadsd', 'fghfghf', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '1436431581Lich_01.png', '2015-07-09 03:46:21', '2015-07-09 03:46:21'),
(33, 'asdddasdss', 'qeeeeeeeqweweew', 0, 0, 'asdasd@gmail.com', '1436511933Lich_01.png', '2015-07-10 02:05:18', '2015-07-10 02:05:33'),
(34, 'asddddd', 'asdddddddd', 1, 0, 'asdddd@gmail.com', '1436514882quadratic-equations-solver-815725-l-280x280.png', '2015-07-10 02:54:42', '2015-07-10 02:54:54'),
(44, 'asdddddddddas', 'saddddddd', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '14368497136.jpg', '2015-07-14 11:55:13', '2015-07-14 11:55:13'),
(45, 'jaslkdsljkdlsa', 'dkasjldkjasld', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '14368596376.jpg', '2015-07-14 02:34:51', '2015-07-14 02:40:37'),
(46, 'sald;ksld;kasl;da', 'sad,asm,d.as', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '', '2015-07-15 08:45:58', '2015-07-15 08:53:36'),
(47, 'user1', '   ', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '143692637817.jpg', '2015-07-15 09:12:58', '2015-07-15 09:12:58'),
(48, '&lt;script&gt;alert(1)&lt;/script&gt;', '123', 1, 0, 'bactv123@1.c', '143692717515.jpg', '2015-07-15 09:26:15', '2015-07-15 09:26:15'),
(49, 'bactv12345', 'a32145a237b6fe9e63bfe9216f965e01', 1, 0, 'asdasdas@gmail.com', '1437321101com.popzhang.sudoku.png', '2015-07-19 10:51:41', '2015-07-19 10:56:30'),
(50, 'User1233', 'a32145a237b6fe9e63bfe9216f965e01', 0, 1, 'asdasklkd@gmail.com', '1437357329com.popzhang.sudoku.png', '2015-07-19 11:08:59', '2015-07-20 08:55:29'),
(51, 'hskjahdjashdjkas', 'df755165f56c5b3140da7eef49562bdf', 1, 1, 'root@sadas.com', NULL, '2015-07-20 09:53:18', '2015-07-20 09:53:18'),
(52, 'user1111', 'b0baee9d279d34fa1dfd71aadb908c3f', 1, 1, 'root@gmal.cim', '1437363143sadsads.png', '2015-07-20 10:32:23', '2015-07-20 10:32:23'),
(53, 'sadsadsad', '123456789', 1, 1, 'bac.bkhn.k57@gmail.com', '', '2015-07-20 02:59:57', '2015-07-20 06:27:04'),
(54, 'u1', '12345678', 1, 1, 'trustinjesus.tvb94@yahoo.com.vn', '', '2015-07-20 06:25:03', '2015-07-20 06:26:30'),
(55, 'adsdas', 'ádddddđ', 1, 1, 'bac.bkhn.k57@gmail.com', '1437408485sadsads.png', '2015-07-20 11:07:44', '2015-07-20 11:08:05'),
(56, 'bactv123jkjkl', 'jhjkhjk', 1, 1, 'bac.bkhn.k57@gmail.com', '1437413603Lich_01.png', '2015-07-21 12:32:37', '2015-07-21 12:33:23');

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ct_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pd_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
