-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2015 at 01:56 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ct_id`, `ct_name`, `ct_status`, `ct_time_created`, `ct_time_update`) VALUES
(1, 'Category 1', 0, '2015-06-04 06:22:12', '2015-06-30 06:00:20'),
(2, 'sadasdas', 0, '2015-06-04 06:18:10', '2015-07-01 05:32:26'),
(3, 'Category 2', 1, '2015-06-04 13:10:20', '2015-06-24 03:55:43'),
(4, 'Category 3', 0, '2015-06-04 07:19:16', '2015-07-01 05:32:26'),
(5, 'Category 4', 1, '2015-06-04 09:13:21', '2015-07-01 05:32:06'),
(6, 'Category 5', 0, '2015-06-07 12:55:40', '2015-07-01 05:32:26'),
(7, 'Category 6', 1, '2015-06-07 12:58:16', '2015-06-24 03:55:43'),
(13, 'Category 7', 0, '2015-06-07 11:54:53', '2015-06-24 03:56:25'),
(14, 'Category 8', 0, '2015-06-07 11:56:45', '2015-07-01 04:15:53'),
(15, 'Category 9', 1, '2015-06-08 01:59:33', '2015-07-01 04:04:49'),
(16, 'Category 10', 0, '2015-06-08 02:00:10', '2015-06-10 03:55:54'),
(20, 'Category 11', 1, '2015-06-08 02:09:05', NULL),
(21, 'Category 12', 0, '2015-06-08 02:12:44', '2015-07-01 05:31:56'),
(22, 'Category 14', 0, '2015-06-08 02:16:36', '2015-06-10 03:56:10'),
(24, 'Category 16', 1, '2015-06-08 02:18:56', '2015-06-08 03:14:26'),
(25, 'Category 17', 0, '2015-06-09 11:08:25', '2015-06-10 03:56:10'),
(26, 'Category 18', 0, '2015-06-09 11:10:04', '2015-07-01 05:31:56'),
(27, 'Category 30', 0, '2015-06-09 11:11:28', '2015-06-10 09:54:54'),
(28, 'Category 20', 0, '2015-06-10 12:10:35', '2015-07-01 05:31:56'),
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
(92, '&lt;script&gt;1&lt;/script&gt;', 1, '2015-06-22 06:43:24', NULL),
(93, '&lt;script&gt;3&lt;/script&gt;', 0, '2015-06-22 01:47:06', NULL),
(94, '&lt;script&gt;4&lt;/script&gt;', 1, '2015-06-22 01:47:32', NULL),
(95, '&lt;script&gt;5&lt;/script&gt;', 0, '2015-06-22 01:48:27', NULL),
(96, '&lt;script&gt;6&lt;/script&gt;', 0, '2015-06-22 01:51:29', NULL),
(97, 'Category 178', 1, '2015-06-22 02:02:43', NULL),
(98, 'Category 179', 0, '2015-06-22 02:03:15', '2015-06-23 03:23:05'),
(101, 'Category 1230', 0, '2015-06-22 02:10:04', '2015-06-23 03:23:05'),
(102, 'Category 1980', 0, '2015-06-22 02:59:12', '2015-06-23 03:23:05'),
(103, 'Category asd', 1, '2015-06-23 10:28:23', '2015-06-23 10:28:23'),
(104, 'Category sad', 1, '2015-06-23 10:29:05', '2015-06-23 10:29:05'),
(105, 'Category asdas', 0, '2015-06-23 10:29:55', '2015-06-23 10:32:01'),
(106, '&lt;script&gt;787&lt;/script&gt;', 0, '2015-06-23 02:51:32', '2015-06-23 02:51:32'),
(107, 'sadas&#039;asda&#039;as', 1, '2015-06-23 05:00:38', '2015-06-23 05:01:55'),
(108, 'adk&#039;dsad&#039;das&quot;&#039;&#039;', 1, '2015-06-23 05:04:06', '2015-06-23 05:04:36'),
(109, 'jadkljsla a', 0, '2015-06-23 05:07:41', '2015-06-23 05:07:41'),
(110, 'Category 1123123', 1, '2015-06-24 08:54:41', '2015-06-24 08:55:01'),
(111, 'Category 11322', 1, '2015-06-24 12:00:19', '2015-06-24 12:00:19'),
(112, 'Category 19090900', 0, '2015-06-26 01:25:28', '2015-06-26 01:25:51'),
(113, 'Category 1ewqeqqwe', 0, '2015-06-26 01:37:29', '2015-06-26 02:04:10'),
(114, 'Category 1312321903', 1, '2015-06-29 03:21:59', '2015-06-29 03:21:59'),
(115, 'Category 1312312', 0, '2015-06-30 05:56:21', '2015-06-30 05:56:21'),
(116, 'Category 2222', 0, '2015-07-01 09:28:01', '2015-07-01 09:28:01'),
(117, 'Category 1wwdasssd', 0, '2015-07-01 03:02:03', '2015-07-01 03:02:03'),
(118, 'Category 1asd', 1, '2015-07-01 03:09:25', '2015-07-01 03:09:25'),
(119, 'Category 1987', 0, '2015-07-02 09:33:32', '2015-07-02 09:33:32'),
(120, 'Category 1sa;lkdl;sa', 0, '2015-07-02 09:36:08', '2015-07-02 09:42:31'),
(121, 'Category 378219738921', 1, '2015-07-02 10:36:55', '2015-07-02 10:37:29'),
(122, 'Category 1aodsoas', 0, '2015-07-02 10:49:42', '2015-07-02 10:49:52'),
(123, 'Category 1pa[sdpsak;kl;', 0, '2015-07-02 11:19:58', '2015-07-02 11:20:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pd_id`, `pd_name`, `pd_price`, `pd_des`, `pd_img0`, `pd_img1`, `pd_img2`, `pd_status`, `pd_time_created`, `pd_time_updated`) VALUES
(3, 'Product 3', 160000, 'product 3 product 3  product 3  product 3  product 3 ', '10945159_1608654019366861_2106977424_n.jpg', '143581151826312781.jpeg', '1435812090san30.jpg', 0, '2015-06-16 02:04:42', '2015-07-02 03:41:46'),
(4, 'Product 4', 120000, 'Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4 Product 4', 'bk.png', NULL, NULL, 1, '2015-06-16 03:31:16', '2015-06-24 03:56:13'),
(5, 'Product 5', 170000, 'skja ldj akl jdlsa jdklsaj kljdklajd klsj lkdajk lsjkl d', 'quan_ly_tai_khoan - New Page.png', NULL, NULL, 0, '2015-06-17 01:21:41', '2015-06-24 03:55:52'),
(6, 'Product 6', 43243, 'sa,dm,as.,.as ', 'BPMN 2.0 - New Page(1).png', NULL, NULL, 1, '2015-06-18 10:21:42', '2015-06-24 03:56:13'),
(7, 'Product 7', 170000, 'skdljslj ljdlsakjdk las', 'quan_ly_tai_khoan - New Page.png', NULL, NULL, 0, '2015-06-18 10:24:39', '2015-06-24 03:55:52'),
(8, 'Product 9', 21321, 'asdsa asdas dasdsa', 'Screenshot from 2015-06-21 21:23:30.png', NULL, NULL, 0, '2015-06-22 01:23:20', '2015-06-24 03:55:52'),
(13, 'Product 333', 123, 'dssadas', '26312781.jpeg', NULL, NULL, 1, '2015-06-22 04:55:20', '2015-06-24 04:55:56'),
(14, 'Product 912', 21321, 'djksa jdklsaj ldjksal jd jakdl js  dakls jkdlas', '26312781.jpeg', NULL, NULL, 1, '2015-06-23 08:53:07', '2015-06-24 04:55:56'),
(15, 'Product 911', 321321, 'kljkd djklsa jdkjkdla jkdl ald jal', '26312781.jpeg', NULL, NULL, 0, '2015-06-23 08:53:48', '2015-06-24 03:55:52'),
(16, 'Product 910', 123, 'dasl dkas mdklsam kldmsa kmdlas ', '26312781.jpeg', NULL, NULL, 1, '2015-06-23 08:56:03', '2015-06-24 04:55:56'),
(17, '&lt;script&gt;alert(1)&lt;/script&gt;', 21321, 'dasd dlsa;  l;dasl;  dal;s d;l dasl d;', '26312781.jpeg', NULL, NULL, 0, '2015-06-23 08:56:54', '2015-06-23 08:56:54'),
(18, 'Product sada', 213, 'adsdsa', '26312781.jpeg', NULL, NULL, 0, '2015-06-23 10:43:41', '2015-06-23 10:43:41'),
(19, 'Product 12311', 21321, 'asds', '26312781.jpeg', NULL, NULL, 1, '2015-06-23 11:04:44', '2015-06-23 11:04:44'),
(20, 'Product 1235', 21321, 'asd; dask; das dl;', '26312781.jpeg', NULL, NULL, 0, '2015-06-23 11:05:27', '2015-06-23 01:26:48'),
(21, 'sadsda', 12321, 'asdsadsad', '26312781.jpeg', NULL, NULL, 1, '2015-06-24 01:50:33', '2015-06-24 01:50:33'),
(22, 'Product 99', 1233, 'sa kl;sa klsad klda kl;das kdas l; dal; adk;ads kl;ads kl;ads', '26312781.jpeg', NULL, NULL, 0, '2015-06-24 01:52:38', '2015-06-24 02:20:10'),
(23, 'adsdasds', 1232, 'asdadsd dasjl jklads jkldas', '26312781.jpeg', NULL, NULL, 0, '2015-06-24 05:27:32', '2015-06-24 05:27:32'),
(24, 'Product 9090', 123, 'asd', '26312781.jpeg', NULL, NULL, 0, '2015-06-24 05:48:47', '2015-06-24 05:48:47'),
(25, 'dsadasds', 31231, 'askd mdksla md kldamksl dlasdmk dlasm mdalk ', 'san25.jpg', 'san40.jpg', 'san20.jpg', 1, '2015-06-25 10:09:28', '2015-06-25 10:09:28'),
(26, 'qweqwe32', 21321, 'asd dkl dl kldak d kl ak', 'san38.JPG', 'san39.jpg', 'san40.jpg', 1, '2015-06-25 10:14:21', '2015-06-25 10:14:21'),
(27, 'asdsdsa', 21321, 'ad ld l;dl ;adl', 'san42.jpg', 'san43.jpg', 'san44.jpg', 1, '2015-06-25 10:16:26', '2015-06-25 10:16:26'),
(28, 'klasjkdalsd', 213213, 'das dlas; d ;dla; d a;lda;', 'san32.jpg', 'san34.jpg', 'san35.jpg', 1, '2015-06-25 10:20:12', '2015-06-25 10:20:12'),
(29, 'adsadsa', 12312, 'asd daksldksal mdkla', 'san13.jpg', 'san16.jpg', 'san15.jpg', 1, '2015-06-25 10:23:41', '2015-06-25 10:23:41'),
(30, 'qeqweqwew', 213123, 'ams,d mda.s,md,. am,d.', 'san7.jpg', 'san8.jpg', 'san10.jpg', 1, '2015-06-25 10:25:05', '2015-06-25 10:25:05'),
(31, 'asdsdsds', 123123, 'asjddsa lkdas lkdaslk ldaskl', 'san25.jpg', 'san28.jpg', 'san29.jpg', 1, '2015-06-25 10:33:48', '2015-06-25 10:33:48'),
(32, 'eqweqw', 2312321, 'ads asdsa asdas', 'dfdffg5.jpg', '10965376_1608653289366934_1694955864_n.jpg', '10965487_1608653082700288_1991949697_n.jpg', 1, '2015-06-25 10:36:43', '2015-06-25 10:36:43'),
(33, 'wqeqewqe', 1232131, 'asd ,d.as, d,sa.d,ds.', '10945159_1608654019366861_2106977424_n.jpg', '10965381_1608653072700289_1980812330_n.jpg', '10965487_1608653082700288_1991949697_n.jpg', 1, '2015-06-25 10:47:10', '2015-06-25 10:47:10'),
(34, 'qwewqewqewe', 13232, 'asdasd das.d,.as d.as,d.a ,', '10966483_1608653042700292_18807764_n.jpg', '10966597_1608653106033619_73907494_n.jpg', '10997157_1608653136033616_840510588_n.jpg', 1, '2015-06-25 10:58:51', '2015-06-25 10:58:51'),
(35, 'dasdas123', 21321, 'asdasdas', '10945159_1608654019366861_2106977424_n.jpg', '10965376_1608653289366934_1694955864_n.jpg', '10965381_1608653072700289_1980812330_n.jpg', 1, '2015-06-25 11:13:30', '2015-06-25 11:13:30'),
(36, 'Product 990890', 12312123, 'asdasda', '10966483_1608653042700292_18807764_n.jpg', '10966597_1608653106033619_73907494_n.jpg', '10997157_1608653136033616_840510588_n.jpg', 1, '2015-06-25 11:14:11', '2015-06-25 11:14:11'),
(42, 'Product 91212', 1312, '', 'san222.jpg', 'san223.jpg', 'san224.jpg', 0, '2015-06-25 11:47:01', '2015-06-25 11:47:01'),
(43, 'Product 92136', 12312, 'asd dlaksdlk dlaksldka ld kal', 'san222.jpg', 'san223.jpg', 'san224.jpg', 0, '2015-06-25 11:48:25', '2015-06-25 11:48:25'),
(44, 'Product 9787', 133, 'llklklkl kl kl k lkl', '20141224_221308.jpg', '', '', 1, '2015-06-26 12:01:51', '2015-06-26 12:01:51'),
(45, 'asdasdasds', 21231, 'asdasdsa', 'san225.jpg', 'san226.jpg', 'san1111.jpg', 1, '2015-06-26 12:04:07', '2015-06-26 12:04:07'),
(46, 'Product 9797', 564564, 'kljkljkl', 'san111.jpg', 'san222.jpg', '10966597_1608653106033619_73907494_n.jpg', 0, '2015-06-26 12:13:04', '2015-06-26 12:22:56'),
(47, 'Product 91290', 213123, 'asda asdas asdas', 'san222.jpg', 'san223.jpg', 'san224.jpg', 1, '2015-06-26 12:31:23', '2015-06-26 12:40:33'),
(48, 'Product 92234', 23423, 'adas asdas asda', '1435254264san222.jpg', '1435254264san223.jpg', 'dfdffg5.jpg', 0, '2015-06-26 12:44:24', '2015-06-26 12:47:51'),
(49, 'ajdskaljd', 2131231, 'adsa dslakdl ask ldasklaks', '1435282824san37.jpg', '1435282824san38.JPG', '', 1, '2015-06-26 08:40:24', '2015-06-26 08:40:24'),
(50, 'qeqwewq', 21312312, 'sadasdsa', '143528310526312781.jpeg', '1435282968san40.jpg', '1435282968san39.jpg', 0, '2015-06-26 08:42:48', '2015-06-26 08:45:05'),
(51, 'asdasad', 2132, 'asd ld;asl ;ds', '143528368526312781.jpeg', '1435284214doc1.docx', '', 0, '2015-06-26 08:53:54', '2015-06-26 09:03:34'),
(56, 'wqeeqw', 21312, 'dwq dq wqd dq qd', '143528639526312781.jpeg', '1435286395dfdffg5.jpg', '1435286395san42.jpg', 0, '2015-06-26 09:39:55', '2015-06-26 09:39:55'),
(57, 'sadads', 21312, 'sdad ads ads das', '1435286512san19.jpg', '', '1435286512san39.jpg', 0, '2015-06-26 09:41:52', '2015-06-26 09:41:52'),
(59, 'qwewe', 231, 'adssda', '1435286727dfdffg5.jpg', '143528689826312781.jpeg', '143528691926312781.jpeg', 0, '2015-06-26 09:45:27', '2015-06-26 09:48:39'),
(60, 'qweeweq', 213, 'asdasd ad ad', '1435287249san38.JPG', '1435287285dfdffg5.jpg', '1435287269san39.jpg', 1, '2015-06-26 09:54:09', '2015-06-26 09:54:45'),
(61, 'Product 123123', 213, 'adssad', '1435292574dfdffg5.jpg', '', '143529260226312781.jpeg', 0, '2015-06-26 11:22:26', '2015-06-26 11:23:40'),
(62, '213wqweqw', 13223, 'sadsadas', '143529490826312781.jpeg', '1435294939dfdffg5.jpg', '', 1, '2015-06-26 12:01:48', '2015-06-26 12:02:19'),
(63, 'asddas', 23123, 'adsdas', '1435299998dfdffg5.jpg', '', '143529999826312781.jpeg', 0, '2015-06-26 01:26:38', '2015-06-26 01:27:38'),
(64, 'asdasdasd', 0, 'sdasdd', '1435300042dfdffg5.jpg', '', '', 0, '2015-06-26 01:27:22', '2015-06-26 01:27:22'),
(65, 'dsadasdas123', 312312, 'sdadas', '', '1435300088san41.jpg', '1435300088san42.jpg', 1, '2015-06-26 01:28:08', '2015-06-26 01:28:22'),
(66, 'Product 9890890', 312312, 'adasdasdas', '1435300724san37.jpg', '1435300724san42.jpg', '1435300745san32.jpg', 0, '2015-06-26 01:38:44', '2015-06-26 01:39:05'),
(67, 'hgjghj', 7687, 'hjkhjk hjkhjk hjkhjk hjkhjk', '143531199826312781.jpeg', '1435311998dfdffg5.jpg', '1435312020san40.jpg', 0, '2015-06-26 04:46:38', '2015-06-26 04:47:00'),
(68, 'Product 99999', -2132, 'qwewq', '143571604326312781.jpeg', '', '', 1, '2015-07-01 09:00:43', '2015-07-01 09:00:43'),
(69, 'Product 99090', 0, 'adasd', '1435720642dfdffg5.jpg', '143572064226312781.jpeg', '', 0, '2015-07-01 10:17:22', '2015-07-01 10:23:27'),
(70, 'Product 989789', -213123, 'dasdasd', '1435721132dfdffg5.jpg', '', '', 1, '2015-07-01 10:25:32', '2015-07-01 10:25:32'),
(71, 'sads', -2312, 'akjdksl', '143572158826312781.jpeg', '', '', 1, '2015-07-01 10:33:08', '2015-07-01 10:33:08'),
(72, 'Product 9879', 21321, 'sadasd', '143573882526312781.jpeg', 'dfdffg5.jpg', 'san25.jpg', 0, '2015-07-01 03:20:25', '2015-07-01 03:29:40'),
(73, 'sadjksaljdk', 289731, 'askdklasdklak', '143573946426312781.jpeg', 'san38.JPG', '', 1, '2015-07-01 03:31:04', '2015-07-01 03:31:38'),
(74, 'sadlasjkld', 232173, 'daskl dksland dnkaldk nal', '143580132626312781.jpeg', '1435801326dfdffg5.jpg', 'san30.jpg', 0, '2015-07-02 08:42:06', '2015-07-02 08:42:26'),
(75, 'Product 989809', 8908, 'jkljkl', '1435805765dfdffg5.jpg', '143580595926312781.jpeg', '1435805974san41.jpg', 0, '2015-07-02 09:56:05', '2015-07-02 09:59:34'),
(76, 'weqwqeqwe', 123, 'dqwdqwq', '14358091421435809142dfdffg5.jpg', '143580917326312781.jpeg', NULL, 1, '2015-07-02 10:52:22', '2015-07-02 10:52:53'),
(77, 'qwewqeqw', 21312, 'dl;slda;ds', '1435809985143580998526312781.jpeg', '1435810184san13.jpg', NULL, 0, '2015-07-02 11:06:25', '2015-07-02 11:09:44'),
(78, 'fsdfsdfuiouiosadasdasd', 312, 'dasdasda', '1435811274dfdffg5.jpg', '143581128726312781.jpeg', '1435811688dfdffg5.jpg', 1, '2015-07-02 11:27:54', '2015-07-02 11:34:48'),
(79, 'Product 321312', 217398, 'lajskldjkas', '1435826106dfdffg5.jpg', NULL, NULL, 0, '2015-07-02 03:35:06', '2015-07-02 03:36:12'),
(80, 'asudoias', 2913, 'dklasjkdlas', '143582622726312781.jpeg', NULL, NULL, 0, '2015-07-02 03:37:07', '2015-07-02 03:39:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `pass`, `status`, `privilege`, `user_email`, `user_img`, `user_time_created`, `user_time_updated`) VALUES
(1, 'bactv', 'a32145a237b6fe9e63bfe9216f965e01', 1, 1, 'bac@gmail.com', '1435734433san40.jpg', '0000-00-00 00:00:00', '2015-07-01 02:07:13'),
(4, 'User 1', 'c5ecd9c5436ff98dff1aef7938b36c81', 1, 0, 'bac@gmail.com', '1435810580san32.jpg', '2015-06-10 05:30:08', '2015-07-02 11:16:20'),
(5, 'User 2', 'sdsad89089as0d890as', 0, 0, NULL, NULL, '2015-06-03 10:07:37', '2015-06-16 08:30:59'),
(6, 'User 3', '345ca9e2eae58cef08b92066d47a7c42', 1, 0, NULL, 'Truong Van Bac.png', '2015-06-16 02:16:12', '2015-06-16 08:30:52'),
(7, 'User 4', '6face0b016a7b7662c2fcab45e9f6f91', 0, 0, 'kdaslkdlsad', 'Untitled.png', '2015-06-16 09:29:17', '2015-06-17 07:23:56'),
(8, 'User 5', '5edb79884e2f55688b7ea75698703b66', 0, 0, NULL, 'BPMN 2.0 - New Page(1).png', '2015-06-16 11:22:32', '2015-06-22 04:16:53'),
(9, 'User 6', 'f4e55449d8ef2e03307371d4e029d0a1', 0, 0, 'aslasl;dkls;akdls', 'quan_ly_tai_khoan - New Page.png', '2015-06-17 07:23:40', '2015-06-17 07:23:47'),
(10, 'User 7', '2302619b3b5e9d53ce1598b4324c35af', 0, 0, 'nklfdskl lklkdl ', 'BPMN 2.0 - New Page(1).png', '2015-06-17 08:21:16', '2015-07-01 04:09:33'),
(11, 'User 8', 'e499959af02fb3af7bd997973b722e27', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', 'BPMN 2.0 - New Page(1).png', '2015-06-17 08:27:20', '2015-07-01 04:09:27'),
(12, 'User 13', '69c8dedc76e033b1852f514c07bbe819', 0, 0, 'bac@gmail.com', '26312781.jpeg', '2015-06-22 03:47:15', '2015-07-01 04:09:33'),
(13, 'User 14', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 'bac.bkhn.k57@gmail.com', '26312781.jpeg', '2015-06-22 06:49:41', '2015-06-22 06:49:41'),
(14, 'User 15', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '26312781.jpeg', '2015-06-22 06:50:33', '2015-06-22 06:50:33'),
(15, 'kaysadsd', 'cfcff1ee31340929aac0f48b0b7f5dbc', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '26312781.jpeg', '2015-06-23 07:03:16', '2015-06-23 07:03:16'),
(16, 'eqwe', '8cb02fe261f435a5c2b463ad43b571a4', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '26312781.jpeg', '2015-06-24 12:49:57', '2015-06-24 12:49:57'),
(17, 'sads', 'f7b6521b3dcfe2f95043c70cd6cbeb92', 0, 0, 'adsa@gmail.com', '26312781.jpeg', '2015-06-24 12:51:40', '2015-06-24 12:54:06'),
(18, 'asdasldl', 'f5bb0c8de146c67b44babbf4e6584cc0', 0, 0, 'bactv@gmail.com', '26312781.jpeg', '2015-06-24 12:53:04', '2015-06-24 12:53:04'),
(19, 'asdsdas', '5edb79884e2f55688b7ea75698703b66', 0, 0, 'asdasd', '26312781.jpeg', '2015-06-24 12:55:50', '2015-06-24 12:55:50'),
(20, 'asdasd', '287b90fc13630db108b5f8a1da125232', 0, 0, 'asdasd@gmail.com', '26312781.jpeg', '2015-06-24 01:02:02', '2015-06-24 01:02:02'),
(21, 'eqweweq', 'f7b0ddf029f6c385bc4a785bef08e638', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '26312781.jpeg', '2015-06-24 03:29:57', '2015-06-24 03:30:41'),
(22, 'wqeqwe', 'df239e9cc36c84a756a9e23721d66678', 0, 0, 'bac.bkhn.k57@gmail.com', 'dfdffg5.jpg', '2015-06-26 10:26:23', '2015-06-26 10:26:55'),
(23, 'asdsdsd', '1d000fa7498a822c35940ce3d4096342', 0, 0, 'bac.bkhn.k57@gmail.com', 'san35.jpg', '2015-06-26 10:49:51', '2015-06-26 10:49:51'),
(24, 'dlasjdlkajskld', 'f0a4abeabd6c4df6ce9ff6c5f989a7bd', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '143529068326312781.jpeg', '2015-06-26 10:51:23', '2015-06-26 10:51:23'),
(25, 'asdasdas', 'fd1221c7dbc9b50c32daa5ecd4a87ad5', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '1435300160dfdffg5.jpg', '2015-06-26 01:29:00', '2015-06-26 01:29:20'),
(26, 'asdasdsadsa', '6e7f692a9439b5b8def7ab1fba90d164', 1, 0, 'bac.bkhn.k57@gmail.com', '1435300829dfdffg5.jpg', '2015-06-26 01:39:59', '2015-06-26 01:40:29'),
(27, 'User 1849028302', 'c9f0879320373a5263059f8993256236', 1, 0, 'bac@gmail.com', '143572177626312781.jpeg', '2015-07-01 10:36:16', '2015-07-01 10:49:49'),
(28, 'User jdlsajkdlsasaldlsa', '81407417ed731bf7e7e02b678e1b7062', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '143580736726312781.jpeg', '2015-07-02 10:22:31', '2015-07-02 10:22:47'),
(29, 'kalsjdklsa', 'e3dfca8676e5d0f06c1723fbff3d99fe', 0, 0, 'trustinjesus.tvb94@yahoo.com.vn', '143581016026312781.jpeg', '2015-07-02 11:09:03', '2015-07-02 11:09:20'),
(30, 'User sakd21321', 'adf3b0d73c1f885bd2e7471de6d95bd4', 1, 0, 'trustinjesus.tvb94@yahoo.com.vn', '1435821774dfdffg5.jpg', '2015-07-02 02:22:38', '2015-07-02 03:40:26');

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
  MODIFY `ct_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pd_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
