-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2016 at 05:06 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`id`, `name`) VALUES
(4, '23213'),
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pump_fuels`
--

INSERT INTO `pump_fuels` (`id`, `pump_id`, `fuel_type_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 1),
(4, 3, 1),
(5, 3, 3),
(6, 4, 3),
(7, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_inventory`
--

CREATE TABLE IF NOT EXISTS `sales_inventory` (
  `id` int(10) unsigned NOT NULL,
  `log_id` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sales_inventory`
--

INSERT INTO `sales_inventory` (`id`, `log_id`, `data`, `created_at`) VALUES
(20, 4, '{"pumps":{"1":{"value":"12,500.00"},"2":{"value":"15,000.00"},"3":{"value":"45,000.00"}},"glads":{"gasul":"30,000.00","lubes":"1,000.00","accessories":"311.00","drinks":"244.00","shop":"577.00"},"credits":{"BPI":"1,200.00","BDO":"300.00","fleet":"900.00","redeem":"500.00","creditor":"1"},"summary":{"disbursements":"12,000.00","cash_remitted":"20,000.00","cash_collections":"5,000.00"}}', '2016-08-24 06:31:25'),
(25, 5, '{"pumps":{"4":{"value":"10,000.00"},"1":{"value":"1,300.00"},"2":{"value":"2,400.00"},"3":{"value":"500.00"}},"glads":{"gasul":"60.00","lubes":"70.00","accessories":"80.00","drinks":"90.00","shop":"100.00"},"credits":{"BPI":"100.00","BDO":"200.00","fleet":"300.00","redeem":"400.00","creditor":"4"},"summary":{"disbursements":"1,000.00","cash_remitted":"200,000.00","cash_collections":"0.00"}}', '2016-08-24 07:58:03');

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
  `position` varchar(45) COLLATE utf8_bin NOT NULL,
  `am_shift_start` time NOT NULL DEFAULT '00:00:00',
  `am_shift_end` time NOT NULL DEFAULT '00:00:00',
  `pm_shift_start` time NOT NULL DEFAULT '00:00:00',
  `pm_shift_end` time NOT NULL DEFAULT '00:00:00',
  `shift` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login_type`, `login_username`, `login_password`, `firstname`, `lastname`, `contact_number`, `email_address`, `position`, `am_shift_start`, `am_shift_end`, `pm_shift_start`, `pm_shift_end`, `shift`) VALUES
(2, 'a', 'adrian', '8c4205ec33d8f6caeaaaa0c10a14138c', 'Adrian', 'Natabio', '09233887588', 'natabioadr@gmail.com', 'Manager', '00:00:00', '00:00:00', '00:00:00', '00:00:00', ''),
(3, 'a', 'cashier', '6ac2470ed8ccf204fd5ff89b32a355cf', 'John', 'Doe', '1234567890', 'cashier@cashier.com', 'Cashier', '00:00:00', '00:00:00', '00:00:00', '00:00:00', ''),
(4, 's', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '123', 'admin@admin.com', 'admin', '09:00:00', '12:00:00', '13:00:00', '17:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `datetime_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shift_type` enum('AM','PM') COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `datetime_in`, `shift_type`, `created_at`) VALUES
(2, 4, '2016-08-18 17:09:41', 'AM', '2016-08-24 06:21:13'),
(3, 4, '2016-08-18 17:10:33', 'PM', '2016-08-24 06:21:13'),
(4, 4, '2016-08-24 05:43:45', 'AM', '2016-08-24 06:21:13'),
(5, 4, '2016-08-24 06:21:21', 'PM', '2016-08-24 06:21:21');

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
-- Indexes for table `sales_inventory`
--
ALTER TABLE `sales_inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log_id_UNIQUE` (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_username_UNIQUE` (`login_username`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign_idx` (`user_id`);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pump_fuels`
--
ALTER TABLE `pump_fuels`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sales_inventory`
--
ALTER TABLE `sales_inventory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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

--
-- Constraints for table `sales_inventory`
--
ALTER TABLE `sales_inventory`
  ADD CONSTRAINT `sales_inventory_log_id_foreign` FOREIGN KEY (`log_id`) REFERENCES `user_logs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
