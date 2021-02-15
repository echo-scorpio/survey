-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2021-02-15 12:05:57
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
(1, 1, 1, '父母', 2),
(2, 1, 1, '工作', 2),
(3, 1, 1, '课外兼职', 0),
(4, 1, 2, '吃饭', 1),
(5, 1, 2, '零食', 2),
(6, 1, 2, '电影', 0),
(7, 1, 2, '买衣服', 1),
(8, 1, 3, '800-1000', 1),
(9, 1, 3, '1000-1500', 1),
(10, 1, 3, '1500-2000', 2),
(11, 1, 3, '2000以上', 0),
(12, 1, 4, '够用', 2),
(13, 1, 4, 'NO', 2),
(14, 2, 5, '一、选择题一==选项一', 2),
(15, 2, 5, '二、选择题一==选项二', 3),
(16, 2, 5, '三、选择题一==选项三', 2),
(17, 2, 6, '一、选择题二==选项一', 0),
(18, 2, 6, '二、选择题二==选项二', 6),
(19, 2, 6, '三、选择题二==选项三', 1),
(20, 2, 7, '复选一==选项一', 2),
(21, 2, 7, '复选一==选项二', 3),
(22, 2, 7, '复选一==选项三', 4),
(23, 2, 7, '复选二==选项四', 3),
(24, 2, 9, '复选二==选项一', 1),
(25, 2, 9, '复选二==选项二', 3),
(26, 2, 9, '复选二==选项三', 3),
(27, 2, 9, '复选二==选项四', 2),
(28, 2, 11, '一、选择题二==选项一', 3),
(29, 2, 11, '二、选择题二==选项二', 2),
(30, 2, 11, '三、选择题二==选项三', 1),
(31, 3, 14, '选项一', 4),
(32, 3, 14, '选项二', 5),
(33, 3, 14, '选项三', 2),
(34, 3, 15, '选项一', 2),
(35, 3, 15, '选项二', 5),
(36, 3, 15, '选项三', 4),
(37, 3, 16, '选项一', 1),
(38, 3, 16, '选项二', 6),
(39, 3, 16, '选项三', 3),
(40, 3, 17, '选项一', 0),
(41, 3, 17, '选项二', 3),
(42, 3, 17, '选项三', 2),
(43, 3, 19, '选项一', 0),
(44, 3, 19, '选项二', 1),
(45, 3, 19, '选项三', 1),
(46, 3, 20, '选项一', 0),
(47, 3, 20, '选项二', 1),
(48, 3, 20, '选项三', 1);

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
(12, 2, 'textarea', '简答题333'),
(14, 3, 'radio', '选择1'),
(15, 3, 'radio', '选择二'),
(16, 3, 'radio', '选择三'),
(17, 3, 'radio', '选项四'),
(18, 3, 'textarea', '文本1'),
(19, 3, 'radio', '选择五'),
(20, 3, 'radio', '选择6');

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
(1, '大学生平均消费水平调查', 5, '主要调研当前大学生每\r\n月的消费情况，具体数\r\n据只用于分析，不会对\r\n用户个人填写情况进行\r\n泄露，请大家放心填写'),
(2, 'test', 20, '这是一个test问卷'),
(3, '单选test', 11, 'testtesttesttest');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE `tb_user` (
  `Id` int(11) NOT NULL,
  `Surid` int(11) NOT NULL,
  `queId` varchar(100) COLLATE utf8_bin NOT NULL,
  `Mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `Content` varchar(500) COLLATE utf8_bin NOT NULL,
  `Time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`Id`, `Surid`, `queId`, `Mail`, `Content`, `Time`) VALUES
(33, 2, '8', 'ccc@qq.commmm', '留言留言留言', 1613380933),
(34, 2, '10', 'ccc@qq.commmm', '留言', 1613380933),
(35, 2, '12', 'ccc@qq.commmm', '留言留言留言222', 1613380933),
(36, 2, '8', 'ccc@163.com', '简单回答一下！', 1613390501),
(37, 2, '10', 'ccc@163.com', '哈哈哈哈哈', 1613390501),
(38, 2, '12', 'ccc@163.com', '阿巴阿巴阿巴', 1613390501);

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
('1', '1'),
('10', '10'),
('11', '11'),
('12', '12'),
('123', '123'),
('1234', '1111'),
('13', '13'),
('13556', '13556'),
('1356', '1356'),
('13756', '13756'),
('14', '14'),
('15', '15'),
('16', '16'),
('17', '17'),
('18', '18'),
('1895', '1895'),
('19', '19'),
('2', '2'),
('20', '20'),
('21', '21'),
('22', '22'),
('23', '23'),
('24', '24'),
('25', '25'),
('3', '3'),
('4', '4'),
('5', '5'),
('6', '6'),
('7', '7'),
('8', '8'),
('9', '9'),
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
(3, '1234', '2'),
(12, '1234', '3'),
(13, '1895', '1'),
(15, '1895', '3'),
(29, '1895', '2');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user_info`
--

CREATE TABLE `tb_user_info` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `sex` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `tb_user_info`
--

INSERT INTO `tb_user_info` (`id`, `uid`, `name`, `sex`) VALUES
(1, '1234', '李明', '男'),
(2, '123', '王五-123', '女'),
(3, 'c1', '马六-c1', ''),
(11, '2', '2', ''),
(10, '1895', '最后一次测试', '男'),
(7, '1356', '丛丛丛', ''),
(8, '13556', '嘻嘻嘻', ''),
(9, '13756', '哈哈哈', ''),
(12, '3', '3', ''),
(13, '4', '4', ''),
(14, '5', '5', ''),
(15, '6', '6', ''),
(16, '7', '7', ''),
(17, '8', '8', ''),
(18, '9', '9', ''),
(19, '10', '10', ''),
(20, '11', '11', ''),
(21, '12', '12', ''),
(22, '13', '13', ''),
(23, '14', '14', ''),
(24, '15', '15', ''),
(25, '16', '16', ''),
(26, '17', '17', ''),
(27, '18', '18', ''),
(28, '19', '19', ''),
(29, '20', '20', ''),
(30, '21', '21', ''),
(31, '22', '22', ''),
(32, '23', '23', ''),
(33, '24', '24', ''),
(34, '25', '25', ''),
(35, '1', '111', '');

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
-- Indexes for table `tb_user_info`
--
ALTER TABLE `tb_user_info`
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
  MODIFY `AnsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- 使用表AUTO_INCREMENT `tb_question`
--
ALTER TABLE `tb_question`
  MODIFY `QueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `tb_survey`
--
ALTER TABLE `tb_survey`
  MODIFY `SurId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `tb_user_answered`
--
ALTER TABLE `tb_user_answered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- 使用表AUTO_INCREMENT `tb_user_info`
--
ALTER TABLE `tb_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
