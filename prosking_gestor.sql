-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2021 at 07:15 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prosking_gestor`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cliente`
--

CREATE TABLE `Cliente` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `apellidos_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `telefono_cliente` varchar(10) COLLATE utf8_bin NOT NULL,
  `tipo_numero_cliente` varchar(1) COLLATE utf8_bin NOT NULL,
  `email_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `centro_cliente` varchar(1) COLLATE utf8_bin NOT NULL,
  `creacion_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `ultima_visita_cliente` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Cliente`
--

INSERT INTO `Cliente` (`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `tipo_numero_cliente`, `email_cliente`, `centro_cliente`, `creacion_cliente`, `ultima_visita_cliente`) VALUES
('ADV96110710', 'Ana Sofia', 'Del Valle Montesino', '5523567787', '', 'anasofi@gmail.com', '', '', ''),
('AMT18102713', 'Auri', 'Millones Termopolis Renaldi', '3682761', '1', 'aurioficial@auri.com', '1', '1540591200', ''),
('ASC2103189', 'Ana Pao', 'Sanchez Cordero', '2226897899', '', 'anipao@icloud.com', '', '', ''),
('ATR21032114', 'Amelia Mignonette ', 'Thermopólis Renaldi', '2222222', '1', 'ejemplo@example.com', '3', '1616281200', '2021-03-20'),
('AVG2103186', 'Andre Maria', 'Vazquez Gonzales', '4678397', '', 'maria@example.xom', '', '', ''),
('AVG2103188', 'Auri', 'Vazquez Garcia', '3682761', '', 'oficial@auri.com', '', '', ''),
('JFG9601017', 'Jose pedro maria', 'Fernandez Gonzalez', '8989098909', '', 'jpmfg@gmail.com', '', '', ''),
('JM0001014', 'Juan Paco Pedris', 'Mar Del Oceano', '3682761', '', 'tony@gmail.com', '', '', ''),
('JPM2103183', 'Juan Paco', 'Pedro De La Mar', '3682761', '', 'juanPacoPedroDeLaMar@gmail.com', '', '', ''),
('JVG21031912', 'Jose Luis', 'Vazquez Roman', '2222222332', '', 'lusi.jose@gmial.com', '', '', ''),
('LVG9611071', 'Luis Antonio', 'Vazquez Garcia', '2226772173', '', 'tony@tony.com', '', '', ''),
('MGR2103182', 'Maria Jaqueline', 'Garcia Romero', '2223742181', '', 'garj1995love@gmail.com', '', '', ''),
('MMD9604035', 'Maria Fernando', 'Martines de la Oca', '2226893400', '', 'mariaFO@icloud.com', '', '', ''),
('MRC21031911', 'Mayela', 'Roman Cifuentes', '3332323', '', 'example@example.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteOpcional`
--

CREATE TABLE `ClienteOpcional` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp_cliente` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteOpcional`
--

INSERT INTO `ClienteOpcional` (`id_cliente`, `fecha_cliente`, `cp_cliente`) VALUES
('ADV96110710', '1996-11-07', ''),
('AMT18102713', '2018-10-27', '72830'),
('ASC2103189', '1995-03-30', '75800'),
('ATR21032114', '2021-03-21', '50500'),
('AVG2103186', '2021-03-18', ''),
('AVG2103188', '2018-10-27', '72830'),
('BRO94091315', '1994-09-13', '03400'),
('BRO94091316', '1994-09-13', '03400'),
('JFG9601017', '1996-01-01', '7240'),
('JM0001014', '2000-01-01', '72840'),
('JPM2103183', '2021-03-18', ''),
('JVG21031912', '2009-07-16', '72830'),
('LVG9611071', '1996-11-07', '72830'),
('MGR2103182', '2021-03-18', ''),
('MMD9604035', '1996-04-03', '72590'),
('MRC21031911', '2021-03-19', '');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteStatus`
--

CREATE TABLE `ClienteStatus` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteStatus`
--

INSERT INTO `ClienteStatus` (`id_cliente`, `status`) VALUES
('ADV96110710', 'activo'),
('AMT18102713', 'activo'),
('ATR21032114', 'activo'),
('BRO94091315', 'activo'),
('BRO94091316', 'activo'),
('JVG21031912', 'activo'),
('MRC21031911', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteTratamiento`
--

CREATE TABLE `ClienteTratamiento` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_aplicacion` varchar(255) COLLATE utf8_bin NOT NULL,
  `consentimiento` varchar(2) COLLATE utf8_bin NOT NULL,
  `sesiones` varchar(255) COLLATE utf8_bin NOT NULL,
  `zona_cuerpo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Tratamiento`
--

CREATE TABLE `Tratamiento` (
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `duracion_tratamiento` varchar(3) COLLATE utf8_bin NOT NULL,
  `consentimiento_tratamiento` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`) VALUES
(8, 'Tony', 'tony@tony.com', '$2y$10$XfrGDv443rXAgesAhSfiTu8AAJWolQDxteAQ/ZxOG7pUP8qTPTS1C', 635339, 'notverified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `ClienteOpcional`
--
ALTER TABLE `ClienteOpcional`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `ClienteStatus`
--
ALTER TABLE `ClienteStatus`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `ClienteTratamiento`
--
ALTER TABLE `ClienteTratamiento`
  ADD PRIMARY KEY (`id_cliente`,`id_tratamiento`,`fecha_aplicacion`);

--
-- Indexes for table `Tratamiento`
--
ALTER TABLE `Tratamiento`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
