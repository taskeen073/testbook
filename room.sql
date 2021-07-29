-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 05:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_division`
--

CREATE TABLE `tb_division` (
  `id_division` int(2) NOT NULL,
  `name_division` varchar(50) NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_division`
--

INSERT INTO `tb_division` (`id_division`, `name_division`, `position`) VALUES
(1, 'สำนักปลัด', 1),
(2, 'กองคลัง', 2),
(3, 'กองช่าง', 3),
(4, 'กองสาธารณสุขและสิ่งแวดล้อม', 4),
(5, 'กองการศึกษา ศาสนาและวัฒนธรรม', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment`
--

CREATE TABLE `tb_equipment` (
  `id_equipment` int(2) NOT NULL,
  `name_equipment` varchar(250) NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_equipment`
--

INSERT INTO `tb_equipment` (`id_equipment`, `name_equipment`, `position`) VALUES
(1, 'โน๊ตบุ๊ค', 3),
(2, 'ไมค์ลอย', 4),
(3, 'ไมค์คอนเฟอร์เรน', 5),
(4, 'โปรเจ๊คเตอร์', 1),
(5, 'อาหารว่าง', 11),
(6, 'อาหารเที่ยง', 10),
(7, 'ถ่ายรูป', 9),
(8, 'ถ่ายวิดีโอ', 8),
(10, 'เครื่องฉาย', 2),
(11, 'รีโมทพรีเซน', 6),
(12, 'ทีวีลิ้งค์', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `id` int(11) NOT NULL,
  `id_member` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  `rooms` int(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `division` varchar(50) NOT NULL,
  `people` int(3) NOT NULL,
  `style` varchar(50) NOT NULL,
  `equipment` varchar(250) NOT NULL,
  `member` varchar(200) CHARACTER SET utf32 NOT NULL,
  `etc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ทดสอบปฏิทิน';

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`id`, `id_member`, `status`, `rooms`, `title`, `start`, `end`, `color`, `division`, `people`, `style`, `equipment`, `member`, `etc`) VALUES
(23, 1, 0, 1, 'อบรม', '2020-07-27T01:11:00', '2020-07-28T01:11:00', '#2f3fbc', '1', 10, '3', '1,8,10', 'แอดมิน ระบบ', 'กิจกรรมประชุมประจำเดือน'),
(24, 1, 1, 1, 'เวย์', '2021-01-01T21:24:00', '2021-01-28T21:24:00', '#2f3fbc', '1', 4, '2', '1,5,10,11,12', 'แอดมิน  ระบบ', ''),
(25, 1, 1, 1, 'ทดสอบ3', '2021-01-20T21:26:00', '2021-01-27T21:26:00', '#2f3fbc', '1', 3, '2', '1,2,3,4,5,6,7,8,10,11,12', 'แอดมิน  ระบบ', ''),
(26, 1, 1, 7, 'เวย์', '2021-02-05T22:15:00', '2021-02-12T22:15:00', '#ea57a1', '1', 2, '1', '2,3,6', 'แอดมิน  ระบบ', 'ห้องประชุม อาคารเอนกประสงค์\r\nห้องประชุม อาคารเอนกประสงค์'),
(27, 1, 1, 1, 'ทดสอบ', '2021-05-13T20:47:00', '2021-05-15T20:47:00', '#2f3fbc', '1', 2, '1', '2,4,12', 'แอดมิน  ระบบ', ''),
(28, 1, 0, 7, 'ทดสอบ', '2021-05-12T20:54:00', '2021-05-16T20:54:00', '#ea57a1', '1', 3, '1', '4,2', 'แอดมิน  ระบบ', ''),
(29, 1, 0, 1, 'ทดสอบ3', '2021-05-11T21:00:00', '2021-05-17T21:00:00', '#2f3fbc', '1', 3, '1', '', 'แอดมิน  ระบบ', ''),
(30, 1, 1, 1, 'ทดสอบ', '2021-05-11T21:01:00', '2021-05-13T20:46:00', '#2f3fbc', '1', 2, '1', '8,10', 'แอดมิน  ระบบ', ''),
(31, 1, 1, 7, 'ทดสอบ5', '2021-05-11T21:22:00', '2021-05-17T22:21:00', '#ea57a1', '2', 1, '1', '5,7,8', 'แอดมิน  ระบบ', ''),
(32, 1, 0, 7, 'ทดสอบ5', '2021-05-17T22:22:00', '2021-05-27T21:22:00', '#ea57a1', '1', 5, '2', '5', 'แอดมิน  ระบบ', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id_item` int(3) NOT NULL,
  `type_item` varchar(20) NOT NULL,
  `name_item` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `type_item`, `name_item`) VALUES
(12, 'equipment', 'ไมค์ลอย'),
(10, 'equipment', 'โน๊ตบุ๊ค'),
(11, 'equipment', 'โปรเจคเตอร์'),
(8, 'style', 'ชั้นเรียน'),
(9, 'style', 'อื่นๆ'),
(7, 'style', 'ตัวยู เต็มห้อง'),
(6, 'style', 'ตัวยู ครึ่งห้อง'),
(5, 'division', 'กองการศึกษา ศาสนาและวัฒนธรรม'),
(4, 'division', 'กองสาธารณสุขและสิ่งแวดล้อม'),
(3, 'division', 'กองช่าง'),
(2, 'division', 'กองคลัง'),
(1, 'division', 'สำนักปลัด'),
(13, 'equipment', 'ไมค์คอนเฟอร์เรน'),
(14, 'equipment', 'ถ่ายรูป'),
(15, 'equipment', 'ถ่ายวีดีโอ'),
(16, 'equipment', 'อาหารว่าง'),
(17, 'equipment', 'อาหารเที่ยง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ntitle` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `position` varchar(200) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `active` int(1) NOT NULL,
  `login_date` datetime NOT NULL,
  `login_times` int(6) NOT NULL,
  `create_date` datetime NOT NULL,
  `FilesName` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `username`, `password`, `ntitle`, `firstname`, `surname`, `email`, `status`, `position`, `phone`, `active`, `login_date`, `login_times`, `create_date`, `FilesName`) VALUES
(1, 'admin', '123456', 'นาย', 'แอดมิน', 'ระบบ', 'admin@mail.com', 'admin', 'ผู้ดูแลระบบ', '0999999999', 1, '2021-05-11 15:47:26', 30, '2020-07-01 00:00:00', ''),
(2, 'member', '123456', 'นาย', 'วรเวธน์', 'ศรีสุขา', '999@hotmail.com', 'user', 'นักประชาสัมพันธ์', '0999999999', 1, '2020-08-12 16:03:46', 2, '2020-07-05 00:00:00', 'woravets.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rooms`
--

CREATE TABLE `tb_rooms` (
  `id_rooms` int(3) NOT NULL,
  `name_rooms` varchar(200) NOT NULL,
  `people_rooms` int(4) NOT NULL,
  `color_rooms` varchar(20) NOT NULL,
  `image_rooms` varchar(250) NOT NULL,
  `detail_rooms` text NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_rooms`
--

INSERT INTO `tb_rooms` (`id_rooms`, `name_rooms`, `people_rooms`, `color_rooms`, `image_rooms`, `detail_rooms`, `position`) VALUES
(1, 'ประชุม 1', 200, '#2f3fbc', 'DSC_9168.JPG', 'ชั้น 2 อาคารอเนกประสงค์', 1),
(7, 'ห้องประชุม อาคารเอนกประสงค์', 500, '#ea57a1', '135585953_4915090785232005_5406565335601443217_n.jpg', 'อาคารเอนกประสงค์', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_style`
--

CREATE TABLE `tb_style` (
  `id_style` int(10) NOT NULL,
  `name_style` varchar(100) NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_style`
--

INSERT INTO `tb_style` (`id_style`, `name_style`, `position`) VALUES
(1, 'ประชุมทั่วไป', 1),
(2, 'ตัวยู เต็มห้อง', 3),
(3, 'ชั้นเรียน', 2),
(4, 'ประชุมสภา', 4),
(5, 'อื่นๆ', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_division`
--
ALTER TABLE `tb_division`
  ADD PRIMARY KEY (`id_division`);

--
-- Indexes for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  ADD PRIMARY KEY (`id_equipment`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_rooms`
--
ALTER TABLE `tb_rooms`
  ADD PRIMARY KEY (`id_rooms`);

--
-- Indexes for table `tb_style`
--
ALTER TABLE `tb_style`
  ADD PRIMARY KEY (`id_style`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_division`
--
ALTER TABLE `tb_division`
  MODIFY `id_division` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  MODIFY `id_equipment` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_rooms`
--
ALTER TABLE `tb_rooms`
  MODIFY `id_rooms` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_style`
--
ALTER TABLE `tb_style`
  MODIFY `id_style` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
