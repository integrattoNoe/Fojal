-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2018 at 03:21 PM
-- Server version: 5.7.13-log
-- PHP Version: 7.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fojal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `idTema` int(11) NOT NULL,
  `modelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `idTema`, `modelo`) VALUES
(1, '984', 1, 2),
(2, '89498', 2, 2),
(3, '19', 3, 2),
(4, '198', 4, 2),
(5, '12', 5, 2),
(6, '9829815415', 6, 2),
(7, '16164516', 7, 2),
(8, '7416781', 8, 2),
(9, '91981', 9, 2),
(10, '961556', 10, 2),
(11, '13216516', 11, 2),
(12, '5165161', 12, 2),
(13, '9819', 13, 2),
(14, '8198', 14, 2),
(15, '1651', 15, 2),
(16, '21231', 16, 2),
(17, '81981', 17, 2),
(18, '8918519', 18, 2),
(19, '1891', 19, 2),
(20, '981981', 20, 2),
(21, '1', 1, 1),
(22, '2', 2, 1),
(23, '3', 3, 1),
(24, '4', 4, 1),
(25, '5', 5, 1),
(26, '6', 6, 1),
(27, '7', 7, 1),
(28, '8', 8, 1),
(29, '9', 9, 1),
(30, '10', 10, 1),
(31, '11', 11, 1),
(32, '12', 12, 1),
(33, '13', 13, 1),
(34, '14', 14, 1),
(35, '15', 15, 1),
(36, '16', 16, 1),
(37, '17', 17, 1),
(38, '18', 18, 1),
(39, '19', 19, 1),
(40, '20', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `datos_modelos`
--

CREATE TABLE `datos_modelos` (
  `id` int(11) NOT NULL,
  `pdf` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `fecha_inicio_curso` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `modelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datos_modelos`
--

INSERT INTO `datos_modelos` (`id`, `pdf`, `correo`, `fecha_inicio_curso`, `fecha_entrega`, `modelo`) VALUES
(1, 'invoice-515453_(1)1.pdf', 'noe@integratto.com.mx', '2018-10-01', '2018-10-31', 2),
(2, 'REQUISITOS_DE_INFORM_FINAL_RESIDENCIA_2014.pdf', 'noe@integratto.com.mx', '2019-02-01', '2019-03-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `maestros`
--

CREATE TABLE `maestros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `licenciatura` varchar(200) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `modelo` int(11) NOT NULL,
  `idMaestro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maestros`
--

INSERT INTO `maestros` (`id`, `nombre`, `licenciatura`, `imagen`, `modelo`, `idMaestro`) VALUES
(1, 'asdasdas', 'asdasdasd', '56b79a27745b1c58508cfe5e1b5e3478.png', 2, 1),
(2, 'asdasdasd', 'asdasdasd', '545af1d31fbaa63f13ef832d686e51a3.png', 2, 2),
(3, '89984', '1987198165', '36a1fe5814845a6d5de3dd1bda35f730.png', 2, 3),
(4, 'Noe', 'ISC', 'd1484b111fbc31c361bc85e94c9ebfb1.jpg', 1, 1),
(5, 'Juan', 'ISC2', '1fe34295b48305b3bb9e26bfe9c3e2fb.jpg', 1, 2),
(6, 'PEPE', 'ISC3', 'a17f17834f4bbb17c5433dcc05abac8c.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `modelos`
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `modelo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modelos`
--

INSERT INTO `modelos` (`id`, `modelo`) VALUES
(1, 'social'),
(2, 'tradicional'),
(3, 'institucional'),
(4, 'alto_impacto');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `correo`, `pass`) VALUES
(1, 'noe merrcado', 'nefas1809', 'nefas1809@gmail.com', 'welcome77');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modelo` (`modelo`),
  ADD KEY `idTema` (`idTema`);

--
-- Indexes for table `datos_modelos`
--
ALTER TABLE `datos_modelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modelo` (`modelo`);

--
-- Indexes for table `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modelo` (`modelo`),
  ADD KEY `idMaestro` (`idMaestro`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `datos_modelos`
--
ALTER TABLE `datos_modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `modelos` (`id`);

--
-- Constraints for table `datos_modelos`
--
ALTER TABLE `datos_modelos`
  ADD CONSTRAINT `datos_modelos_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `modelos` (`id`);

--
-- Constraints for table `maestros`
--
ALTER TABLE `maestros`
  ADD CONSTRAINT `maestros_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `modelos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
