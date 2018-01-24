-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-24 16:23:46
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `username` char(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` char(100) NOT NULL,
  `author` char(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateline` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `author`, `description`, `content`, `dateline`) VALUES
(15, '第一篇文章', 'admin1', 'admin1', '每一天看着感悟人生，叹息时间的文章，自己也写着，‘’时光流逝，岁月如梭，青春一去不复返‘’，但是重来没有切身体会到这字里行间的意思。这情感式的美文，美文式的生活，生活式的感悟，视乎已经麻痹了我的眼睛，麻醉了我的神经，麻木了我的大脑。凡事只有经历了，体会了，感悟到了，才会大彻大悟。', 1512107125),
(16, '第二篇文章', 'admin2', 'admin2', '前些日子参加了爷爷的葬礼，看着大家忙里忙外的我不知所措，我一个人站在那里打开了思绪。那往事一幕幕，还曾记得爷爷去我家好像是昨天发生的事，但是从今天起他不会在去了，他倒下了，长眠了，是苦，是乐，是喜，是忧他已经不在乎了。时光把他偷走了，再也不会还回来了。岁月真的很无情，任凭你撕心裂肺，悲痛欲绝，它也头都不回的走了。我发现眼泪是最无力的东西，再多也换不回时间，再多也换不回一去不复返的岁月。', 1512474851),
(18, '第三篇文章', 'admin3', 'admin3', '我的手触摸着我的胸膛，感受着心脏的旋律，每一次坚强的跳动，都是在警告我要珍惜生命，不要让无情的岁月把它带走。', 1513433600),
(19, '第四篇文章', 'admin4', 'admin4', '生命是脆弱的，因为他可能在你稍不留神就逃跑了;生命是珍贵的，是金钱换不来的;生命只有这一次，好好把握，人生不售来回票，一旦动身，绝不能复返。\r\n所以要笑着面对生活，不管一切如何，请珍惜时间，珍爱生活，珍重生命。', 1513433694);

-- --------------------------------------------------------

--
-- 表的结构 `fav`
--

CREATE TABLE `fav` (
  `id` int(5) NOT NULL,
  `name` char(50) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `fav`
--

INSERT INTO `fav` (`id`, `name`, `href`) VALUES
(1, 'Github', 'www.github.com  '),
(2, 'Google', 'www.google.com');

-- --------------------------------------------------------

--
-- 表的结构 `img`
--

CREATE TABLE `img` (
  `id` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateline` int(20) NOT NULL,
  `path` char(255) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `img`
--

INSERT INTO `img` (`id`, `description`, `dateline`, `path`, `img_name`) VALUES
(2, '这里是一点描述', 2147483647, 'img/name.png', 'name'),
(7, '圣诞快乐！', 1513462596, 'img/BingWallpaper-2017-12-12.jpg', 'BingWallpaper-2017-12-12.jpg'),
(6, '纪念诚哥！', 1513462375, 'img/Kodokushi.jpg', 'Kodokushi.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `msgbd`
--

CREATE TABLE `msgbd` (
  `id` int(5) NOT NULL,
  `ipname` char(15) NOT NULL,
  `content` varchar(255) NOT NULL,
  `dateline` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `msgbd`
--

INSERT INTO `msgbd` (`id`, `ipname`, `content`, `dateline`) VALUES
(2, '192.168.1.102', '留名！', NULL),
(5, '192.168.1.102', '这是另一个留言', 1513457875),
(6, '::1', '这是另一个的另一个留言', 1513458256);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgbd`
--
ALTER TABLE `msgbd`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `fav`
--
ALTER TABLE `fav`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `img`
--
ALTER TABLE `img`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `msgbd`
--
ALTER TABLE `msgbd`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
