-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-03-2021 a las 22:14:59
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prosking_gestor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE `Cliente` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `apellidos_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `telefono_cliente` varchar(10) COLLATE utf8_bin NOT NULL,
  `email_cliente` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `Cliente`
--

INSERT INTO `Cliente` (`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `email_cliente`) VALUES
('AAC18', 'Angelica', 'ASMR Col', '9989898989', 'lavg007@gmail.com'),
('AAC2021031715', 'Angelica', 'ASMR Col', '2223682761', 'lavg007@gmail.com'),
('AAC2021031716', 'Angelica', 'ASMR Col', '0', 'lavg007@gmail.com'),
('AAC21301720', 'Angelica', 'ASMR Col', '9989898989', 'lavg007@gmail.com'),
('AAC213119', 'Angelica', 'ASMR Col', '9989898989', 'lavg007@gmail.com'),
('AAC94071417', 'Angelica', 'ASMR Col', '2224876398', 'produccion@cippsa.mx'),
('AVG18102723', 'Auri', 'V G', '1111111111', 'ejemplo@auri.com'),
('AVG21031722', 'Auri', 'V G', '1234567890', 'auri@auri.com'),
('AVG21301721', 'Auri', 'V G', '1234567890', 'auri@auri.com'),
('JVR66110914', 'jose luis', 'vazquez roman', '8989898989', 'produccion@cippsa.mx'),
('LG2021-03-1710', 'LUIS ANTONIO', 'GARCIA', '2222211122', 'lavg007@gmail.com'),
('LG2021-03-1711', 'LUIS ANTONIO', 'GARCIA', '2222211122', 'lavg007@gmail.com'),
('LG2021-03-178', 'LUIS ANTONIO', 'GARCIA', '2234556665', 'lavg007@gmail.com'),
('LG2021-03-179', 'LUIS ANTONIO', 'GARCIA', '2234556665', 'lavg007@gmail.com'),
('LVG2', 'Luis Antonio', 'Vazquez Garcia', '2225667362', 'tony@tony.com'),
('LVG2103177', 'LUIS ANTONIO', 'VAZQUEZ GARCIA', '2222322121', 'lavg007@gmail.com'),
('LVG3', 'Luis Antonio', 'Vazquez Garcia', '2225667362', 'tony@tony.com'),
('LVG4', 'Luis Antonio', 'Vazquez Garcia', '2225667362', 'tony@tony.com'),
('LVG5', 'Luis Antonio', 'Vazquez Garcia', '2225667362', 'tony@tony.com'),
('LVG6', 'LUIS ANTONIO', 'VAZQUEZ GARCIA', '2222322121', 'lavg007@gmail.com'),
('LVG9611071', 'Luis Antonio', 'Vazquez Garcia', '2226772173', 'tony@tony.com'),
('TVR2021031713', 'Tony', 'vazquez roman', '9999999999', 'produccion@cippsa.mx'),
('Tvr2021031712', 'Tony', 'vazquez roman', '2223344555', 'produccion@cippsa.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ClienteOpcional`
--

CREATE TABLE `ClienteOpcional` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp_cliente` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ClienteOpcional`
--

INSERT INTO `ClienteOpcional` (`id_cliente`, `fecha_cliente`, `cp_cliente`) VALUES
('AAC18', '', ''),
('AAC2021031715', '', ''),
('AAC2021031716', '', ''),
('AAC21301720', '202103031717', ''),
('AAC213119', '20210317', ''),
('AAC94071417', '1994-07-14', ''),
('AVG18102723', '2018-10-27', '72830'),
('AVG21031722', '2021-03-17', ''),
('AVG21301721', '202103031717', ''),
('JVR66110914', '1966-11-09', '78205'),
('LG2021-03-1711', '2021-03-17', '72590'),
('LVG2103177', '2021-03-17', ''),
('LVG9611071', '1996-11-07', '72830'),
('TVR2021031713', '2021-03-17', ''),
('Tvr2021031712', '2021-03-17', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertable`
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
-- Volcado de datos para la tabla `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`) VALUES
(8, 'Tony', 'tony@tony.com', '$2y$10$XfrGDv443rXAgesAhSfiTu8AAJWolQDxteAQ/ZxOG7pUP8qTPTS1C', 635339, 'notverified');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `ClienteOpcional`
--
ALTER TABLE `ClienteOpcional`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
