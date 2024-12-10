-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2021 at 07:39 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `topup_amount` varchar(11) COLLATE utf8_unicode_ci DEFAULT '0',
  `transaction` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `uid`, `username`, `action`, `date`, `topup_amount`, `transaction`, `phone`) VALUES
(1, '762', 'KeamKRUB', '0', '0', '0', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `rank` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `rank`, `description`) VALUES
(1, 'KeamKRUB', 'Admin', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `id` int(11) NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announce`
--

INSERT INTO `announce` (`id`, `html`, `date_create`) VALUES
(1, 'ยังไม่มีโปรโมชันจ้าา', '29/08/2021 12:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `authme`
--

CREATE TABLE `authme` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `lastlogin` bigint(20) DEFAULT 0,
  `x` double NOT NULL DEFAULT 0,
  `y` double NOT NULL DEFAULT 0,
  `z` double NOT NULL DEFAULT 0,
  `world` varchar(255) DEFAULT 'world',
  `email` varchar(255) DEFAULT 'your@email.com',
  `isLogged` smallint(6) NOT NULL DEFAULT 0,
  `hasSession` smallint(6) NOT NULL DEFAULT 0,
  `points` int(255) NOT NULL DEFAULT 0,
  `rp` varchar(255) NOT NULL DEFAULT '0',
  `eve` varchar(255) NOT NULL DEFAULT '0',
  `count` int(11) DEFAULT 0,
  `status` enum('member','admin') NOT NULL DEFAULT 'member',
  `topup` double(62,2) NOT NULL DEFAULT 0.00,
  `regdate` bigint(20) NOT NULL DEFAULT 0,
  `regip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `yaw` float DEFAULT NULL,
  `pitch` float DEFAULT NULL,
  `topup_m` double(64,2) NOT NULL DEFAULT 0.00,
  `Ac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `boxrandom`
--

CREATE TABLE `boxrandom` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` varchar(256) NOT NULL,
  `pic` varchar(256) NOT NULL,
  `it1` int(11) NOT NULL,
  `it2` int(11) NOT NULL,
  `it3` int(11) NOT NULL,
  `it4` int(11) NOT NULL,
  `it5` int(11) NOT NULL,
  `it6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `boxrandom` (`id`, `name`, `price`) VALUES
(1, 'Test', '10');
-- --------------------------------------------------------

--
-- Table structure for table `bungeecord`
--

CREATE TABLE `bungeecord` (
  `id` int(11) NOT NULL,
  `name_server` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_server` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bungeecord`
--

INSERT INTO `bungeecord` (`id`, `name_server`, `ip_server`, `port`, `password`) VALUES
(1. 'Test', '127.0.0.1', '25565', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `username`, `description`) VALUES
(1, 'KeamKRUB', '.asdasd.');

-- --------------------------------------------------------

--
-- Table structure for table `daypro`
--

CREATE TABLE `daypro` (
  `id` int(11) NOT NULL,
  `sunday` varchar(256) NOT NULL,
  `monday` varchar(256) NOT NULL,
  `tuesday` varchar(256) NOT NULL,
  `wednesday` varchar(256) NOT NULL,
  `thursday` varchar(256) NOT NULL,
  `friday` varchar(256) NOT NULL,
  `saturday` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daypro`
--

INSERT INTO `daypro` (`id`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id` int(11) NOT NULL,
  `mc_download` varchar(255) NOT NULL,
  `ja64_download` varchar(255) NOT NULL,
  `ja32_download` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `id` int(11) NOT NULL,
  `uid_send` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `uid_receive` int(11) NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `command` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`id`, `uid_send`, `uid_receive`, `date`, `img`, `command`, `name`, `server_id`) VALUES
(1, '', , '', '', 'sun', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `ivusername` varchar(256) NOT NULL,
  `ip` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`id`, `username`, `ivusername`, `ip`, `status`) VALUES
(1, 'KeamKRUB', 'test', '', 'สำเร็จ');

-- --------------------------------------------------------

--
-- Table structure for table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `mission` varchar(256) NOT NULL,
  `ip` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission`
--

INSERT INTO `mission` (`id`, `mission`, `ip`, `username`) VALUES
(1, 'miss1', '', 'KeamKRUB');

-- --------------------------------------------------------

--
-- Table structure for table `missionrcon`
--

CREATE TABLE `missionrcon` (
  `id` int(11) NOT NULL,
  `ip_server` varchar(256) NOT NULL,
  `port` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `missionrcon`
--

INSERT INTO `missionrcon` (`id`, `ip_server`, `port`, `password`) VALUES
(1, '127.0.0.1', 'none', '');

-- --------------------------------------------------------

--
-- Table structure for table `missionset`
--

CREATE TABLE `missionset` (
  `id` int(11) NOT NULL,
  `missionname` varchar(256) NOT NULL,
  `count` varchar(256) NOT NULL,
  `mess` text NOT NULL,
  `com1` text NOT NULL,
  `com2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `missionset`
--

INSERT INTO `missionset` (`id`, `missionname`, `count`, `mess`, `com1`, `com2`) VALUES
(1, 'test1', '500', 'เงิน 10000 ลามี่', 'eco give <player> 100000');

-- --------------------------------------------------------

--
-- Table structure for table `random`
--

CREATE TABLE `random` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `pic` varchar(256) NOT NULL,
  `cmd1` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `random` (`id`, `name`, `pic`, `cmd1`) VALUES
(1, 'Test', 'https://imgur.com/ZItN4Wk.png', 'mi load custom %player% test 1');

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL DEFAULT '@amc',
  `cmd` varchar(256) NOT NULL DEFAULT '9999',
  `cmd1` varchar(256) NOT NULL,
  `cmd2` varchar(256) NOT NULL,
  `mincount` int(11) NOT NULL,
  `counts` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id`, `code`, `cmd`, `cmd1`, `cmd2`, `mincount`, `counts`, `status`, `date`) VALUES
(1, 'Test', '150', '0', '0', 0, '1', '1', '2020-12-10 17:29');
(2, 'Test2', '150', '0', '0', 0, '1', '1', '2020-12-10 17:29');

-- --------------------------------------------------------

--
-- Table structure for table `redeemm`
--

CREATE TABLE `redeemm` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `ip` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `redeemm`
--

INSERT INTO `redeemm` (`id`, `username`, `code`, `ip`) VALUES
(1, 'KeamKRUB', 'Test2', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `redeemmember`
--

CREATE TABLE `redeemmember` (
  `id` int(11) NOT NULL,
  `count` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `redeemmember`
--

INSERT INTO `redeemmember` (`id`, `count`) VALUES
(1, '28');

-- --------------------------------------------------------

--
-- Table structure for table `rp`
--

CREATE TABLE `rp` (
  `id` int(11) NOT NULL,
  `rp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `rp` (`id`, `rp`) VALUES
(1, '1');
-- --------------------------------------------------------

--
-- Table structure for table `rp_shop`
--

CREATE TABLE `rp_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `command` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `rp_shop` (`id`, `name`, `price`, `category`, `pic`, `server_id`) VALUES
(1, 'Test', '100', 'test', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `backend_password` varchar(255) NOT NULL,
  `name_server` varchar(255) NOT NULL,
  `www` varchar(255) NOT NULL,
  `youtube_watch` varchar(255) NOT NULL,
  `discord_id` varchar(255) NOT NULL,
  `announce` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ip_server` varchar(255) NOT NULL,
  `port_server` varchar(255) NOT NULL,
  `version_server` varchar(255) NOT NULL,
  `page_facebook` varchar(255) NOT NULL,
  `detail_server` varchar(255) NOT NULL,
  `max_reg` varchar(255) NOT NULL,
  `query_port` varchar(255) NOT NULL,
  `slash` enum('slash','slash_off') NOT NULL,
  `bg` varchar(255) NOT NULL,
  `color` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `backend_password`, `name_server`, `www`, `youtube_watch`, `discord_id`, `announce`, `icon`, `ip_server`, `port_server`, `version_server`, `page_facebook`, `detail_server`, `max_reg`, `query_port`, `slash`, `bg`, `color`) VALUES
(1, 'Keam29102547', 'Mc-Storyworld', 'localhost', '', '686025106748735596', 'เซิร์ฟยังไม่เปิดน้าา~~~', 'https://imgur.com/ZItN4Wk.png', 'mc-storyworld.net', '25565', '1.16.5+', '100005002366932', '', '2', '', '', 'https://wallup.net/wp-content/uploads/2019/09/07/511448-archeage-fantasy-mmo-rpg-sandbox-adventure-online-forest-fog-mist.jpg', '#1bc219');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `pricerp` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `priceeve` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `command` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `price`, `pricerp`, `priceeve`, `category`, `command`, `pic`, `server_id`) VALUES
(1, 'Test', '0', '0', '0', 2, '', 'https://imgur.com/ZItN4Wk.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `slide` (`id`, `url`) VALUES
(1, '');
-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `availabe_seats` int(11) NOT NULL,
  `last_date_to_register` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_rating`
--

CREATE TABLE `tbl_course_rating` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `truemoney`
--

CREATE TABLE `truemoney` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truemoney`
--

INSERT INTO `truemoney` (`id`, `amount`, `points`) VALUES
(1, 50, 50),
(2, 90, 90),
(3, 150, 150),
(4, 300, 300),
(5, 500, 500),
(6, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `truewallet_token`
--

CREATE TABLE `truewallet_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truewallet_token`
--

INSERT INTO `truewallet_token` (`id`, `email`, `token`) VALUES
(, 'teasdascda', 'dacdasfsdvgsbdhfg');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_account`
--

CREATE TABLE `wallet_account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mutiple` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `money` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `player` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallet_account`
--

INSERT INTO `wallet_account` (`id`, `email`, `password`, `phone`, `name`, `mutiple`, `money`, `player`, `message`) VALUES
(1, 'pawatchijaroen2004@gmail.com', 'Keam29102547', '0994965145', 'นายภวัฐ ไชยเจริญ', '1', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_password`
--

CREATE TABLE `wallet_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reference_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet_password`
--

INSERT INTO `wallet_password` (`id`, `email`, `password`, `reference_token`) VALUES
(1, 'none', 'none', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE `whitelist` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `whitelist`
--

INSERT INTO `whitelist` (`id`, `ip`) VALUES
(1, 'none');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authme`
--
ALTER TABLE `authme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `boxrandom`
--
ALTER TABLE `boxrandom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bungeecord`
--
ALTER TABLE `bungeecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daypro`
--
ALTER TABLE `daypro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missionrcon`
--
ALTER TABLE `missionrcon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missionset`
--
ALTER TABLE `missionset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `random`
--
ALTER TABLE `random`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeemm`
--
ALTER TABLE `redeemm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeemmember`
--
ALTER TABLE `redeemmember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp`
--
ALTER TABLE `rp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_shop`
--
ALTER TABLE `rp_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course_rating`
--
ALTER TABLE `tbl_course_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truemoney`
--
ALTER TABLE `truemoney`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truewallet_token`
--
ALTER TABLE `truewallet_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_account`
--
ALTER TABLE `wallet_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_password`
--
ALTER TABLE `wallet_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whitelist`
--
ALTER TABLE `whitelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `authme`
--
ALTER TABLE `authme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `boxrandom`
--
ALTER TABLE `boxrandom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `bungeecord`
--
ALTER TABLE `bungeecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `daypro`
--
ALTER TABLE `daypro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `missionrcon`
--
ALTER TABLE `missionrcon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `missionset`
--
ALTER TABLE `missionset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `random`
--
ALTER TABLE `random`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `redeemm`
--
ALTER TABLE `redeemm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `redeemmember`
--
ALTER TABLE `redeemmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `rp`
--
ALTER TABLE `rp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `rp_shop`
--
ALTER TABLE `rp_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_course_rating`
--
ALTER TABLE `tbl_course_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `truemoney`
--
ALTER TABLE `truemoney`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `truewallet_token`
--
ALTER TABLE `truewallet_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `wallet_account`
--
ALTER TABLE `wallet_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `wallet_password`
--
ALTER TABLE `wallet_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `whitelist`
--
ALTER TABLE `whitelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
