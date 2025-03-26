-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 04:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enadcuyones`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `carId` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `availability` enum('available','sold','reserved') NOT NULL DEFAULT 'available',
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`carId`, `brand`, `model`, `year`, `price`, `image_url`, `availability`, `description`) VALUES
(18, 'NISSAN', 'SKYLINE R34 GTR', 2002, 1036000.00, 'uploads/skyliner34.jpg', 'sold', 'The Nissan Skyline GT-R R34, a fifth-generation Skyline GT-R, was introduced in 1999 and known for its shorter wheelbase, smaller dimensions, and the iconic RB26DETT twin-turbo engine. \r\n'),
(19, 'TOYOTA', 'SUPRA MK4', 1998, 120000.00, 'uploads/mk4supra.jpg', 'reserved', 'The Toyota Supra MK4, also known as the A80 generation, is a highly sought-after and iconic sports car known for its powerful 2JZ engine and reliability, often modified and customized. '),
(20, 'MAZDA', 'RX-7 FD3S', 1995, 85000.00, 'uploads/mazdarx7.jpg', 'available', 'The Mazda RX-7 is a front-engine, rear-wheel-drive, rotary engine-powered sports car, manufactured and marketed by Mazda from 1978 through 2002 across three generations, all of which incorporated use of a compact, lightweight Wankel rotary engine.'),
(21, 'HONDA', 'NSX NA1', 1997, 150000.00, 'uploads/hondansx.jpg', 'available', 'The first generation Honda NSX (New Sportscar eXperimental), marketed in North America and Hong Kong as the Acura NSX,[4] is a 2-seater, mid-engine sports car that was manufactured by Honda in Japan from 1990 until 2005.'),
(22, 'SUBARU', 'IMPREZA 22B STI', 1998, 250000.00, 'uploads/subaruimpreza.jpg', 'available', 'The Subaru Impreza WRX STI 22B, a limited-edition coupe released in 1998, was designed to commemorate Subaru\'s 40th anniversary and their three consecutive WRC manufacturer titles, featuring a wider body, a 2.2-liter engine, and a rally-inspired design. '),
(23, 'MITSUBISHI', 'LANCE EVOLUTION VI TME ', 1999, 90000.00, 'uploads/evo6.jpg', 'available', 'The Mitsubishi Lancer Evolution VI Tommi Mäkinen Edition (TME), also known as the Evo 6.5, is a limited-edition variant of the Evo VI, celebrated for its rally-inspired performance enhancements and distinctive features, including a redesigned front bumper'),
(43, 'NISSAN', 'SILVIA S15 SPEC-R', 1999, 25000.00, 'uploads/s15specr.jpg', 'available', 'The Nissan Silvia (Japanese: 日産・シルビア, Hepburn: Nissan Shirubia) is the series of small sports cars produced by Nissan. Versions of the Silvia have been marketed as the 200SX or 240SX for export, with some export versions being sold under the Datsun brand.'),
(44, 'Toyota', ' Chaser JZX100 Tourer V', 1996, 18000.00, 'uploads/chaserjzx.jpg', 'sold', 'The Toyota Chaser JZX100 was produced from 1996 to 2001. It is a midsize car powered by a great 1JZ engine with a single turbocharger and rear-wheel drive. Bring your brand-new Toyota to the garage, tune it to increase its performance, and choose your bes'),
(45, 'Honda', 'Integra Type R (DC2)', 1998, 22000.00, 'uploads/integratyper.jpg', 'available', 'The Honda Integra Type R (DC2), a highly regarded JDM (Japanese Domestic Market) and US-market performance car, was produced from 1995 to 2001, known for its exceptional handling and engaging driving experience. ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `birthday` date NOT NULL,
  `verification` int(11) NOT NULL DEFAULT 0,
  `profilePicture` longblob DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `role`, `birthday`, `verification`, `profilePicture`, `createdAt`) VALUES
(1, 'andrew', 'villalo', 'andrew@email.com', '123', '123', 'Male', 'admin', '2025-03-10', 0, NULL, '2025-03-03 17:10:10'),
(4, 'fiel', 'enad', 'fiel@gmail.com', '123', '0912322', 'Male', 'admin', '2025-03-04', 0, NULL, '2025-03-04 10:51:58'),
(6, 'yong', 'gwapo1', 'yong@gmail.com', '123', '09123456', 'Male', 'user', '0000-00-00', 0, NULL, '2025-03-04 23:05:27'),
(7, 'steph', 'curry', 'steph@gmail.com', '123', '091235437', 'Male', 'user', '0000-00-00', 0, NULL, '2025-03-10 15:39:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `carId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
