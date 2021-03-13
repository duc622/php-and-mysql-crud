-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2021 at 07:12 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_beginner`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created`, `modified`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 49.99, '', '2015-08-02 12:04:03', '2015-08-05 23:59:18'),
(2, 'Gatorade', 'This is a very good drink for athletes.', 1.99, '', '2015-08-02 12:14:29', '2015-08-05 23:59:18'),
(3, 'Eye Glasses', 'It will make you read better.', 6, '', '2015-08-02 12:15:04', '2015-08-05 23:59:18'),
(4, 'Trash Can', 'It will help you maintain cleanliness.', 3.95, '', '2015-08-02 12:16:08', '2015-08-05 23:59:18'),
(5, 'Mouse', 'Very useful if you love your computer.', 11.35, '', '2015-08-02 12:17:58', '2015-08-05 23:59:18'),
(16, 'fsdf', 'sdfsd', 234, '', '2021-03-10 17:01:35', '2021-03-10 17:01:35'),
(17, 'dfs', 'sdfsd', 12, '30ce1bb80a7efd516b2f96960393073a18f34213-haha.jpg', '2021-03-10 18:01:47', '2021-03-10 18:01:47'),
(18, 'sdsf', 'fgdf', 123, '8b3ec374fa533ba13d7b350b426633345d7b248a-Capture.PNG', '2021-03-10 18:02:33', '2021-03-10 18:02:33'),
(19, 'fsdf', 'dsfsdf', 2, 'a6285536e0b24bc7345fb1d346c68b07ed4652b6-thumb-1920-1064785.png', '2021-03-10 18:02:44', '2021-03-10 18:02:44'),
(20, 'dfsdf', 'dsfsdf', 32, '30ce1bb80a7efd516b2f96960393073a18f34213-haha.jpg', '2021-03-10 18:03:00', '2021-03-10 18:03:00'),
(21, 'fgdd', 'gdfgd', 234, 'a6285536e0b24bc7345fb1d346c68b07ed4652b6-thumb-1920-1064785.png', '2021-03-10 18:03:29', '2021-03-10 18:03:29'),
(23, 'dfgdf', 'fgdfg', 34, '1dfl84zm97rt3cjexgbvuqk02siwyn6oh5pa-haha.jpg', '2021-03-10 18:31:28', '2021-03-10 18:31:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
