-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2025 at 05:47 PM
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
-- Database: `carat_craft`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_username` varchar(20) NOT NULL,
  `account_email` varchar(60) NOT NULL,
  `account_password` varchar(60) NOT NULL,
  `account_role` char(3) NOT NULL,
  `account_created` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_username`, `account_email`, `account_password`, `account_role`, `account_created`) VALUES
(14, 'tkr', 'tkr@gmail.com', '$2y$10$2eAPMLp65I.StRo4U3daYek8JrwADiCdY/hhjAsuhK4hw7EgZ4yoO', 'DES', 2147483647),
(15, '222', 'sa@gmail.com', '$2y$10$uEOYnjUE7O51P2TgTQJEgOuQiJ1tsbTEz7xf5Dq562tWoj45imv0y', 'DES', 2147483647),
(16, 'tankrou', 'tankrou@gmail.com', '$2y$10$55vnB0xqgyHPdx9OcdTOHezDDVXNJJqLOOtHM09tsZzUvz64.AU7i', 'DES', 2147483647),
(17, 'ddd', 'ddd@gmail.com', '$2y$10$m9OUx0db3lt5BjUNtiod6usDR6ei9Y2LGrh7cZ93fX79m2C7jRl0W', 'DES', 2147483647),
(18, 'andrew', 'andrew@gmail.com', '$2y$10$FwXVVi29AutcdnT59aa0LO1WFWqNVCmC//v5eNnrxzudfZCNG1KPC', 'ADM', 2147483647),
(19, '999', '999@gmail.com', '$2y$10$wrftWc2p5BcbRFL8OvOCvOwdxz0YUvzGjXBbPDXo2mkYmPSjdZL.G', 'DES', 2147483647),
(20, 'fenyu', 'fenyu@gmail.com', '$2y$10$XzMnzDrNsVT7K6ZUE16lT.aIx/43kikFO/jqtlLvXUIMHDE6n3Tde', 'DES', 2147483647),
(21, 'mingyu', 'mingyu@gmail.com', '$2y$10$GC1EqWObSd5T1fcBEAbEHO6xy6mvhsUr/DX9q60WV4R9zKForXeHe', 'DES', 2147483647),
(22, 'qsss', 'qsss@gmail.com', '$2y$10$4kBPRi9dn8qfHl5fhgNZx.uCiZ.L.idTtUmTfmCn33wCsKyxmd4Y2', 'DES', 2147483647),
(23, '2415744', 's11a@gmail.com', '$2y$10$pHaI8xfvXautQy7tmFll3uCO7egwlMebO/UNspEWU2IaWxnh4Xona', 'DES', 2147483647),
(24, 'angel', 'angeline@gmail.com', '$2y$10$wEGOQBOM3L4HxCDlb2sSOOaix.mHgoyE1EDCzu2IESNd9J4hKqDQq', 'DES', 2147483647),
(25, 'ttt', 'ttt@gmail.com', '$2y$10$BTb5xDU6ulhdt17ww3Kne.hXrsVwe1zJostPxBaZUQoDJ3K7WGLhi', 'DES', 2147483647),
(26, '3333', '3333@gmail.com', '$2y$10$IGHoXab3IW0p1SsCCkqPoObMyKo6MVGEiRp9tioXVeLZqhQDP/8W2', 'DES', 2147483647),
(27, 'admin1', 'admin@gmail.com', '$2y$10$5CdeHTV.edpyzg9C0jGxD.6x4nd21cvpSyFV0tjX5ew1Tv15VlJ1y', 'ADM', 2147483647),
(28, 'admin2', 'admin2@gmail.com', '$2y$10$GGqOgB/EAXI0.030lGChO.Zkx1BlRrMUf/5op0.6E/CnHqQdn6sy.', 'ADM', 2147483647),
(29, 'jason', 'jason@gmail.com', '$2y$10$zpkHkAaMilOkVRyQXEisvu7pM6mKLr7TV2lYY3MkqBbyNV9eac0uG', 'DES', 2147483647),
(30, 'zhongkang', 'zk@gmail.com', '$2y$10$hZsQCdRsV3sXm0VOtoNW.OzBMTtpIYLAXKqy5ipe7qQ8ikrudFQFu', 'DES', 2147483647),
(31, '333', '333@gmail.com', '$2y$10$cdUw4wFUIqQHBI8zLmFfmeOmbTSLq6TRJ.mY4GuKCsZUUThkFhlFC', 'DES', 2147483647),
(32, 'angeline', 'gangeli@gmail.com', '$2y$10$uQDbXy/hpVub7mtS5KXXOuHRaTKsbpDVNYrzxA3JlfUiLZ2GPDyU.', 'DES', 2147483647),
(33, 'MOMO', 'MOMO9@gmail.com', '$2y$10$BHJsuBvdmxA55OPPGNRLXuITag9y5e9W3wm.UDF6eWOwaJL8XPRS2', 'DES', 2147483647),
(34, 'ZHIXUAN', 'ZHIXUAN@gmail.com', '$2y$10$fFIn41sfOR8Nts.sJRIsYOxCzlPUNdYC40JBypXBsxKu9CgD31aEC', 'DES', 2147483647),
(35, 'SVT_BB', 'SVT@gmail.com', '$2y$10$fEyqcnas4eOY40w1M9FDduuO/oZcZNEKMKFp84h4f9gfRbi5CDsp2', 'DES', 2147483647),
(36, 'Carat_diamond', 'carat@gmail.com', '$2y$10$vW/gfUB9LMD19emmE76xaeYO6k.7m54cGtLFnnC7joSlc3Io5QEHm', 'DES', 2147483647),
(37, 'BB_CARAT', 'BB@gmail.com', '$2y$10$/tniUZV.SMz.y3ZdToYsaO71/VV4kGebgwiRo6HLBdjlMmu1gNGYW', 'DES', 2147483647),
(38, 'RyanSoul', 'ryan@gmail.com', '$2y$10$smcHBF0NeNBUTUyy0xKG9Ow8kswX2wy4M6jP2goPGLVg8IBYLpmkC', 'DES', 2147483647),
(39, 'Caratland', 'land@gmail.com', '$2y$10$kgTcVsKK/KdJ3mz1EIHtouaBaU7S5ZykZgW1vgoLoFnNPFW7bSL9a', 'DES', 2147483647),
(40, 'Caratisbella', 'bella@gmail.com', '$2y$10$CoRijfSI27yTQlGG/HReJecpEjbUGoZUmLscYRHSzuhhlK6rZcM8a', 'DES', 2147483647),
(41, 'Sukiiiii', 'sukiyah@gmail.com', '$2y$10$ubTrtzDH4kVtiwHr/B.AkOD1qncmtBeQVH8sKWDntsWFME.ddhumq', 'DES', 2147483647),
(42, 'dont\'move', '8812loke@gmail.com', '$2y$10$rLcdaD1TwT5Nnhzf2tG82.woV789ca2eXMF1yvGkm8pfhqMt3zLnG', 'DES', 2147483647),
(43, 'kawaaa', 'kawakawa@gmail.com', '$2y$10$AgZzmya9Cs0NQwjLvpw8E.IglrD6qyyDbNALH6NkHziiFcoPzs05K', 'DES', 2147483647),
(44, 'Studio craft', 'Studiocraft888@gmail.com', '$2y$10$Vmm5g8LnvgrntEHjhxiT8eUnn2OL5H9dek7mBweeRfvZnFMJOU5Mi', 'DES', 2147483647),
(45, 'GrapeSencha', 'GrapeSencha/@gmail.com', '$2y$10$Zdbr8lC1chg0T/bjeJAQ7.Dg8z7n6cLSXvJAkEFm08L4MnCGEYzki', 'DES', 2147483647),
(46, 'Tt.', 'Ttbut@gmail.com', '$2y$10$W/bFhswZuRnVmyleJekj6OZs7DytT5T7Ez8ue7PZr3Zj8EXBhYbVy', 'DES', 2147483647),
(47, 'happy_allday', 'allday@gmail.com', '$2y$10$WbxPXJKuOT74jB458cw6Suq3IIZeV8FroyXcei51WBnktAV99fSfm', 'DES', 2147483647),
(48, 'big_orange', '0rangegode@gmail.com', '$2y$10$OwIgLqb7PuU2lPKNGDmo5.M3TO.KzF8pwDUfWLbe/9Jc3gsfE.x4e', 'DES', 2147483647),
(49, 'Yaxaiio', 'Yaxaiio5566@gmail.com', '$2y$10$C28DwTZv7o5VhAW.VtSWreFCWyQ3z1EB5H.OuIVuB6yGzpLw3seOC', 'DES', 2147483647),
(50, 'H27L', 'bbkl2233@gmail.com', '$2y$10$R26/AKALC6RBLPJVmnJIzuQwGiGMoJlpHNZvL46MPFdfBtaaKXnEm', 'DES', 2147483647),
(51, 'jiong jiong', 'jiongjiong@gmail.com', '$2y$10$tzyqLxOWQTv/8B.g9Oa4YOw2DQM6lTg4buqjzWKYHWZSPKCTRrZpy', 'DES', 2147483647),
(52, 'wwuwwwyy', 'wuwuwu@gmai.com', '$2y$10$cIAd9n20PMVUZqofj0PoNehZ9xmDSPkq39tCuRhQ3gAihQKZP2zv.', 'DES', 2147483647),
(53, 'bighan', 'hanhan@gmail.com', '$2y$10$/US3zwVeoSAHftlY9fC4Mu/pKyso2JhJV5R6wE6aZ9.od9b5WC.Fm', 'DES', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `craft_categories`
--

CREATE TABLE `craft_categories` (
  `craft_categories_id` int(5) NOT NULL,
  `craft_categories_name` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `event_name` varchar(20) NOT NULL,
  `event_date` date NOT NULL,
  `event_venue` varchar(50) NOT NULL,
  `event_photo` varchar(100) NOT NULL,
  `event_desc` varchar(1000) NOT NULL,
  `event_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `account_id`, `event_name`, `event_date`, `event_venue`, `event_photo`, `event_desc`, `event_time`) VALUES
(27, 51, '🇲🇾Attention everyone', '2025-11-26', '📍 DayDream Cafe（The Podium）', '', '请大家多多来玩 支持支持 min spend才9块罢了！', '2025-09-28 08:20:45'),
(28, 52, 'Attention everyone i', '2025-12-18', '📍 DayDream Cafe（The Podium）', '', 'Minimum spending of 15 can get a small gift', '2025-09-28 08:31:02'),
(29, 48, 'SEVENTEEN 10th Anniv', '2025-11-13', '📍 Flaon Cafe, Pasar Seni', '', '就在1004那一天跟大家在haha gelato一起玩乐 主办用心准备了小礼物跟打卡点', '2025-09-28 08:34:37'),
(30, 46, '🇲🇾Seventeen 十周年生咖💎🩷🩵', '2025-08-09', '📍 DayDream Cafe（The Podium）', '', '主办方会准备充足的door gift噢', '2025-09-28 08:42:15'),
(31, 50, '<MINITEEN HOUSE PART', '2025-10-17', '📍GF - Water Feature Zone, @Sunway Pyramid', '', '⚠️ 为了大家的安全，入场时请配合现场工作人员指引', '2025-09-28 08:46:40'),
(32, 47, '新巡NEW_在洛杉矶的活动指南💎', '2025-11-06', '📍 Los Angeles, USA', '', 'soundcheck setlist', '2025-09-28 08:55:06'),
(33, 45, '全网最全的克拉境打卡攻略', '2026-03-25', '📍 集章玩法', '', '💎ATTENTION！集章玩法请关注——', '2025-09-28 09:01:11'),
(35, 44, '𝐒𝐰𝐞𝐞𝐭 𝐰𝐢𝐭𝐡 𝐊𝐢𝐦𝐣𝐚', '2026-03-11', '📍 Pica Poca Penang', '', '接下来会陆续发出很多惊喜喔～ 敬请期待', '2025-09-28 09:14:37'),
(36, 43, '🇲🇾 崔啵哝生咖 🐻‍❄️', '2026-03-26', '📍5omething Cafe', '', '低消17即可领小礼物', '2025-09-28 09:18:17'),
(37, 43, '🇲🇾🎂 SEVENTEEN 洪知秀生咖', '2026-01-15', '📍Cafe Cloud, LaLaport', '', '有什么问题可以💌我们哦 期待那一天，属于克拉和 Joshua 的限定瞬间', '2025-09-28 09:22:00'),
(38, 42, '李硕珉生咖大放送🌟粗卡～', '2026-02-11', '📍 Bukit Bintang Mega Billboard', '', '小礼物两间门店都有！', '2025-09-28 09:30:07'),
(39, 42, '✨SVT薄荷巧克力·十周年', '2026-04-02', '📍：Zero O’clock Cafe @Saradise', '', '注意注意!!!必须在Game Station完成三项关卡才可以获得抽奖资格', '2025-09-28 09:40:49'),
(40, 41, '𝟮𝟬𝟮𝟱 𝗦𝗘𝗩𝗘𝗡𝗧𝗘𝗘𝗡 𝟭𝟬𝗧𝗛 ', '2025-12-18', '📍OHMO喔莫咖啡', '', '顺序特典：24/25日 每天前两名送抽绳包 26日前两位送T恤衫一件', '2025-09-28 09:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `event_photo`
--

CREATE TABLE `event_photo` (
  `photo_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_photo`
--

INSERT INTO `event_photo` (`photo_id`, `event_id`, `photo_path`) VALUES
(23, 27, 'image/event/event_1759047645_0.jpg'),
(24, 27, 'image/event/event_1759047645_1.jpg'),
(25, 27, 'image/event/event_1759047645_2.jpg'),
(26, 28, 'image/event/event_1759048262_0.jpg'),
(27, 28, 'image/event/event_1759048262_1.jpg'),
(28, 28, 'image/event/event_1759048262_2.jpg'),
(29, 29, 'image/event/event_1759048477_0.jpg'),
(30, 29, 'image/event/event_1759048477_1.jpg'),
(31, 29, 'image/event/event_1759048477_2.jpg'),
(32, 30, 'image/event/event_1759048935_0.jpg'),
(33, 30, 'image/event/event_1759048935_1.jpg'),
(34, 30, 'image/event/event_1759048935_2.jpg'),
(35, 31, 'image/event/event_1759049200_0.jpg'),
(36, 31, 'image/event/event_1759049200_1.jpg'),
(37, 31, 'image/event/event_1759049200_2.jpg'),
(38, 32, 'image/event/event_1759049706_0.jpg'),
(39, 32, 'image/event/event_1759049706_1.jpg'),
(40, 32, 'image/event/event_1759049706_2.jpg'),
(41, 33, 'image/event/event_1759050071_0.jpg'),
(42, 33, 'image/event/event_1759050071_1.jpg'),
(43, 33, 'image/event/event_1759050071_2.jpg'),
(47, 35, 'image/event/event_1759050877_0.jpg'),
(48, 35, 'image/event/event_1759050877_1.jpg'),
(49, 35, 'image/event/event_1759050877_2.jpg'),
(50, 36, 'image/event/event_1759051097_0.jpg'),
(51, 36, 'image/event/event_1759051097_1.jpg'),
(52, 36, 'image/event/event_1759051097_2.jpg'),
(53, 37, 'image/event/event_1759051320_0.jpg'),
(54, 37, 'image/event/event_1759051320_1.jpg'),
(55, 37, 'image/event/event_1759051320_2.jpg'),
(56, 38, 'image/event/event_1759051807_0.jpg'),
(57, 38, 'image/event/event_1759051807_1.jpg'),
(58, 38, 'image/event/event_1759051807_2.jpg'),
(59, 39, 'image/event/event_1759052449_0.jpg'),
(60, 39, 'image/event/event_1759052449_1.jpg'),
(61, 39, 'image/event/event_1759052449_2.jpg'),
(62, 40, 'image/event/event_1759052604_0.jpg'),
(63, 40, 'image/event/event_1759052604_1.jpg'),
(64, 40, 'image/event/event_1759052604_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_signup`
--

CREATE TABLE `event_signup` (
  `signup_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `signup_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_signup`
--

INSERT INTO `event_signup` (`signup_id`, `event_id`, `name`, `email`, `phone`, `signup_time`) VALUES
(15, 28, 'Tt.', 'Ttbut@gmail.com', '01036936995', '2025-09-28 08:39:36'),
(16, 29, 'Tt.', 'Ttbut@gmail.com', '01036936995', '2025-09-28 08:39:51'),
(17, 27, 'Tt.', 'Ttbut@gmail.com', '01036936995', '2025-09-28 08:40:03'),
(18, 30, 'happy_allday', 'allday@gmail.com', '01233693664', '2025-09-28 08:58:01'),
(19, 29, 'happy_allday', 'allday@gmail.com', '01233693664', '2025-09-28 08:58:11'),
(20, 31, 'happy_allday', 'allday@gmail.com', '01233693664', '2025-09-28 08:58:22'),
(21, 27, 'happy_allday', 'allday@gmail.com', '01233693664', '2025-09-28 08:58:29'),
(22, 28, 'happy_allday', 'allday@gmail.com', '01233693664', '2025-09-28 08:58:37'),
(23, 32, 'Tt.', 'Ttbut@gmail.com', '01036936995', '2025-09-28 08:58:52'),
(24, 30, 'GrapeSencha', 'GrapeSencha/@gmail.com', '3696548913', '2025-09-28 09:01:54'),
(25, 32, 'GrapeSencha', 'GrapeSencha/@gmail.com', '3696548913', '2025-09-28 09:02:02'),
(26, 29, 'GrapeSencha', 'GrapeSencha/@gmail.com', '3696548913', '2025-09-28 09:02:11'),
(27, 28, 'GrapeSencha', 'GrapeSencha/@gmail.com', '3696548913', '2025-09-28 09:02:20'),
(28, 27, 'GrapeSencha', 'GrapeSencha/@gmail.com', '3696548913', '2025-09-28 09:02:31'),
(29, 36, 'kawaaa', 'kawakawa@gmail.com', '0123699563', '2025-09-28 09:23:27'),
(30, 37, 'kawaaa', 'kawakawa@gmail.com', '0123699563', '2025-09-28 09:23:36'),
(31, 35, 'kawaaa', 'kawakawa@gmail.com', '0123699563', '2025-09-28 09:23:47'),
(32, 32, 'kawaaa', 'kawakawa@gmail.com', '0123699563', '2025-09-28 09:23:58'),
(33, 28, 'kawaaa', 'kawakawa@gmail.com', '0123699563', '2025-09-28 09:24:08'),
(34, 38, 'Sukiiiii', 'sukiyah@gmail.com', '0136988545', '2025-09-28 09:46:31'),
(35, 36, 'Sukiiiii', 'sukiyah@gmail.com', '0136988545', '2025-09-28 09:46:40'),
(36, 37, 'Sukiiiii', 'sukiyah@gmail.com', '0136988545', '2025-09-28 09:46:48'),
(37, 29, 'Sukiiiii', 'sukiyah@gmail.com', '0136988545', '2025-09-28 09:46:59'),
(38, 40, 'Caratisbella', 'bella@gmail', '0103695823', '2025-09-28 11:38:18'),
(39, 39, 'Caratisbella', 'bella@gmail', '0103695823', '2025-09-28 11:38:30'),
(40, 36, 'Caratisbella', 'bella@gmail', '0103695823', '2025-09-28 11:38:36'),
(41, 37, 'Caratisbella', 'bella@gmail', '0103695823', '2025-09-28 11:38:44'),
(42, 33, 'Caratisbella', 'bella@gmail', '0103695823', '2025-09-28 11:38:51'),
(43, 28, 'Sukiiiii', 'sukiyah@gmail.com', '0136988545', '2025-09-28 11:39:12'),
(44, 27, 'Sukiiiii', 'sukiyah@gmail.com', '0136988545', '2025-09-28 11:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `craft_post_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `post_desc` varchar(255) NOT NULL,
  `post_photo` varchar(100) NOT NULL,
  `member_id` int(11) NOT NULL,
  `categories_id` char(4) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`craft_post_id`, `account_id`, `post_desc`, `post_photo`, `member_id`, `categories_id`, `post_time`) VALUES
(68, 32, 'Painting my love for SEVENTEEN.', 'image/post/craftpost_1758992281.jpg', 2, '2', '2025-09-27 16:58:01'),
(70, 32, 'Youth forever, SEVENTEEN always.', 'image/post/craftpost_1758992420.jpg', 1, '3', '2025-09-27 17:00:20'),
(71, 32, 'Every stroke is a confession to SEVENTEEN.', 'image/post/craftpost_1758993066.jpg', 1, '2', '2025-09-27 17:11:06'),
(72, 34, 'In my drawings, they always shine.', 'image/post/craftpost_1758993195.jpg', 1, '2', '2025-09-27 17:13:15'),
(74, 34, 'Colors of our youth, drawn by hand.', 'image/post/craftpost_1758993276.jpg', 1, '2', '2025-09-27 17:14:36'),
(75, 33, 'Capturing the spotlight on paper.', 'image/post/craftpost_1758993509.jpg', 1, '2', '2025-09-27 17:18:29'),
(76, 33, 'Spreading SEVENTEEN’s energy through art.', 'image/post/craftpost_1758993543.jpg', 1, '3', '2025-09-27 17:19:03'),
(77, 35, 'Design is my love letter to SEVENTEEN.', 'image/post/craftpost_1758993818.jpg', 1, '3', '2025-09-27 17:23:38'),
(78, 35, 'A poster is also a way of cheering.', 'image/post/craftpost_1758993872.jpg', 1, '3', '2025-09-27 17:24:32'),
(79, 35, 'Even in sketches, they shine bright.', 'image/post/craftpost_1758993940.jpg', 1, '2', '2025-09-27 17:25:40'),
(80, 36, 'Drawing is my secret language with SEVENTEEN.', 'image/post/craftpost_1758994133.jpg', 1, '2', '2025-09-27 17:28:53'),
(81, 36, 'Illustrations that carry love and energy.', 'image/post/craftpost_1758994149.jpg', 1, '2', '2025-09-27 17:29:09'),
(82, 36, 'One poster, one memory.', 'image/post/craftpost_1758994186.jpg', 1, '3', '2025-09-27 17:29:46'),
(83, 36, 'Every design shows Carat creativity.', 'image/post/craftpost_1758994215.jpg', 1, '3', '2025-09-27 17:30:15'),
(84, 37, 'Typography and colors speak my feelings.', 'image/post/craftpost_1758994481.jpg', 1, '3', '2025-09-27 17:34:41'),
(85, 37, 'This work is my gift to SEVENTEEN', 'image/post/craftpost_1758994493.jpg', 1, '3', '2025-09-27 17:34:53'),
(86, 37, 'Lines that connect my heart to the stage.', 'image/post/craftpost_1758994536.jpg', 1, '2', '2025-09-27 17:35:36'),
(87, 37, 'They are stars on stage, glowing in my art.', 'image/post/craftpost_1758994552.jpg', 1, '2', '2025-09-27 17:35:52'),
(88, 37, 'Not just faces, but emotions in every line.', 'image/post/craftpost_1758994565.jpg', 1, '2', '2025-09-27 17:36:05'),
(89, 38, 'Turning cheers into visuals.', 'image/post/craftpost_1758994659.jpg', 1, '3', '2025-09-27 17:37:39'),
(90, 38, 'Not just an image, but an emotion.', 'image/post/craftpost_1758994673.jpg', 1, '3', '2025-09-27 17:37:53'),
(91, 38, 'Turning dance rhythms into flowing strokes.', 'image/post/craftpost_1758994714.jpg', 1, '2', '2025-09-27 17:38:34'),
(92, 39, 'My world speaks in colors.', 'image/post/craftpost_1758994792.jpg', 1, '2', '2025-09-27 17:39:52'),
(93, 39, 'Carat love hidden in every illustration', 'image/post/craftpost_1758994819.jpg', 1, '2', '2025-09-27 17:40:19'),
(94, 39, 'Carat posters light up SEVENTEEN’s world.', 'image/post/craftpost_1758994864.jpg', 1, '3', '2025-09-27 17:41:04'),
(95, 39, 'Framing the beauty of the stage.', 'image/post/craftpost_1758994874.jpg', 1, '3', '2025-09-27 17:41:14'),
(96, 40, 'Keeping the heartbeat in a poster.', 'image/post/craftpost_1758994988.jpg', 1, '3', '2025-09-27 17:43:08'),
(97, 40, 'Design that echoes with youth’s rhythm.', 'image/post/craftpost_1758995001.jpg', 1, '3', '2025-09-27 17:43:21'),
(98, 40, 'Through my eyes, they’re the most beautiful view.', 'image/post/craftpost_1758995035.jpg', 1, '2', '2025-09-27 17:43:55'),
(99, 41, 'COOL GUYSSS挂件', 'image/post/craftpost_1758995439.jpg', 6, '1', '2025-09-27 17:50:39'),
(100, 41, 'Finger Usage Reference-Acrylic Chain Bag Hanger', 'image/post/craftpost_1758995480.jpg', 1, '1', '2025-09-27 17:51:20'),
(101, 41, '黑皮miniteen !', 'image/post/craftpost_1758995607.jpg', 1, '4', '2025-09-27 17:53:27'),
(102, 42, '食玩小挂件', 'image/post/craftpost_1758996147.jpg', 5, '1', '2025-09-27 18:02:27'),
(103, 42, '大王扇来袭！', 'image/post/craftpost_1758996221.jpg', 3, '4', '2025-09-27 18:03:41'),
(104, 42, 'I\'m best at fans', 'image/post/craftpost_1758996334.jpg', 1, '4', '2025-09-27 18:05:34'),
(105, 43, 'Great! It\'s SVT.', 'image/post/craftpost_1758996502.jpg', 1, '4', '2025-09-27 18:08:22'),
(106, 43, 'Rotating record pendant', 'image/post/craftpost_1758996572.jpg', 7, '1', '2025-09-27 18:09:32'),
(107, 43, 'Who doesn’t have this ?', 'image/post/craftpost_1758996611.jpg', 3, '1', '2025-09-27 18:10:11'),
(108, 44, 'who can refuse this', 'image/post/craftpost_1758996738.jpg', 1, '1', '2025-09-27 18:12:18'),
(109, 44, 'SVT\'s carabiner', 'image/post/craftpost_1758996774.jpg', 1, '1', '2025-09-27 18:12:54'),
(110, 45, 'Hair trimming and packing', 'image/post/craftpost_1758996916.jpg', 3, '1', '2025-09-27 18:15:16'),
(111, 45, 'Shared catcher', 'image/post/craftpost_1758996965.jpg', 9, '1', '2025-09-27 18:16:05'),
(112, 45, 'What does the keychain look like this', 'image/post/craftpost_1758997059.jpg', 11, '1', '2025-09-27 18:17:39'),
(113, 46, 'Svt pendant 🍀 just keep packing', 'image/post/craftpost_1758997181.jpg', 4, '1', '2025-09-27 18:19:41'),
(114, 46, ' buy a bag of mingyuu', 'image/post/craftpost_1758997222.jpg', 2, '1', '2025-09-27 18:20:22'),
(115, 46, 'dk attribute package hook', 'image/post/craftpost_1758997301.jpg', 8, '1', '2025-09-27 18:21:41'),
(116, 47, 'bag hanging', 'image/post/craftpost_1758997438.jpg', 1, '1', '2025-09-27 18:23:58'),
(117, 47, '★*･ﾟLucky が Visit れる.🍀', 'image/post/craftpost_1758997475.jpg', 8, '1', '2025-09-27 18:24:35'),
(118, 47, 'Achieve embroidery patch freedom', 'image/post/craftpost_1758997531.jpg', 1, '1', '2025-09-27 18:25:31'),
(119, 48, 'Toast bag is loaded', 'image/post/craftpost_1759045997.jpg', 13, '4', '2025-09-28 07:53:17'),
(120, 48, 'Tick-tick, SVT dial', 'image/post/craftpost_1759046034.jpg', 1, '4', '2025-09-28 07:53:54'),
(121, 49, 'Such cute material', 'image/post/craftpost_1759046237.jpg', 5, '4', '2025-09-28 07:57:17'),
(122, 49, 'hoshi 钱包开团', 'image/post/craftpost_1759046310.jpg', 5, '4', '2025-09-28 07:58:30'),
(123, 50, 'Tiger Wave Bracelet', 'image/post/craftpost_1759046679.jpg', 4, '1', '2025-09-28 08:04:39'),
(124, 50, 'Really addictive', 'image/post/craftpost_1759046720.jpg', 1, '4', '2025-09-28 08:05:20'),
(125, 50, 'Hold it to sleep every day', 'image/post/craftpost_1759046855.jpg', 5, '4', '2025-09-28 08:07:35'),
(126, 51, '10th Anniversary Offline ', 'image/post/craftpost_1759047125.jpg', 1, '4', '2025-09-28 08:12:05'),
(127, 51, '🍒🐰🦌🐈🐯🐈‍⬛🍚🐸🐶🐶🍊🐻‍❄️🦦', 'image/post/craftpost_1759047143.jpg', 1, '4', '2025-09-28 08:12:23'),
(128, 52, 'New SVT calendar 2025', 'image/post/craftpost_1759048040.jpg', 1, '4', '2025-09-28 08:27:20'),
(129, 52, 'It\'s a carat notebook', 'image/post/craftpost_1759048057.jpg', 1, '4', '2025-09-28 08:27:37'),
(130, 52, 'The cutest of the cute', 'image/post/craftpost_1759048102.jpg', 9, '4', '2025-09-28 08:28:22'),
(131, 41, 'Mingyu仁川物料', 'image/post/craftpost_1759053041.jpg', 2, '4', '2025-09-28 09:50:41'),
(132, 41, '小葵小葵我们喜欢你', 'image/post/craftpost_1759053081.jpg', 2, '4', '2025-09-28 09:51:21'),
(133, 41, '印之前没人告诉我这么帅', 'image/post/craftpost_1759053160.jpg', 2, '3', '2025-09-28 09:52:40'),
(134, 41, '2gg的拼豆太美了吧！', 'image/post/craftpost_1759053250.jpg', 3, '4', '2025-09-28 09:54:10'),
(135, 41, '好难画呀2哥哥', 'image/post/craftpost_1759053350.jpg', 3, '2', '2025-09-28 09:55:50'),
(136, 42, '发发2gg🫧', 'image/post/craftpost_1759053493.jpg', 3, '2', '2025-09-28 09:58:13'),
(137, 42, '净汉✖️圆佑 THIS MAN', 'image/post/craftpost_1759053684.jpg', 4, '2', '2025-09-28 10:01:24'),
(138, 42, '🖇️全圆佑星星包挂🩶 ☆₊⋆', 'image/post/craftpost_1759053783.jpg', 4, '4', '2025-09-28 10:03:03'),
(139, 42, '萌兔的脸蛋我捏捏捏', 'image/post/craftpost_1759053865.jpg', 3, '4', '2025-09-28 10:04:25'),
(140, 42, '金珉奎美式复古海报', 'image/post/craftpost_1759053933.jpg', 2, '3', '2025-09-28 10:05:33'),
(141, 42, '🇰🇷svt仁川物料', 'image/post/craftpost_1759053957.jpg', 2, '4', '2025-09-28 10:05:57'),
(142, 42, 'C&M小分队', 'image/post/craftpost_1759053992.jpg', 2, '1', '2025-09-28 10:06:32'),
(143, 42, '预告照一出就速速摸鱼☺️粉发太帅了', 'image/post/craftpost_1759054067.jpg', 2, '2', '2025-09-28 10:07:47'),
(144, 42, '28岁Q版Mingyu油够可爱', 'image/post/craftpost_1759054093.jpg', 2, '2', '2025-09-28 10:08:13'),
(145, 42, '这个洪小刷hot11啦！', 'image/post/craftpost_1759054132.jpg', 9, '2', '2025-09-28 10:08:52'),
(146, 42, '☕️𝐒𝐡𝐮𝐚 𝐦𝐨𝐦𝐞𝐧𝐭 ·人生四格卡册', 'image/post/craftpost_1759054155.jpg', 9, '4', '2025-09-28 10:09:15'),
(147, 36, 'green🌿', 'image/post/craftpost_1759054270.jpg', 9, '2', '2025-09-28 10:11:10'),
(148, 36, '․⁺ 𐔌๑甘いあんこ ꒱ഒ ⁺ ․', 'image/post/craftpost_1759054303.jpg', 9, '3', '2025-09-28 10:11:43'),
(149, 51, '发一发 很喜欢现在这个画风', 'image/post/craftpost_1759054493.jpg', 2, '2', '2025-09-28 10:14:53'),
(150, 51, '珉奎痛衣🩷左滑见实物', 'image/post/craftpost_1759054571.jpg', 2, '4', '2025-09-28 10:16:11'),
(151, 51, 'CxM🍒🍫', 'image/post/craftpost_1759054631.jpg', 2, '3', '2025-09-28 10:17:11'),
(152, 51, '无偿分享｜酷+奎海报', 'image/post/craftpost_1759054655.jpg', 11, '3', '2025-09-28 10:17:35'),
(153, 51, '纸钞物料案例| 尹净汉', 'image/post/craftpost_1759055057.jpg', 3, '4', '2025-09-28 10:24:17'),
(154, 51, '实物我扔下就跑。', 'image/post/craftpost_1759055090.jpg', 9, '4', '2025-09-28 10:24:50'),
(155, 51, '🍀约稿＋2😝😝', 'image/post/craftpost_1759055166.jpg', 8, '4', '2025-09-28 10:26:06'),
(156, 51, 'seventeen明信片🧩', 'image/post/craftpost_1759055217.jpg', 10, '3', '2025-09-28 10:26:57'),
(157, 51, '拼贴DKver.', 'image/post/craftpost_1759055261.jpg', 8, '3', '2025-09-28 10:27:41'),
(158, 51, '宣宣硕珉萌物制品团(˵¯͒〰¯͒˵)超级可爱', 'image/post/craftpost_1759055280.jpg', 8, '4', '2025-09-28 10:28:00'),
(159, 51, '🍃🎶🍀', 'image/post/craftpost_1759055307.jpg', 8, '4', '2025-09-28 10:28:27'),
(160, 52, '萌神级别的包挂………', 'image/post/craftpost_1759055392.jpg', 9, '4', '2025-09-28 10:29:52'),
(161, 52, '阳光下的legend级美貌!!', 'image/post/craftpost_1759055459.jpg', 9, '1', '2025-09-28 10:30:59'),
(162, 52, '🇭🇰svt Joshua钥匙扣物料', 'image/post/craftpost_1759055482.jpg', 9, '1', '2025-09-28 10:31:22'),
(163, 52, '人物出现，目标已锁定', 'image/post/craftpost_1759055513.jpg', 9, '3', '2025-09-28 10:31:53'),
(164, 52, '\r\n🧊', 'image/post/craftpost_1759055563.jpg', 9, '2', '2025-09-28 10:32:43'),
(165, 52, 'MINITEEN又双叒叕上新了？', 'image/post/craftpost_1759055685.jpg', 11, '4', '2025-09-28 10:34:45'),
(166, 52, '🇲🇾 scoups生咖物料', 'image/post/craftpost_1759055702.jpg', 11, '4', '2025-09-28 10:35:02'),
(167, 52, 'chu～～\r\n🉑自印用于线下应援 🈲商用\r\n欢迎返图😋\r\n', 'image/post/craftpost_1759055727.jpg', 11, '2', '2025-09-28 10:35:27'),
(168, 50, '新巡物料第三弹💎抽纸我只用SVT进口的\r\n🪡纯手工缝制抽纸包', 'image/post/craftpost_1759055778.jpg', 11, '4', '2025-09-28 10:36:18'),
(169, 50, '我给胜澈出的新杂志🐚', 'image/post/craftpost_1759055801.jpg', 11, '3', '2025-09-28 10:36:41'),
(170, 50, '哈密瓜哈密瓜🍈（开放自印）', 'image/post/craftpost_1759055831.jpg', 11, '2', '2025-09-28 10:37:11'),
(171, 50, '是谁收到了这么萌的返图！！', 'image/post/craftpost_1759055849.jpg', 11, '4', '2025-09-28 10:37:29'),
(172, 39, '崔胜澈｜很新鲜的一个配色', 'image/post/craftpost_1759055899.jpg', 11, '4', '2025-09-28 10:38:19'),
(173, 39, '【崔胜澈】\r\n脸在江山在', 'image/post/craftpost_1759055926.jpg', 11, '3', '2025-09-28 10:38:46'),
(174, 39, '/ᐠ .⸝⸝⸝. ྀིﾏ☎️♫•*¨*•.¸¸♪（小澈来电中…', 'image/post/craftpost_1759055973.jpg', 11, '2', '2025-09-28 10:39:33'),
(175, 39, '年龄line大头贴', 'image/post/craftpost_1759056008.jpg', 12, '2', '2025-09-28 10:40:08'),
(176, 39, 'SVT新巡仁川互换😽🫶🏻', 'image/post/craftpost_1759056059.jpg', 7, '1', '2025-09-28 10:40:59'),
(177, 39, '小gyugyu制作工坊🏭', 'image/post/craftpost_1759056121.jpg', 2, '1', '2025-09-28 10:42:01'),
(178, 39, '冬天❄️的样子', 'image/post/craftpost_1759056146.jpg', 2, '1', '2025-09-28 10:42:26'),
(179, 39, '左滑解锁海报', 'image/post/craftpost_1759056214.jpg', 2, '3', '2025-09-28 10:43:34'),
(181, 39, '啊啊啊萌的我要下奶了', 'image/post/craftpost_1759056306.jpg', 2, '2', '2025-09-28 10:45:06'),
(182, 53, '新兵权顺荣前来报道', 'image/post/craftpost_1759056523.jpg', 5, '2', '2025-09-28 10:48:43'),
(183, 53, '多多多多的小蓝莓！', 'image/post/craftpost_1759056541.jpg', 5, '2', '2025-09-28 10:49:01'),
(184, 53, '荧光小帖图', 'image/post/craftpost_1759056560.jpg', 5, '2', '2025-09-28 10:49:20'),
(185, 53, '', 'image/post/craftpost_1759056581.jpg', 5, '2', '2025-09-28 10:49:41'),
(186, 53, '给这个 hoshi 宇宙，不解释！', 'image/post/craftpost_1759056611.jpg', 5, '4', '2025-09-28 10:50:11'),
(187, 53, '最萌的零钱包出现啦！！！🐯', 'image/post/craftpost_1759056631.jpg', 5, '4', '2025-09-28 10:50:31'),
(188, 53, '拼贴HOSHIver.', 'image/post/craftpost_1759056659.jpg', 5, '3', '2025-09-28 10:50:59'),
(189, 53, '李知勋 倒计时年历', 'image/post/craftpost_1759056790.jpg', 7, '4', '2025-09-28 10:53:10'),
(190, 53, '🛸宇宙宇宙🛸丨李知勋毛巾手幅设计', 'image/post/craftpost_1759056811.jpg', 7, '4', '2025-09-28 10:53:31'),
(191, 53, 'H×W fancon登山扣物料🚨', 'image/post/craftpost_1759056832.jpg', 5, '4', '2025-09-28 10:53:52'),
(192, 53, '包挂练习5.0', 'image/post/craftpost_1759056861.jpg', 7, '1', '2025-09-28 10:54:21'),
(193, 53, 'Woozi不织布挂件', 'image/post/craftpost_1759056895.jpg', 7, '1', '2025-09-28 10:54:55'),
(194, 46, '疑似miniteen新周边流出', 'image/post/craftpost_1759056929.jpg', 7, '1', '2025-09-28 10:55:29'),
(195, 46, '', 'image/post/craftpost_1759056942.jpg', 7, '1', '2025-09-28 10:55:42'),
(196, 46, '🌷这是谁家的小猫呀！！', 'image/post/craftpost_1759056972.jpg', 7, '2', '2025-09-28 10:56:12'),
(197, 46, '豪雨警报', 'image/post/craftpost_1759056990.jpg', 7, '2', '2025-09-28 10:56:30'),
(198, 46, '把你捧在手上🤲【WOOZI】', 'image/post/craftpost_1759057019.jpg', 5, '2', '2025-09-28 10:56:59'),
(199, 46, '次准备了p1四叶草钥匙扣', 'image/post/craftpost_1759057126.jpg', 3, '1', '2025-09-28 10:58:46'),
(200, 46, '净汉生咖物料🎀', 'image/post/craftpost_1759057158.jpg', 3, '1', '2025-09-28 10:59:18'),
(201, 46, '✨This Man✨', 'image/post/craftpost_1759057251.jpg', 3, '2', '2025-09-28 11:00:51'),
(202, 46, '🧿', 'image/post/craftpost_1759057268.jpg', 3, '2', '2025-09-28 11:01:08'),
(203, 46, '无偿分享｜尹净汉海报设计', 'image/post/craftpost_1759057295.jpg', 3, '2', '2025-09-28 11:01:35'),
(204, 46, '美工练习︱尹净汉海报', 'image/post/craftpost_1759057317.jpg', 3, '3', '2025-09-28 11:01:57'),
(206, 46, '✨昭和风海报设计✨Always Yours', 'image/post/craftpost_1759057391.jpg', 11, '3', '2025-09-28 11:03:11'),
(207, 46, '无偿分享｜尹净汉海报设计', 'image/post/craftpost_1759057515.jpg', 3, '3', '2025-09-28 11:05:15'),
(208, 46, '尹净汉海报//🎐', 'image/post/craftpost_1759057536.jpg', 3, '3', '2025-09-28 11:05:36'),
(209, 46, '尹净汉PB·Wanderlust💙', 'image/post/craftpost_1759057554.jpg', 3, '3', '2025-09-28 11:05:54'),
(210, 46, '淡淡的米米的很安心', 'image/post/craftpost_1759057664.jpg', 4, '3', '2025-09-28 11:07:44'),
(211, 46, '【无偿授权】☁️这不是高年级的帅气学长嘛？', 'image/post/craftpost_1759057682.jpg', 4, '3', '2025-09-28 11:08:02'),
(212, 46, 'SEVENTEEN全圆佑Wonwoo海报', 'image/post/craftpost_1759057735.jpg', 4, '3', '2025-09-28 11:08:55'),
(213, 46, '日系海报设计', 'image/post/craftpost_1759057772.jpg', 4, '3', '2025-09-28 11:09:32'),
(214, 53, '波点wonwoo｝🪡🫧🧄𝟷𝟿:𝟹𝟶tonight', 'image/post/craftpost_1759058046.jpg', 4, '4', '2025-09-28 11:14:06'),
(215, 53, '有这样可爱的猫猫进入我家^⎚˕⎚^', 'image/post/craftpost_1759058102.jpg', 4, '4', '2025-09-28 11:15:02'),
(216, 53, '泰推｜全圆佑@ hi_17km9 饭制周边', 'image/post/craftpost_1759058130.jpg', 4, '4', '2025-09-28 11:15:30'),
(217, 53, 'fifi做成手机支架怎么会那么可爱…', 'image/post/craftpost_1759058223.jpg', 10, '4', '2025-09-28 11:17:03'),
(218, 53, '文俊辉｜飞行棋set｜客单展示', 'image/post/craftpost_1759058243.jpg', 10, '4', '2025-09-28 11:17:23'),
(219, 53, '幸运小咪🐈☆🍀₊⋆｜文俊辉钥匙扣设计', 'image/post/craftpost_1759058258.jpg', 10, '1', '2025-09-28 11:17:38'),
(220, 53, '萌物啊啊啊啊 ', 'image/post/craftpost_1759058282.jpg', 10, '1', '2025-09-28 11:18:02'),
(221, 53, 'jun主题生咖设计-小咪の精神世界', 'image/post/craftpost_1759058308.jpg', 10, '3', '2025-09-28 11:18:28'),
(222, 53, '文俊辉X花沢輝気', 'image/post/craftpost_1759058330.jpg', 10, '2', '2025-09-28 11:18:50'),
(223, 53, '战报设计 | 恭喜钻超 FOR文俊辉', 'image/post/craftpost_1759058351.jpg', 10, '3', '2025-09-28 11:19:11'),
(224, 53, '莫啊！橘子含量有点超标了咋整', 'image/post/craftpost_1759058412.jpg', 13, '4', '2025-09-28 11:20:12'),
(225, 53, '无偿分享🍊胜宽相关无料', 'image/post/craftpost_1759058429.jpg', 13, '3', '2025-09-28 11:20:29'),
(226, 53, '右滑➡️看橘子宝宝🍊出生！', 'image/post/craftpost_1759058447.jpg', 13, '4', '2025-09-28 11:20:47'),
(227, 53, '论夫胜宽和波点的适配性', 'image/post/craftpost_1759058461.jpg', 13, '3', '2025-09-28 11:21:01'),
(228, 49, '♡～小灿日记🦦', 'image/post/craftpost_1759058555.jpg', 14, '2', '2025-09-28 11:22:35'),
(229, 49, '🌟DINO生咖*SET设计🫧 ⊹꙳ 🫧', 'image/post/craftpost_1759058578.jpg', 14, '4', '2025-09-28 11:22:58'),
(230, 49, 'dino dino dino🍔\r\n一个美式主题的设计set', 'image/post/craftpost_1759058592.jpg', 14, '3', '2025-09-28 11:23:12'),
(231, 49, 'Dino.saur\r\n水龙小餐包🥣', 'image/post/craftpost_1759058606.jpg', 14, '4', '2025-09-28 11:23:26'),
(232, 49, '🍋柠檬小灿努努图纸', 'image/post/craftpost_1759058628.jpg', 14, '4', '2025-09-28 11:23:48'),
(233, 49, '试试看裸眼3D', 'image/post/craftpost_1759058648.jpg', 14, '2', '2025-09-28 11:24:08'),
(234, 49, '橘子包预览', 'image/post/craftpost_1759058681.jpg', 13, '4', '2025-09-28 11:24:41'),
(235, 49, '🐸🐈‍⬛ 徐明浩～', 'image/post/craftpost_1759058734.jpg', 6, '4', '2025-09-28 11:25:34'),
(236, 49, '自印开放💚🌠', 'image/post/craftpost_1759058751.jpg', 6, '2', '2025-09-28 11:25:51'),
(237, 49, '一个明浩音乐节物料预览', 'image/post/craftpost_1759058766.jpg', 6, '1', '2025-09-28 11:26:06'),
(238, 49, '徐明浩｜杜邦袋设计', 'image/post/craftpost_1759058785.jpg', 6, '4', '2025-09-28 11:26:25'),
(239, 49, '天啊!！本来打算送人，打开后不舍得送了！', 'image/post/craftpost_1759058808.jpg', 6, '4', '2025-09-28 11:26:48'),
(240, 49, '第一次做海报🥹', 'image/post/craftpost_1759058825.jpg', 6, '3', '2025-09-28 11:27:05'),
(241, 49, '这就是艺术家吗👆🏻', 'image/post/craftpost_1759058845.jpg', 6, '3', '2025-09-28 11:27:25'),
(242, 49, '徐明浩｜cd设计', 'image/post/craftpost_1759058882.jpg', 6, '4', '2025-09-28 11:28:02'),
(243, 49, '电子小熊堂堂驾到', 'image/post/craftpost_1759058914.jpg', 12, '4', '2025-09-28 11:28:34'),
(244, 49, '🐻‍❄️｜Vernon_📷🤍', 'image/post/craftpost_1759058965.jpg', 12, '3', '2025-09-28 11:29:25'),
(245, 49, 'vernon不织布图纸🐻‍❄️', 'image/post/craftpost_1759058987.jpg', 12, '4', '2025-09-28 11:29:47'),
(246, 49, '不要再撕pb啦！电子拼贴你值得拥有～', 'image/post/craftpost_1759059030.jpg', 12, '3', '2025-09-28 11:30:30'),
(247, 49, '这下真生出来了啊！！', 'image/post/craftpost_1759059092.jpg', 13, '1', '2025-09-28 11:31:32'),
(248, 49, '…有人能懂吗🥹🥹', 'image/post/craftpost_1759059109.jpg', 13, '1', '2025-09-28 11:31:49'),
(249, 49, '小咘亚克力钥匙扣～', 'image/post/craftpost_1759059133.jpg', 13, '1', '2025-09-28 11:32:13'),
(250, 40, 'SVT🇭🇰物料', 'image/post/craftpost_1759059208.jpg', 12, '1', '2025-09-28 11:33:28'),
(251, 40, '🍎自制｜vernon钥匙扣🐻‍❄️', 'image/post/craftpost_1759059228.jpg', 12, '1', '2025-09-28 11:33:48'),
(252, 40, '🇲🇾 稿件|一群萌物', 'image/post/craftpost_1759059297.jpg', 12, '2', '2025-09-28 11:34:57'),
(253, 40, '画了几只海星体瀚率', 'image/post/craftpost_1759059321.jpg', 12, '2', '2025-09-28 11:35:21'),
(254, 40, '崔瀚率请多多上音乐节', 'image/post/craftpost_1759059339.jpg', 12, '2', '2025-09-28 11:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `craft_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `account_id`, `craft_post_id`) VALUES
(38, 28, 61),
(39, 28, 58),
(52, 29, 61),
(53, 29, 60),
(54, 30, 58),
(56, 31, 61),
(57, 31, 58),
(58, 31, 60),
(59, 30, 59),
(60, 30, 61),
(62, 24, 60),
(66, 24, 63),
(67, 24, 58),
(68, 24, 64),
(100, 14, 60),
(109, 14, 59),
(110, 14, 63),
(113, 14, 64),
(115, 40, 84),
(116, 40, 73),
(117, 40, 78),
(132, 49, 64),
(133, 49, 58),
(134, 49, 106),
(135, 49, 102),
(136, 49, 99),
(137, 49, 109),
(138, 49, 107),
(139, 49, 114),
(140, 49, 113),
(141, 49, 111),
(142, 49, 117),
(143, 49, 116),
(144, 49, 68),
(147, 49, 74),
(148, 49, 79),
(150, 49, 86),
(151, 49, 81),
(152, 49, 93),
(153, 49, 92),
(154, 49, 88),
(156, 49, 101),
(159, 49, 105),
(162, 49, 75),
(163, 49, 72),
(164, 49, 80),
(165, 49, 87),
(166, 49, 91),
(167, 49, 98),
(169, 50, 100),
(170, 50, 109),
(171, 50, 108),
(172, 50, 107),
(173, 50, 106),
(174, 50, 110),
(175, 50, 113),
(176, 50, 112),
(177, 50, 111),
(178, 50, 115),
(179, 50, 118),
(180, 50, 117),
(182, 50, 73),
(183, 50, 77),
(184, 50, 78),
(185, 50, 76),
(186, 50, 83),
(187, 50, 82),
(188, 50, 84),
(189, 50, 85),
(190, 50, 94),
(191, 50, 90),
(192, 50, 89),
(193, 50, 97),
(194, 50, 96),
(195, 50, 95),
(196, 50, 71),
(197, 50, 74),
(198, 50, 72),
(199, 50, 79),
(200, 50, 80),
(201, 50, 88),
(202, 50, 87),
(203, 50, 86),
(204, 50, 81),
(205, 50, 92),
(206, 50, 93),
(207, 50, 98),
(208, 50, 101),
(209, 50, 103),
(210, 50, 104),
(211, 50, 119),
(212, 50, 105),
(213, 50, 120),
(217, 51, 80),
(218, 51, 79),
(219, 51, 74),
(220, 51, 87),
(221, 51, 86),
(222, 51, 92),
(223, 51, 93),
(224, 51, 81),
(225, 51, 88),
(226, 51, 98),
(227, 51, 91),
(228, 51, 69),
(230, 51, 70),
(231, 51, 78),
(232, 51, 73),
(233, 51, 77),
(234, 51, 76),
(235, 51, 83),
(236, 51, 84),
(237, 51, 85),
(238, 51, 94),
(239, 51, 90),
(240, 51, 89),
(242, 51, 97),
(243, 51, 96),
(244, 51, 95),
(245, 51, 71),
(247, 51, 100),
(248, 51, 102),
(250, 51, 109),
(251, 51, 108),
(252, 51, 113),
(253, 51, 112),
(254, 51, 111),
(255, 51, 110),
(256, 51, 114),
(257, 51, 118),
(258, 51, 117),
(259, 51, 116),
(260, 51, 115),
(261, 51, 123),
(263, 52, 106),
(264, 52, 102),
(265, 52, 100),
(266, 52, 99),
(267, 52, 107),
(268, 52, 108),
(269, 52, 109),
(270, 52, 110),
(271, 52, 113),
(272, 52, 114),
(273, 52, 118),
(274, 52, 117),
(275, 52, 116),
(276, 52, 123),
(277, 52, 69),
(279, 52, 73),
(280, 52, 78),
(281, 52, 76),
(282, 52, 84),
(283, 52, 83),
(284, 52, 90),
(285, 52, 94),
(286, 52, 126),
(287, 52, 97),
(288, 52, 71),
(289, 52, 68),
(290, 52, 79),
(291, 52, 74),
(292, 52, 87),
(293, 52, 86),
(294, 52, 92),
(295, 52, 98),
(296, 52, 91),
(297, 52, 103),
(298, 52, 101),
(299, 52, 119),
(300, 52, 105),
(301, 52, 120),
(302, 52, 121),
(303, 52, 104),
(304, 52, 127),
(305, 52, 125),
(306, 52, 124),
(308, 52, 122),
(309, 52, 59),
(319, 48, 71),
(320, 48, 79),
(323, 48, 59),
(324, 48, 70),
(325, 49, 124),
(326, 49, 125),
(327, 49, 127),
(328, 49, 120),
(329, 49, 103),
(330, 49, 71),
(332, 46, 102),
(333, 46, 61),
(334, 46, 99),
(335, 46, 106),
(339, 46, 111),
(340, 46, 114),
(341, 46, 116),
(342, 46, 115),
(343, 46, 123),
(344, 46, 118),
(347, 46, 78),
(348, 46, 77),
(349, 46, 73),
(350, 46, 83),
(351, 46, 82),
(352, 46, 94),
(353, 46, 90),
(354, 46, 97),
(355, 46, 96),
(356, 46, 95),
(357, 46, 89),
(363, 46, 80),
(366, 46, 81),
(373, 46, 104),
(375, 46, 101),
(376, 46, 119),
(377, 46, 120),
(378, 46, 105),
(379, 46, 121),
(380, 46, 127),
(381, 46, 125),
(382, 46, 124),
(383, 46, 129),
(384, 46, 130),
(385, 46, 122),
(386, 46, 128),
(387, 50, 69),
(389, 50, 130),
(390, 50, 129),
(391, 50, 128),
(392, 50, 124),
(393, 50, 127),
(394, 50, 121),
(395, 50, 122),
(397, 48, 61),
(398, 48, 102),
(399, 48, 100),
(400, 48, 99),
(401, 48, 106),
(402, 48, 110),
(403, 48, 109),
(404, 48, 108),
(405, 48, 107),
(406, 48, 112),
(407, 48, 113),
(408, 48, 114),
(409, 48, 118),
(410, 48, 116),
(411, 48, 115),
(412, 48, 111),
(413, 48, 123),
(414, 48, 78),
(415, 48, 73),
(416, 48, 76),
(417, 48, 83),
(418, 48, 126),
(419, 48, 97),
(420, 48, 94),
(421, 48, 90),
(422, 48, 95),
(423, 48, 89),
(424, 48, 96),
(425, 48, 122),
(426, 48, 124),
(427, 48, 125),
(428, 48, 127),
(429, 48, 121),
(430, 48, 120),
(431, 48, 119),
(432, 48, 101),
(433, 48, 103),
(434, 48, 104),
(435, 48, 105),
(436, 47, 101),
(438, 47, 104),
(439, 47, 105),
(440, 47, 119),
(441, 47, 120),
(442, 47, 121),
(443, 47, 125),
(444, 47, 124),
(445, 47, 122),
(446, 47, 127),
(447, 47, 130),
(448, 47, 129),
(449, 47, 128),
(450, 47, 71),
(451, 47, 68),
(452, 47, 75),
(453, 47, 80),
(454, 47, 79),
(455, 47, 74),
(456, 47, 72),
(457, 47, 86),
(458, 47, 81),
(459, 47, 87),
(460, 47, 88),
(461, 47, 98),
(462, 47, 93),
(463, 47, 92),
(464, 47, 91),
(467, 47, 73),
(468, 47, 76),
(469, 47, 77),
(470, 47, 78),
(471, 47, 84),
(472, 47, 83),
(473, 47, 82),
(474, 47, 85),
(475, 47, 95),
(476, 47, 94),
(477, 47, 90),
(478, 47, 89),
(479, 47, 96),
(480, 47, 97),
(481, 47, 126),
(482, 47, 69),
(485, 47, 102),
(486, 47, 100),
(487, 47, 99),
(488, 47, 107),
(489, 47, 108),
(490, 47, 109),
(491, 47, 110),
(492, 47, 114),
(493, 47, 113),
(494, 47, 112),
(495, 47, 111),
(496, 47, 115),
(497, 47, 116),
(499, 47, 118),
(500, 47, 123),
(501, 47, 106),
(502, 47, 103),
(503, 47, 117),
(508, 45, 106),
(509, 45, 102),
(510, 45, 100),
(511, 45, 99),
(512, 45, 108),
(513, 45, 107),
(514, 45, 109),
(515, 45, 110),
(516, 45, 114),
(517, 45, 113),
(518, 45, 112),
(519, 45, 111),
(520, 45, 116),
(521, 45, 115),
(522, 45, 117),
(523, 45, 118),
(524, 45, 123),
(525, 45, 70),
(526, 45, 69),
(527, 45, 59),
(528, 45, 76),
(529, 45, 73),
(530, 45, 77),
(531, 45, 78),
(532, 45, 84),
(533, 45, 83),
(534, 45, 82),
(535, 45, 85),
(536, 45, 95),
(537, 45, 94),
(538, 45, 90),
(539, 45, 89),
(547, 45, 81),
(551, 45, 98),
(552, 45, 93),
(553, 45, 92),
(554, 45, 91),
(555, 45, 80),
(557, 45, 87),
(558, 45, 88),
(559, 45, 86),
(560, 45, 101),
(561, 45, 103),
(562, 45, 104),
(563, 45, 105),
(564, 45, 119),
(565, 45, 120),
(566, 45, 121),
(567, 45, 125),
(568, 45, 124),
(569, 45, 122),
(570, 45, 127),
(571, 45, 130),
(572, 45, 129),
(573, 45, 128),
(574, 44, 99),
(575, 44, 100),
(576, 44, 102),
(577, 44, 106),
(578, 44, 109),
(579, 44, 108),
(580, 44, 107),
(581, 44, 110),
(582, 44, 114),
(583, 44, 113),
(584, 44, 112),
(585, 44, 111),
(586, 44, 115),
(587, 44, 116),
(588, 44, 117),
(589, 44, 118),
(590, 44, 123),
(591, 44, 69),
(592, 44, 70),
(593, 44, 59),
(594, 44, 76),
(595, 44, 73),
(596, 44, 77),
(597, 44, 78),
(598, 44, 85),
(599, 44, 83),
(600, 44, 82),
(601, 44, 84),
(602, 44, 90),
(603, 44, 89),
(604, 44, 95),
(605, 44, 94),
(607, 44, 97),
(608, 44, 96),
(609, 44, 126),
(625, 41, 132),
(626, 41, 131),
(628, 42, 146),
(630, 36, 148),
(631, 36, 101),
(632, 36, 131),
(633, 36, 132),
(635, 36, 134),
(636, 36, 103),
(637, 36, 104),
(638, 36, 138),
(639, 36, 105),
(640, 36, 146),
(641, 36, 141),
(642, 36, 139),
(643, 36, 119),
(644, 36, 120),
(645, 36, 121),
(646, 36, 122),
(647, 36, 127),
(648, 36, 124),
(649, 36, 129),
(650, 36, 130),
(651, 36, 128),
(652, 36, 68),
(653, 36, 71),
(654, 36, 75),
(655, 36, 80),
(656, 36, 79),
(657, 36, 74),
(658, 36, 87),
(659, 36, 86),
(660, 36, 81),
(661, 36, 91),
(662, 36, 88),
(663, 36, 92),
(664, 36, 93),
(665, 36, 137),
(666, 36, 136),
(667, 36, 135),
(668, 36, 98),
(669, 36, 144),
(670, 36, 143),
(671, 36, 145),
(672, 36, 142),
(673, 36, 102),
(674, 36, 100),
(675, 36, 99),
(676, 36, 107),
(677, 36, 109),
(678, 36, 113),
(679, 36, 112),
(680, 36, 111),
(681, 36, 110),
(682, 36, 115),
(683, 36, 116),
(684, 36, 117),
(685, 36, 114),
(686, 36, 123),
(687, 36, 118),
(688, 51, 142),
(689, 51, 106),
(690, 52, 164),
(691, 52, 163),
(692, 52, 166),
(693, 52, 165),
(694, 52, 167),
(695, 52, 162),
(696, 52, 161),
(697, 52, 160),
(698, 53, 178),
(699, 53, 177),
(700, 53, 176),
(701, 53, 99),
(702, 53, 142),
(703, 53, 100),
(704, 53, 106),
(705, 53, 109),
(706, 53, 108),
(707, 53, 113),
(708, 53, 112),
(709, 53, 111),
(710, 53, 117),
(711, 53, 116),
(712, 53, 118),
(713, 53, 162),
(714, 53, 161),
(715, 53, 80),
(716, 53, 79),
(717, 53, 74),
(718, 53, 86),
(719, 53, 147),
(720, 53, 81),
(721, 53, 87),
(722, 53, 92),
(723, 53, 91),
(724, 53, 174),
(725, 53, 175),
(726, 53, 181),
(727, 53, 98),
(728, 53, 136),
(729, 53, 135),
(730, 53, 137),
(731, 53, 143),
(732, 53, 149),
(733, 53, 170),
(734, 53, 145),
(735, 53, 167),
(736, 53, 182),
(737, 53, 183),
(738, 53, 164),
(740, 53, 184),
(741, 53, 103),
(742, 53, 101),
(743, 53, 131),
(744, 53, 134),
(745, 53, 139),
(746, 53, 141),
(747, 53, 138),
(748, 53, 146),
(749, 53, 120),
(750, 53, 119),
(751, 53, 125),
(752, 53, 124),
(753, 53, 168),
(754, 53, 150),
(755, 53, 153),
(756, 53, 127),
(757, 53, 159),
(758, 53, 158),
(759, 53, 155),
(760, 53, 154),
(761, 53, 165),
(762, 53, 166),
(764, 53, 187),
(765, 53, 160),
(766, 53, 130),
(767, 53, 129),
(768, 53, 128),
(772, 46, 177),
(773, 46, 178),
(774, 46, 142),
(775, 46, 181),
(776, 46, 143),
(777, 46, 144),
(778, 46, 133),
(779, 46, 179),
(780, 46, 140),
(782, 46, 131),
(783, 46, 132),
(784, 46, 141),
(785, 46, 150),
(789, 46, 135),
(792, 46, 71),
(793, 46, 68),
(794, 46, 213),
(795, 46, 210),
(796, 46, 211),
(797, 46, 212),
(798, 46, 209),
(802, 46, 203),
(803, 46, 206),
(804, 46, 200),
(806, 46, 202),
(807, 46, 198),
(808, 46, 197),
(809, 46, 199),
(812, 46, 194),
(813, 46, 113),
(814, 46, 139),
(815, 46, 153),
(816, 46, 134),
(817, 46, 103),
(818, 46, 208),
(819, 46, 207),
(820, 46, 201),
(821, 46, 136),
(822, 53, 227),
(823, 53, 226),
(824, 53, 223),
(825, 53, 224),
(826, 53, 225),
(827, 53, 222),
(828, 53, 221),
(829, 53, 220),
(830, 53, 219),
(831, 53, 218),
(832, 53, 217),
(833, 53, 215),
(834, 53, 214),
(835, 53, 216),
(836, 53, 193),
(837, 53, 192),
(838, 53, 191),
(839, 53, 190),
(840, 53, 189),
(841, 53, 188),
(842, 53, 186),
(843, 53, 185),
(846, 40, 230),
(847, 40, 229),
(848, 40, 231),
(849, 40, 232),
(850, 40, 79),
(851, 40, 74),
(852, 40, 72),
(853, 40, 80),
(854, 40, 75),
(855, 40, 71),
(856, 40, 68),
(857, 40, 60),
(858, 40, 86),
(859, 40, 92),
(860, 40, 91),
(861, 40, 88),
(862, 40, 174),
(863, 40, 175),
(864, 40, 181),
(865, 40, 98),
(866, 40, 135),
(867, 40, 254),
(868, 40, 253),
(869, 40, 252),
(870, 40, 136),
(871, 40, 137),
(872, 40, 143),
(873, 40, 144),
(874, 40, 198),
(875, 40, 197),
(876, 40, 196),
(878, 40, 201),
(879, 40, 202),
(880, 40, 203),
(881, 40, 170),
(882, 40, 149),
(883, 40, 182),
(884, 40, 167),
(886, 40, 184),
(887, 40, 222),
(888, 40, 183),
(889, 40, 233),
(890, 40, 161),
(891, 40, 111),
(892, 40, 162),
(893, 40, 147),
(894, 40, 163),
(895, 40, 148),
(896, 40, 154),
(897, 40, 146),
(898, 40, 130),
(899, 40, 160),
(900, 28, 237),
(901, 28, 247),
(902, 28, 118),
(903, 28, 142),
(904, 28, 106),
(905, 28, 107),
(906, 28, 108),
(907, 28, 177),
(909, 28, 176),
(911, 28, 251),
(912, 28, 100),
(913, 28, 115),
(914, 28, 199),
(915, 28, 220),
(917, 28, 77),
(918, 28, 83),
(920, 28, 90),
(921, 28, 89),
(922, 28, 179),
(923, 28, 173),
(924, 28, 96),
(925, 28, 140),
(926, 28, 133),
(927, 28, 207),
(928, 28, 208),
(929, 28, 209),
(930, 28, 212),
(931, 28, 211),
(932, 28, 210),
(933, 28, 213),
(934, 28, 244),
(935, 28, 241),
(936, 28, 240),
(937, 28, 169),
(938, 28, 246),
(939, 28, 225),
(940, 28, 221),
(941, 28, 188),
(942, 28, 250),
(943, 28, 178),
(944, 46, 195),
(945, 46, 196);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `profile_name` varchar(20) NOT NULL,
  `profile_email` varchar(40) NOT NULL,
  `profile_desc` varchar(255) NOT NULL,
  `profile_gender` char(1) NOT NULL,
  `profile_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `account_id`, `profile_name`, `profile_email`, `profile_desc`, `profile_gender`, `profile_photo`) VALUES
(6, 24, 'angel', 'angeline@gmail.com', 'nnnn', 'F', 'image/profile/kairou_1758363826.jpg'),
(7, 23, '2415744', 's11a@gmail.com', '猪猪侠', 'F', 'image/profile/kairou_1758366454.jpg'),
(8, 14, 'meiguee', 'tkr@gmail.com', 'welcome to my profile', 'F', 'image/profile/kairou_1758981848.jpg'),
(9, 28, 'admin2', 'admin2@gmail.com', 'xasascasc', 'M', 'image/profile/admin_1758801317.png'),
(10, 32, 'ANGELINE', 'ANGELINE@gmail', '最爱SVT！！欢迎各位来看我的作品！', 'F', 'image/profile/profile_1758992116.jpg'),
(11, 33, 'MOMO', 'MOMO9@gmail.com', '梦想飞去韩国见宝宝们！', 'F', 'image/profile/profile_1758993326.jpg'),
(12, 34, 'ZHIXUAN', 'ZHIXUAN@gmail.com', 'I LOVE SEVENTEEN! 55555', 'F', 'image/profile/profile_1758993168.jpg'),
(13, 35, 'SVT_BB', 'SVT@gmail.com', '', 'M', 'image/profile/profile_1758993786.jpg'),
(14, 36, 'Carat_diamond', 'carat@gmail.com', '我是MINGYU的老婆', 'F', 'image/profile/profile_1758994090.jpg'),
(15, 37, 'BB_CARAT', 'BB@gmail.com', '猜猜我最爱的是谁', 'F', 'image/profile/profile_1758994434.jpg'),
(16, 38, 'RyanSoul', 'ryan@gmail.com', '', 'M', 'image/profile/profile_1758994632.jpg'),
(17, 39, 'Caratland', 'land@gmail.com', '', 'F', 'image/profile/profile_1758994768.jpg'),
(18, 40, 'Caratisbella', 'bella@gmail.com', '我爱MINGYU!!!!', 'F', 'image/profile/profile_1758994963.jpg'),
(19, 41, 'Sukiiiii', 'sukiyah@gmail.com', '大家有兴趣可以找我噢', 'F', 'image/profile/profile_1758995376.jpg'),
(20, 42, 'dont\'move', '8812loke@gmail.com', '没心没肺 no heard no lungggg', 'M', 'image/profile/profile_1758996081.jpg'),
(21, 43, 'kawaaa', 'kawakawa@gmail.com', 'don\'t underestimate me', 'F', 'image/profile/profile_1758996458.jpg'),
(22, 44, 'Studio craft', 'Studiocraft888@gmail.com', '可商用，可自印，可约稿', 'F', 'image/profile/profile_1758996707.jpg'),
(23, 45, 'GrapeSencha', 'GrapeSencha/@gmail.com', '小猫之上', 'F', 'image/profile/profile_1758996869.jpg'),
(24, 46, 'Tt.', 'Ttbut@gmail.com', 'T-T', 'M', 'image/profile/profile_1758997144.jpg'),
(25, 47, 'happy_allday', 'allday@gmail.com', 'run for your svt', 'F', 'image/profile/profile_1758997407.jpg'),
(26, 48, 'big_orange', '0rangegode@gmail.com', 'Blesss u', 'F', 'image/profile/profile_1759045961.jpg'),
(27, 49, 'Yaxaiio', 'Yaxaiio5566@gmail.com', '学生党 X 伸手党', 'M', 'image/profile/profile_1759046215.jpg'),
(28, 50, 'H27L', 'bbkl2233@gmail.com', '什么手串可以串一辈子', 'F', 'image/profile/profile_1759046567.jpg'),
(29, 51, 'jiong jiong', 'jiongjiong@gmail.com', '-Keep happiness-\r\nEXO和SEVENTEEN全肯定\r\n不定时更新画稿和视频剪辑😘\r\n谢谢你的喜欢૮ฅ\'ᴥ\'ฅა', 'F', 'image/profile/profile_1759047097.jpg'),
(30, 52, 'wwuwwwyy', 'wuwuwu@gmai.com', '🍒🐯💎', 'F', 'image/profile/profile_1759047957.jpg'),
(31, 53, 'bighan', 'hanhan@gmail.com', '大寒寒寒寒', 'F', 'image/profile/profile_1759056494.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seventeen_member`
--

CREATE TABLE `seventeen_member` (
  `member_id` int(11) NOT NULL,
  `member_name` char(20) NOT NULL,
  `member_photo` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE `socialmedia` (
  `profile_id` int(11) NOT NULL,
  `social_media_id` int(11) NOT NULL,
  `social_media_type` varchar(60) NOT NULL,
  `social_media_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`profile_id`, `social_media_id`, `social_media_type`, `social_media_link`) VALUES
(22, 6, 'facebook', 'https://www.facebook.com/login.php/'),
(22, 7, 'instagram', 'asdfZXZC'),
(23, 28, 'instagram', 'asdfZXZC'),
(24, 42, 'instagram', 'asdf'),
(24, 43, 'email', 'asdf'),
(24, 44, 'tiktok', 'sdf'),
(14, 46, 'instagram', 'sdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_username` (`account_username`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_photo`
--
ALTER TABLE `event_photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event_signup`
--
ALTER TABLE `event_signup`
  ADD PRIMARY KEY (`signup_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`craft_post_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`social_media_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `event_photo`
--
ALTER TABLE `event_photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `event_signup`
--
ALTER TABLE `event_signup`
  MODIFY `signup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `craft_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=946;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `socialmedia`
--
ALTER TABLE `socialmedia`
  MODIFY `social_media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_photo`
--
ALTER TABLE `event_photo`
  ADD CONSTRAINT `event_photo_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_signup`
--
ALTER TABLE `event_signup`
  ADD CONSTRAINT `event_signup_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
