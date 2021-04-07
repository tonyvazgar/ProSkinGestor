-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2021 at 07:54 AM
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
  `ultima_visita_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `aviso_privacidad_cliente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Cliente`
--

INSERT INTO `Cliente` (`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `tipo_numero_cliente`, `email_cliente`, `centro_cliente`, `creacion_cliente`, `ultima_visita_cliente`, `aviso_privacidad_cliente`) VALUES
('AVG21032610', 'Auri', 'Vazquez Garcia', '3333333', '1', 'tiony@ee.com', '2', '1616713200', '1616713200', 1),
('AVG9602283', 'Auri', 'Vazquez Garcias', '2869374', '1', 'auri@ejemplo.com', '2', '1612134000', '1612134000', 1),
('BRL9307074', 'Brenda', 'Ramirez Lopez', '3333333', '1', 'brenda@hmail.com', '1', '1610492400', '1610492400', 1),
('CPM8004047', 'Coral', 'Perlita Mejia', '3332323222', '0', 'pers@sks.com', '2', '1610146800', '1610146800', 1),
('FFL9612252', 'Fernanda', 'Fernandez Lopez', '2020202020', '0', 'ferlofer@gmail.com', '3', '1616540400', '1616540400', 1),
('LVG9405285', 'Luis Antonio', 'Vazquez Garcia', '4444545454', '0', 'hamcon@sjs.com', '1', '1609369200', '1609369200', 1),
('MTR2009246', 'Marcela', 'Thermopólis Renaldi', '3332323333', '1', 'mtr@icloud.com', '3', '1600898400', '1616540400', 1),
('OEP9902289', 'Otro', 'Ejemplo Prueba', '3456789098', '0', 'EEee@ssss.co', '1', '1616540400', '1616540400', 1),
('PEP7907128', 'Prueba', 'Ejemplo Prueba', '3682761', '1', 'example@example.com', '3', '1604790000', '1604790000', 1),
('STR2103232', 'Sara', 'Thermopólis Renaldi', '3445678889', '0', 'sara@sdsd.com', '2', '1616454000', '1616454000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ClienteBitacora`
--

CREATE TABLE `ClienteBitacora` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(255) COLLATE utf8_bin NOT NULL,
  `centro` varchar(1) COLLATE utf8_bin NOT NULL,
  `calificacion` varchar(1) COLLATE utf8_bin NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_bin NOT NULL,
  `zona_cuerpo` varchar(2) COLLATE utf8_bin NOT NULL,
  `comentarios` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteBitacora`
--

INSERT INTO `ClienteBitacora` (`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `centro`, `calificacion`, `timestamp`, `zona_cuerpo`, `comentarios`) VALUES
('AVG21032610', 'DEP01', '10', '3', '5', '1617774457', '17', 'Este es un comentario muy perron'),
('AVG21032610', 'DEP01', '8', '1', '5', '1617774586', '7', 'Ackubikibi'),
('AVG21032610', 'DEP01', '9', '2', '5', '1617774764', '6', 'Doblar y colgar'),
('BRL9307074', 'PIG09', '2', '3', '5', '1617660000', '6', 'Le fue muy bien y se quejó un poco, pero si es pasable.'),
('LVG9405285', 'PIG09', '2', '1', '5', '1617660000', '5', 'Este tratamiento le fue muy bien al cliente, se necesita otra sesión.'),
('LVG9405285', 'dssdds332', '10', '3', '5', '1617755867', '3', 'Hola es prueba para ver si funcionan las pruebas perruinas');

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
('AVG21032610', '2021-03-26', '03400'),
('AVG9602283', '1996-02-28', '03400'),
('BRL9307074', '1993-07-07', ''),
('BRO94091315', '1994-09-13', '03400'),
('BRO94091316', '1994-09-13', '03400'),
('CPM8004047', '1980-04-04', '34566'),
('FFL9612252', '1996-12-25', '72300'),
('JFG9601017', '1996-01-01', '7240'),
('JM0001014', '2000-01-01', '72840'),
('JPM2103183', '2021-03-18', ''),
('JVG21031912', '2009-07-16', '72830'),
('LVG9405285', '1994-05-28', '72590'),
('LVG9611071', '1996-11-07', '72830'),
('MGR2103182', '2021-03-18', ''),
('MMD9604035', '1996-04-03', '72590'),
('MRC21031911', '2021-03-19', ''),
('MTR2009246', '2020-09-24', '72830'),
('OEP9902289', '1999-02-28', ''),
('PEP7907128', '1979-07-12', '72000'),
('PPP90020215', '1990-02-02', '72000'),
('PPP9607101', '1996-07-10', '12345'),
('STR2103232', '2021-03-23', '');

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
('AVG21032610', 'activo'),
('AVG9602283', 'activo'),
('BRL9307074', 'activo'),
('BRO94091315', 'activo'),
('BRO94091316', 'activo'),
('CPM8004047', 'activo'),
('FFL9612252', 'activo'),
('JVG21031912', 'activo'),
('LVG9405285', 'inactivo'),
('MRC21031911', 'activo'),
('MTR2009246', 'activo'),
('OEP9902289', 'activo'),
('PEP7907128', 'inactivo'),
('PPP90020215', 'activo'),
('PPP9607101', 'activo'),
('STR2103232', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteTratamiento`
--

CREATE TABLE `ClienteTratamiento` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `zona_cuerpo` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_aplicacion` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteTratamiento`
--

INSERT INTO `ClienteTratamiento` (`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `nombre_tratamiento`, `zona_cuerpo`, `fecha_aplicacion`) VALUES
('AVG21032610', 'ACN10', '10', 'ACN10', '13', '1617772199'),
('AVG21032610', 'ACN12', '10', 'ACN12', '18', '1617660000'),
('BRL9307074', 'PIG09', '2', 'PIG09', '6', '1617660000'),
('LVG9405285', 'PIG09', '2', 'PIG09', '5', '1617660000'),
('MTR2009246', 'DEP02', '', '', '-Antebrazo', '1616713200'),
('STR2103232', 'DEP02', '', '', 'Brazos', '1616626800'),
('STR2103232', 'DEP04', '', '', 'Cara', '1616626800');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteTratamientoEspecial`
--

CREATE TABLE `ClienteTratamientoEspecial` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `zona` varchar(2) COLLATE utf8_bin NOT NULL,
  `detalle_zona` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_sesion` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteTratamientoEspecial`
--

INSERT INTO `ClienteTratamientoEspecial` (`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `nombre_tratamiento`, `zona`, `detalle_zona`, `timestamp`, `num_sesion`) VALUES
('AVG21032610', 'DEP01', '10', 'Depilacion', '17', 'Es muy dificil por el tipo de bello', '1617774457', 1),
('AVG21032610', 'DEP01', '8', 'Depilacion', '7', 'Otro comentario de detalle de zona', '1617774586', 2),
('AVG21032610', 'DEP01', '9', 'Depilacion', '6', 'Ultimo', '1617774764', 3),
('LVG9405285', 'dssdds332', '10', 'Depilacion', '3', 'Auri no tiene agua', '1617755867', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Sucursal`
--

CREATE TABLE `Sucursal` (
  `id_sucursal` int(2) NOT NULL,
  `nombre_sucursal` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Sucursal`
--

INSERT INTO `Sucursal` (`id_sucursal`, `nombre_sucursal`) VALUES
(1, 'Sonata'),
(2, 'Plaza Real'),
(3, 'La Paz');

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

--
-- Dumping data for table `Tratamiento`
--

INSERT INTO `Tratamiento` (`id_tratamiento`, `nombre_tratamiento`, `duracion_tratamiento`, `consentimiento_tratamiento`) VALUES
('ACN10', 'Anti-Acné Cara', '60', 'si'),
('ACN11', 'Anti-Acné Escote', '60', 'si'),
('ACN12', 'Anti-Acné Espalda', '60', 'si'),
('FD01', 'Foto-depilación', '60', 'si'),
('PIG06', 'Pigmentación Cara', '60', 'si'),
('PIG07', 'Pigmentación Cuello', '60', 'no'),
('PIG08', 'Pigmentación Escote', '60', 'si'),
('PIG09', 'Pigmentación Manos', '60', 'si'),
('RJV02', 'Rejuvenecimiento Cara', '60', 'si'),
('RJV03', 'Rejuvenecimiento Cuello', '60', 'si'),
('RJV04', 'Rejuvenecimiento Escote ', '60', 'si'),
('RJV05', 'Rejuvenecimiento Cara Plus', '60', 'si');

-- --------------------------------------------------------

--
-- Table structure for table `TratamientoPrecio`
--

CREATE TABLE `TratamientoPrecio` (
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `precio` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `TratamientoPrecio`
--

INSERT INTO `TratamientoPrecio` (`id_tratamiento`, `precio`) VALUES
('ACN10', '700'),
('ACN11', '400'),
('ACN12', '700'),
('FD01', '400'),
('PIG06', '700'),
('PIG07', '400'),
('PIG08', '700'),
('PIG09', '450'),
('RJV02', '700'),
('RJV03', '400'),
('RJV04', '700'),
('RJV05', '1050');

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
  `status` text COLLATE utf8_bin NOT NULL,
  `id_sucursal_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`, `id_sucursal_usuario`) VALUES
(8, 'Cecilia', 'sonata@proskin.com', '$2y$10$XfrGDv443rXAgesAhSfiTu8AAJWolQDxteAQ/ZxOG7pUP8qTPTS1C', 635339, 'notverified', 1),
(9, 'Mónica', 'plazaReal@proskin.com', '$2y$10$a1qB3Q3RV9kANUZcrFwP/uxs.h0YperX1UXbdHNNhIFu8McU/4DWS', 190930, 'notverified', 2),
(10, 'Sara', 'lapaz@proskin.com', '$2y$10$GhNrzmxhyk2JuTOAKlACdeq5IaEsrOgt/o8Mz.FoirQe5fPn8XVU2', 285728, 'notverified', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Ventas`
--

CREATE TABLE `Ventas` (
  `id_venta` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `metodo_pago` int(5) NOT NULL,
  `monto` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_bin NOT NULL,
  `centro` varchar(2) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Ventas`
--

INSERT INTO `Ventas` (`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`) VALUES
('AVG210326105', 'AVG21032610', '', 2, '589.99', '1617774764', '2'),
('AVG21032610ACN104', 'AVG21032610', 'ACN10', 1, '50', '1617772199', '3'),
('AVG21032610ACN123', 'AVG21032610', 'ACN12', 3, '100', '1617660000', '3'),
('BRL9307074PIG092', 'BRL9307074', 'PIG09', 3, '599.50', '1617660000', '3'),
('LVG9405285PIG091', 'LVG9405285', 'PIG09', 1, '360', '1617660000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ZonasCuerpo`
--

CREATE TABLE `ZonasCuerpo` (
  `id_zona` int(3) NOT NULL,
  `nombre_zona` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ZonasCuerpo`
--

INSERT INTO `ZonasCuerpo` (`id_zona`, `nombre_zona`) VALUES
(1, 'Pecho'),
(2, 'Axilas'),
(3, 'Antebrazos'),
(4, 'Brazos'),
(5, 'Manos'),
(6, 'Pubis'),
(7, 'Ingles'),
(8, 'Muslo'),
(9, 'Pierna'),
(10, 'Glúteos'),
(11, 'Zona Alba'),
(12, 'Entrecejo'),
(13, 'Frente'),
(14, 'Labio Superior'),
(15, 'Patillas'),
(16, 'Mentón'),
(17, 'Abdomen'),
(18, 'Espalda'),
(19, 'Hombro'),
(20, 'Nuca'),
(21, 'Lumbares'),
(22, 'Orejas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `ClienteBitacora`
--
ALTER TABLE `ClienteBitacora`
  ADD PRIMARY KEY (`id_cliente`,`id_tratamiento`,`id_cosmetologa`,`centro`,`calificacion`,`timestamp`,`zona_cuerpo`);

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
-- Indexes for table `ClienteTratamientoEspecial`
--
ALTER TABLE `ClienteTratamientoEspecial`
  ADD PRIMARY KEY (`id_cliente`,`id_tratamiento`,`id_cosmetologa`,`zona`,`timestamp`,`num_sesion`);

--
-- Indexes for table `Sucursal`
--
ALTER TABLE `Sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indexes for table `Tratamiento`
--
ALTER TABLE `Tratamiento`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- Indexes for table `TratamientoPrecio`
--
ALTER TABLE `TratamientoPrecio`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Ventas`
--
ALTER TABLE `Ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- Indexes for table `ZonasCuerpo`
--
ALTER TABLE `ZonasCuerpo`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
