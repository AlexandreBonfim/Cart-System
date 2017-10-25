-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Dez-2016 às 15:17
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b_suppliers`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cart`
--

INSERT INTO `cart` (`id`, `id_prod`, `id_order`) VALUES
(1, 644, 13),
(2, 8665, 13),
(3, 244, 1),
(4, 8665, 2),
(5, 2311, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `delivery`
--

INSERT INTO `delivery` (`id`, `type`) VALUES
(1, 'Not  shipped'),
(2, 'Shipped');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `order`
--

INSERT INTO `order` (`id`, `user_id`, `date`, `status`, `total`) VALUES
(1, 2, '2016-12-22 21:58:11', 1, '5.20'),
(2, 2, '2016-12-29 23:52:04', 1, '260.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`Id`, `name`, `description`, `price`) VALUES
(233, 'Copper Pipe		', '25FT of copper pipe ½ inch', '45.00'),
(244, '  Cement', '25KG bag of cement.', '5.20'),
(644, 'Hammer		', 'One BlackSpur Hammer', '2.90'),
(2311, 'Sand', 'One 25KG bag of sand', '5.00'),
(8665, 'Bathroom sink', 'One complete bathroom ink.', '250.00'),
(8666, 'test', 'test', '999.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'customer'),
(2, 'admin'),
(3, 'staff'),
(4, 'delivery');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `F_name` varchar(50) NOT NULL,
  `S_name` varchar(50) NOT NULL,
  `DOB` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `User` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`Id`, `F_name`, `S_name`, `DOB`, `Email`, `User`, `Password`, `Address`, `Phone`, `Type`) VALUES
(1, 'Ale', 'Bonfim', '1990-06-06', 'alebonfinela@gmail.com', 'admin', 'bc670a0c19590231ee03d9864bdcf617', 'Adelaide Road, 16', '838533233', '2'),
(2, 'ana flavia', 'arjona', '1990-01-04', 'anaflaviarjona@hotmail.com', 'customer', '8c1cd13fbc33c92d68e7260849315515', '16 Adelaide Road - Dublin2', '08998765', '1'),
(3, 'Jonas', 'abreu', '1980-09-09', 'jonasbr@hotmail.com', 'delivery', '7c30515608fef2eb811b8e386bdc1058', 'dubllin 7', '0898765432', '4'),
(4, 'pedro', 'santos', '1990-08-09', 'psantos@hotmail.com', 'staff', 'c63c4a37da4523949de3f4c701a91279', '12 hhkll - d1', '0897645261', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8667;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
