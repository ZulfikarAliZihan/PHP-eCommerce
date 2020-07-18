-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 05:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'Asus'),
(3, 'Samsung'),
(4, 'LG'),
(5, 'Acer');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(10) NOT NULL,
  `user_ip_address` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `user_ip_address`, `quantity`) VALUES
(28, '::1', 0),
(16, '::1', 0),
(27, '::1', 0),
(12, '127.0.0.1', 0),
(30, '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Laptop'),
(2, 'Mobile'),
(3, 'Camera'),
(4, 'Watch'),
(5, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(16, '::1', 'Zihan', 'z@gmail.com', '1', 'Bangladesh', 'Rangpur', '01764814448', 'Bokultola, Rangpur, Bangladesh.', '0BzxFYBLmimHtd2pLYmQwNkxnZkU=w1080-h675-p-k-nu-iv1.jpg'),
(17, '::1', 'Yakin', '1', '1', 'Bangladesh', 'Barisal', '2222222', 'dkgd', '2087204.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(7, 3, 3, 'DSLR ', 5000, '<p>This is a Camera</p>\r\n', 'camera1.jpg', 'camera'),
(8, 3, 2, 'New Camera', 6000, '<p>This is a Camera</p>\r\n', 'camera2.jpg', 'camera'),
(9, 3, 5, 'camera 2', 4500, '<p>This is a Camera</p>\r\n', 'camera4.jpg', 'camera'),
(10, 3, 3, 'Old Camera', 2000, '<p>This is a Camera</p>\r\n', 'camera3.jpg', 'This is a Camera'),
(11, 2, 2, 'Pixel', 5000, '<p>This is a mobile.</p>\r\n', 'mobile1.jpg', 'mobile'),
(12, 2, 2, 'Zenphone', 8000, '<p>This is a mobile.</p>\r\n', 'mobile2.png', 'mobile'),
(13, 2, 4, 'mobile 2', 6000, '<p>This is a mobile.</p>\r\n', 'mobile3.jpg', 'mobile'),
(14, 2, 5, 'mobile 3', 4000, '<p>This is a mobile.</p>\r\n', 'mobile4.jpg', 'mobile'),
(15, 2, 5, 'Smart Phone', 4500, '<p>This is a mobile.</p>\r\n', 'mobile5.jfif', 'mobile'),
(16, 2, 1, 'i phome', 8000, '<p>This is a mobile.</p>\r\n', 'mobile6.jpg', 'mobile'),
(17, 1, 1, 'MacBook', 50000, '<p>This is a laptop</p>\r\n', 'laptop1.jpg', 'laptop'),
(19, 1, 1, 'Pro book', 80000, '<p>This is a laptop.</p>\r\n', 'laptop2.jpg', 'laptop'),
(20, 1, 2, 'Idea pad', 65000, '<p>This is a laptop.</p>\r\n', 'laptop3.jpg', 'Laptop'),
(27, 4, 4, 'Mi band 2', 200, '<p>This is a Watch.</p>\r\n', 'watch2.jpg', 'watch'),
(28, 4, 4, 'LG band', 160, '<p>This is a Watch.</p>\r\n', 'watch3.jpg', 'watch'),
(29, 4, 2, 'Asus Watch', 190, '<p>This is a Watch.</p>\r\n', 'watch5.jpg', 'watch'),
(30, 5, 4, 'LG TV', 24000, '<p>This is a TV;</p>\r\n', 'tv1.jpeg', 'tv'),
(31, 5, 3, 'S TV', 25000, '<p>This is a TV;</p>\r\n', 'tv3.webp', 'tv'),
(32, 5, 5, 'Acer TV', 16000, '<p>This is a TV;</p>\r\n', 'tv4.jpg', 'tv');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
