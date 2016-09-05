-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2016 at 01:53 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_petron_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `creditors`
--

CREATE TABLE IF NOT EXISTS `creditors` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `creditor_type_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `creditors`
--

INSERT INTO `creditors` (`id`, `name`, `creditor_type_id`) VALUES
(1, 'Hehe', 2),
(2, 'asdsad', 1),
(3, 'sadsad', 4),
(4, '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `creditor_types`
--

CREATE TABLE IF NOT EXISTS `creditor_types` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `creditor_types`
--

INSERT INTO `creditor_types` (`id`, `name`) VALUES
(2, 'Taxi'),
(1, 'Texi'),
(4, 'l2l1'),
(3, 'lol1');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE IF NOT EXISTS `fuel_types` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `name`, `price`) VALUES
(1, 'Diesel', 12.99),
(2, 'Disel', 12311),
(3, 'Fuel', 24.5);

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE IF NOT EXISTS `pumps` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`id`, `name`) VALUES
(1, 'Pump 1'),
(2, 'Pump 2'),
(3, 'Pump1');

-- --------------------------------------------------------

--
-- Table structure for table `pump_fuels`
--

CREATE TABLE IF NOT EXISTS `pump_fuels` (
  `id` int(10) unsigned NOT NULL,
  `pump_id` int(10) unsigned NOT NULL,
  `fuel_type_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pump_fuels`
--

INSERT INTO `pump_fuels` (`id`, `pump_id`, `fuel_type_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 1),
(4, 3, 1),
(5, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `login_type` enum('s','a') COLLATE utf8_bin NOT NULL DEFAULT 's',
  `login_username` varchar(45) COLLATE utf8_bin NOT NULL,
  `login_password` varchar(45) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(45) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(45) COLLATE utf8_bin NOT NULL,
  `contact_number` varchar(45) COLLATE utf8_bin NOT NULL,
  `email_address` varchar(45) COLLATE utf8_bin NOT NULL,
  `position` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login_type`, `login_username`, `login_password`, `firstname`, `lastname`, `contact_number`, `email_address`, `position`) VALUES
(2, 'a', 'adriannatabio', '8c4205ec33d8f6caeaaaa0c10a14138c', 'Adrian', 'Natabio', '09233887588', 'natabioadr@gmail.com', 'Manager'),
(3, 'a', 'cashier', '6ac2470ed8ccf204fd5ff89b32a355cf', 'John', 'Doe', '1234567890', 'cashier@cashier.com', 'Cashier'),
(4, 's', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '123', 'admin@admin.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creditors`
--
ALTER TABLE `creditors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `creditors_creditor_type_id_foreign_idx` (`creditor_type_id`);

--
-- Indexes for table `creditor_types`
--
ALTER TABLE `creditor_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `pumps`
--
ALTER TABLE `pumps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `pump_fuels`
--
ALTER TABLE `pump_fuels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pump_fuels_pump_id_foreign_idx` (`pump_id`),
  ADD KEY `pump_fuels_fuel_type_id_foreign_idx` (`fuel_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_username_UNIQUE` (`login_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditors`
--
ALTER TABLE `creditors`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `creditor_types`
--
ALTER TABLE `creditor_types`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pump_fuels`
--
ALTER TABLE `pump_fuels`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditors`
--
ALTER TABLE `creditors`
  ADD CONSTRAINT `creditors_creditor_type_id_foreign` FOREIGN KEY (`creditor_type_id`) REFERENCES `creditor_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pump_fuels`
--
ALTER TABLE `pump_fuels`
  ADD CONSTRAINT `pump_fuels_fuel_type_id_foreign` FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pump_fuels_pump_id_foreign` FOREIGN KEY (`pump_id`) REFERENCES `pumps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
