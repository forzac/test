-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2016 at 07:44 PM
-- Server version: 5.6.29
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homepage` varchar(255) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `ip` varchar(30) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guestbook`
--

INSERT INTO `guestbook` (`id`, `username`, `email`, `homepage`, `filePath`, `text`, `ip`, `browser`, `created_at`, `updated_at`) VALUES
(72, 'forzacggg', 'fzc@ukr.net', 'http://www.vk.com', 'uploads/Photo.jpg', '<strong>GGG</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', '2016-10-03 18:38:17', '2016-10-03 18:38:17'),
(73, 'forzacd', 'fzc@ukr.net', 'http://www.vk.com', 'uploads/TAX.jpg', '<strong>asdasd</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', '2016-10-03 18:45:22', '2016-10-03 18:45:22'),
(74, 'deniser', 'forzaq@ukr.net', 'http://www.vk.com', 'uploads/TAX.jpg', '<strong>GOOD JOB</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', '2016-10-03 18:56:14', '2016-10-03 18:56:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
