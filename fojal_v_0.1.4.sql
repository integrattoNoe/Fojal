-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2018 at 08:19 PM
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
(40, '20', 20, 1),
(41, '89', 1, 3),
(42, '984', 2, 3),
(43, '894894', 3, 3),
(44, '894984', 4, 3),
(45, '894', 5, 3),
(46, '984', 6, 3),
(47, '984', 7, 3),
(48, '984', 8, 3),
(49, '984', 9, 3),
(50, '498', 10, 3),
(51, '498', 11, 3),
(52, '984', 12, 3),
(53, '948', 13, 3),
(54, '489', 14, 3),
(55, '489', 15, 3),
(56, '489', 16, 3),
(57, '498', 17, 3),
(58, '489', 18, 3),
(59, '489', 19, 3),
(60, '489', 20, 3),
(61, 'a1', 1, 4),
(62, 'a2', 2, 4),
(63, 'a3', 3, 4),
(64, 'a4', 4, 4),
(65, 'a5', 5, 4),
(66, 'a6', 6, 4),
(67, 'a7', 7, 4),
(68, 'a8', 8, 4),
(69, 'a9', 9, 4),
(70, 'a10', 10, 4),
(71, 'a11', 11, 4),
(72, 'a12', 12, 4),
(73, 'a13', 13, 4),
(74, 'a14', 14, 4),
(75, 'a15', 15, 4),
(76, 'a16', 16, 4),
(77, 'a17', 17, 4),
(78, 'a18', 18, 4),
(79, 'a19', 19, 4),
(80, 'a20', 20, 4);

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
(2, 'REQUISITOS_DE_INFORM_FINAL_RESIDENCIA_2014.pdf', 'noe@integratto.com.mx', '2019-02-01', '2019-03-01', 1),
(3, 'RE0105Q2018-2-458-FA3_escan1.pdf', 'noe@integratto.com.mx', '2020-02-01', '2020-03-04', 3),
(4, 'invoice-515453_(6).pdf', 'aldom@integratto.com.mx', '2018-10-01', '2018-10-26', 4);

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(700) NOT NULL,
  `fechaEvento` date NOT NULL,
  `fechaPublicado` date NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `fechaEvento`, `fechaPublicado`, `autor`) VALUES
(1, 'dasdasd', '2018-10-18', '2018-10-24', 1),
(2, 'sadasd', '2018-10-11', '2018-10-24', 1),
(3, 'Nuevo evento 12', '2018-10-31', '2018-10-24', 1),
(5, 'Nuevo evento 55', '2018-11-01', '2018-10-24', 1);

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
(6, 'PEPE', 'ISC3', 'a17f17834f4bbb17c5433dcc05abac8c.jpg', 1, 3),
(7, 'JUAN', 'Mercado', '0e5bb30601e7366c9697bb54b308238b.png', 3, 1),
(8, 'JUAN', 'Mercado', '98ae33c815f1ba6a550dc4f3755f3ba4.png', 3, 2),
(9, 'JUAN', 'Mercado', '596d3c96c8794e267b030b08b17f3524.png', 3, 3),
(10, 'asdasd', 'asdasdasd', 'e8d12ff2cb930b78adb44234e77af9a1.png', 4, 1),
(11, 'asdasdasd', 'asdasdasdas', '2fea3d18afbd45dcda383bd61c6fdb94.png', 4, 2),
(12, 'asdasdasd', 'asdasdasdasd', 'd03c6c5912b1aee5aa53b689fa605335.png', 4, 3);

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
-- Table structure for table `platicas`
--

CREATE TABLE `platicas` (
  `id` int(11) NOT NULL,
  `ayuda` varchar(700) NOT NULL,
  `informacion` varchar(200) NOT NULL,
  `asistencia` varchar(200) NOT NULL,
  `horario` varchar(100) NOT NULL,
  `foto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `platicas`
--

INSERT INTO `platicas` (`id`, `ayuda`, `informacion`, `asistencia`, `horario`, `foto`) VALUES
(1, 'Prueba de ayuda', 'Prueba de info general', 'Prueba de asistencia', 'Prueba de platicas', 'a9da3454d06c7afdabc6cac986867fb0.jpeg');

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
(1, 'noe merrcado', 'nefas1809', 'nefas1809@gmail.com', 'welcome77'),
(2, 'aldo', 'aldo', 'aldom@integratto.com.mx', 'integrattoi+c');

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
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`);

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
-- Indexes for table `platicas`
--
ALTER TABLE `platicas`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `datos_modelos`
--
ALTER TABLE `datos_modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `platicas`
--
ALTER TABLE `platicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `maestros`
--
ALTER TABLE `maestros`
  ADD CONSTRAINT `maestros_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `modelos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
