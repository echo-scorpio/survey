-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2021-02-08 07:32:10
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_survey`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_admin`
--

CREATE TABLE `tb_admin` (
  `Id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `pass` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_admin`
--

INSERT INTO `tb_admin` (`Id`, `name`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `tb_answer`
--

CREATE TABLE `tb_answer` (
  `AnsId` int(11) NOT NULL,
  `SurId` int(11) NOT NULL,
  `QueId` int(11) NOT NULL,
  `Content` varchar(500) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Times` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_answer`
--

INSERT INTO `tb_answer` (`AnsId`, `SurId`, `QueId`, `Content`, `Times`) VALUES
(1, 1, 1, '父母', 1),
(2, 1, 1, '工作', 2),
(3, 1, 1, '课外兼职', 0),
(4, 1, 2, '吃饭', 1),
(5, 1, 2, '零食', 1),
(6, 1, 2, '电影', 0),
(7, 1, 2, '买衣服', 1),
(8, 1, 3, '800-1000', 1),
(9, 1, 3, '1000-1500', 1),
(10, 1, 3, '1500-2000', 1),
(11, 1, 3, '2000以上', 0),
(12, 1, 4, '够用', 1),
(13, 1, 4, 'NO', 2),
(14, 2, 5, '一、选择题一==选项一', 1),
(15, 2, 5, '二、选择题一==选项二', 1),
(16, 2, 5, '三、选择题一==选项三', 0),
(17, 2, 6, '一、选择题二==选项一', 0),
(18, 2, 6, '二、选择题二==选项二', 2),
(19, 2, 6, '三、选择题二==选项三', 0),
(20, 2, 7, '复选一==选项一', 2),
(21, 2, 7, '复选一==选项二', 1),
(22, 2, 7, '复选一==选项三', 1),
(23, 2, 7, '复选二==选项四', 1),
(24, 2, 9, '复选二==选项一', 0),
(25, 2, 9, '复选二==选项二', 1),
(26, 2, 9, '复选二==选项三', 0),
(27, 2, 9, '复选二==选项四', 0),
(28, 2, 11, '一、选择题二==选项一', 0),
(29, 2, 11, '二、选择题二==选项二', 0),
(30, 2, 11, '三、选择题二==选项三', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tb_question`
--

CREATE TABLE `tb_question` (
  `QueId` int(11) NOT NULL,
  `SurId` int(11) NOT NULL,
  `Type` varchar(100) COLLATE utf8_bin NOT NULL,
  `Title` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_question`
--

INSERT INTO `tb_question` (`QueId`, `SurId`, `Type`, `Title`) VALUES
(1, 1, 'radio', '主要经济来源'),
(2, 1, 'radio', '主要消费项目'),
(3, 1, 'radio', '每月生活费金额'),
(4, 1, 'radio', '每月生活费是否够用'),
(5, 2, 'radio', '选择题一'),
(6, 2, 'radio', '单选二'),
(7, 2, 'checkbox', '复选一'),
(8, 2, 'textarea', '简答题一'),
(9, 2, 'checkbox', '复选二'),
(10, 2, 'textarea', '简答题二'),
(11, 2, 'radio', '单选题三'),
(12, 2, 'textarea', '简答题333');

-- --------------------------------------------------------

--
-- 表的结构 `tb_survey`
--

CREATE TABLE `tb_survey` (
  `SurId` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `times` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_survey`
--

INSERT INTO `tb_survey` (`SurId`, `title`, `times`, `description`) VALUES
(1, '大学生平均消费水平调查', 4, '主要调研当前大学生每\r\n月的消费情况，具体数\r\n据只用于分析，不会对\r\n用户个人填写情况进行\r\n泄露，请大家放心填写'),
(2, 'test', 2, '这是一个test问卷');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE `tb_user` (
  `Id` int(11) NOT NULL,
  `Surid` int(11) NOT NULL,
  `Mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `Content` varchar(500) COLLATE utf8_bin NOT NULL,
  `Time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`Id`, `Surid`, `Mail`, `Content`, `Time`) VALUES
(1, 1, '111@qq.com', '', 1585118002),
(2, 1, '22@qq.com', '', 1585118387),
(3, 1, '', '', 1611924524),
(4, 1, '', '', 1611925055),
(5, 2, '', '请输入留言', 1612755587),
(6, 2, '', '请输入留言', 1612759143);

-- --------------------------------------------------------

--
-- 表的结构 `tb_userlogin`
--

CREATE TABLE `tb_userlogin` (
  `userId` varchar(100) COLLATE utf8_bin NOT NULL,
  `userPass` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_userlogin`
--

INSERT INTO `tb_userlogin` (`userId`, `userPass`) VALUES
('123', '123'),
('1234', '1111'),
('c1', 'ccc');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user_answered`
--

CREATE TABLE `tb_user_answered` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) COLLATE utf8_bin NOT NULL,
  `sid` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_user_answered`
--

INSERT INTO `tb_user_answered` (`id`, `uid`, `sid`) VALUES
(1, '1234', '1'),
(3, '1234', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_answer`
--
ALTER TABLE `tb_answer`
  ADD PRIMARY KEY (`AnsId`);

--
-- Indexes for table `tb_question`
--
ALTER TABLE `tb_question`
  ADD PRIMARY KEY (`QueId`);

--
-- Indexes for table `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD PRIMARY KEY (`SurId`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_userlogin`
--
ALTER TABLE `tb_userlogin`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tb_user_answered`
--
ALTER TABLE `tb_user_answered`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `tb_answer`
--
ALTER TABLE `tb_answer`
  MODIFY `AnsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- 使用表AUTO_INCREMENT `tb_question`
--
ALTER TABLE `tb_question`
  MODIFY `QueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `tb_survey`
--
ALTER TABLE `tb_survey`
  MODIFY `SurId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `tb_user_answered`
--
ALTER TABLE `tb_user_answered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
