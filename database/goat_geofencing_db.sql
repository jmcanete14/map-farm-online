-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 01:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_34295731_goat_geofencing_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`epiz_34295731`@`sql110.epizy.com` PROCEDURE `spStoreData` (IN `__object_id` VARCHAR(45), IN `__latitude` VARCHAR(45), IN `__longitude` VARCHAR(45), IN `__pulse_rate` VARCHAR(45), IN `__battery_level` VARCHAR(45))   BEGIN
	DECLARE error_message TEXT;
	DECLARE error_code INT DEFAULT 0;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        
		GET DIAGNOSTICS CONDITION 1 error_code = MYSQL_ERRNO, error_message = MESSAGE_TEXT;
        SELECT JSON_OBJECT(
			'status', 'failed',
			'message', CONCAT('SQL script failed to execute: ', error_message)
		) AS result;
    
    END;

    START TRANSACTION;
	-- start query from here -----------------------------------------------------------------------------
    
    INSERT INTO sensordata(object_id, latitude, longitude, pulse_rate, battery_level)
    VALUES(__object_id, __latitude, __longitude, __pulse_rate, __battery_level);
    
    SELECT JSON_OBJECT(
			'status', 'success',
			'message','Data successfuly inserted.'
		) AS result;
    -- end line here; ----------------------------------------------------------------------------
    -- when successfully executed, then commit;
    COMMIT;
        
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL DEFAULT 0,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensordata`
--

CREATE TABLE `sensordata` (
  `id` int(6) UNSIGNED NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float DEFAULT NULL,
  `pulse_rate` float DEFAULT NULL,
  `battery_level` float DEFAULT NULL,
  `datetime_recorded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensordata`
--

INSERT INTO `sensordata` (`id`, `object_id`, `latitude`, `longitude`, `pulse_rate`, `battery_level`, `datetime_recorded`) VALUES
(1, 10101, 14.1967, 120.88, 12.5, 0, '2023-05-27 18:25:45'),
(2, 10102, 14.1961, 120.882, 12.5, 0, '2023-05-27 18:26:54'),
(3, 10103, 14.1995, 120.879, 16.2, 80, '2023-05-27 18:28:13'),
(4, 10104, 14.1987, 120.882, 20.7, 60, '2023-05-27 18:28:47'),
(5, 10105, 14.1988, 120.879, 22.4, 0, '2023-05-27 18:32:24'),
(6, 10105, 14.1988, 120.879, 22.4, 77, '2023-05-27 18:32:50'),
(7, 10105, 14.1988, 120.879, 22.4, 77, '2023-05-27 18:39:30'),
(8, 10105, 14.1988, 120.879, 22.4, 77, '2023-05-27 18:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Goat Geofencing Web', 'admin@emial.com', '0912345678', 'Cavite, Philippines', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = admin, 2 = staff',
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `reset_link_token` varchar(255) NOT NULL,
  `exp_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`, `status`, `reset_link_token`, `exp_date`) VALUES
(1, 'admin', 'admin', 'admin@email.com', '21232f297a57a5a743894a0e4a801fc3', 1, '', '2023-05-27 15:26:19', 0, '', ''),
(2, 'admin', 'admin', 'admin@email.com', '21232f297a57a5a743894a0e4a801fc3', 1, '', '2023-05-27 15:28:45', 0, '', ''),
(3, 'juan', 'dela cruz', 'juan@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 'no-image-available.png', '2023-05-27 17:25:13', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensordata`
--
ALTER TABLE `sensordata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensordata`
--
ALTER TABLE `sensordata`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
