-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 05:35 AM
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
(45, 'Honda', 'Integra Type R (DC2)', 1998, 22000.00, 'uploads/integratyper.jpg', 'available', 'The Honda Integra Type R (DC2), a highly regarded JDM (Japanese Domestic Market) and US-market performance car, was produced from 1995 to 2001, known for its exceptional handling and engaging driving experience. '),
(84, 'PORSCHE', '911 GT3 RS', 2018, 9000000.00, 'uploads/gt3rs.jpg', 'available', 'pors gt3rs'),
(85, 'BMW', 'M4 COMPETITION', 2024, 89000.00, 'uploads/bmwm4.jpg', 'available', 'The BMW 4 Series Coupé M Automobiles offer a fascinating combination of aesthetics, character and typical M athleticism. Leading the trio is the BMW M4 Competition Coupé with an impressive 510 hp and 650 Nm of torque. Equipped with a high-performance BMW M TwinPower Turbo power unit, 8-speed M Steptronic with Drivelogic, Active M Differential and numerous technologies derived from motorsport, it guarantees maximum driving dynamics at all times.'),
(87, 'NISSAN', 'GT-R', 2019, 110000.00, 'uploads/2019GTR.jpg', 'available', 'The 2019 Nissan GT-R is a high-performance, four-seat coupe known for its powerful 3.8-liter twin-turbo V6 engine, a six-speed dual-clutch automatic transmission, and all-wheel drive, offering a blend of track-focused performance and everyday practicality. '),
(88, 'TOYOTA', 'CAMRY', 2022, 28000.00, 'uploads/2019camry.png', 'available', 'The Toyota Camry is a well-rounded midsize sedan known for its reliability, fuel efficiency, and comfortable interior. With advanced safety features, a spacious cabin, and an optional V6 engine, the Camry is a great choice for both families and commuters.'),
(89, 'FORD', 'MUSTANG GT', 2023, 45000.00, 'uploads/2023MUSTANG.jpg', 'available', 'The 2023 Ford Mustang GT is a modern muscle car with classic styling and high performance. Equipped with a roaring V8 engine, sharp handling, and an aggressive design, it offers an exhilarating driving experience. Its tech features include a digital instrument cluster, SYNC 4 infotainment, and advanced driver-assistance systems.'),
(90, 'FORD', 'RANGER RAPTOR', 2024, 40752.00, 'uploads/raptor.jpeg', 'available', 'The Ford Raptor is a high-performance, off-road-focused pickup truck and SUV, designed as a street-legal counterpart to off-road racing trophy trucks, known for its powerful engines, robust suspension, and all-terrain capabilities. '),
(91, 'AUDI', 'R8', 2022, 160000.00, 'uploads/audir8.jpeg', 'available', 'The Audi R8 is a supercar that combines breathtaking performance with everyday usability. Powered by a roaring 5.2L V10 engine, the R8 delivers exhilarating acceleration and a spine-tingling exhaust note. Its Quattro all-wheel-drive system (optional) ensures superior grip, making it a beast on both the road and track.');

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
(1, 'roy', 'cuyones', 'andrew@email.com', '123', '123', 'Male', 'admin', '2025-03-10', 0, NULL, '2025-03-03 17:10:10'),
(4, 'fiel', 'enad', 'fiel@gmail.com', '123', '0912322123', 'Male', 'admin', '2025-03-04', 0, NULL, '2025-03-04 10:51:58'),
(6, 'yonggg', 'gwapo1', 'yong@gmail.com', '123', 'asdas', 'Male', 'user', '2025-03-01', 0, NULL, '2025-03-04 23:05:27');

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
  MODIFY `carId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
