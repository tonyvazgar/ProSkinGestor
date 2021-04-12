-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2021 at 07:05 AM
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
('AVG21032610', 'Auri', 'Vazquez Garcia', '3333333', '1', 'tiony@ee.com', '2', '1616713200', '1617831449', 1),
('AVG9602283', 'Auri', 'Vazquez Garcias', '2869374', '1', 'auri@ejemplo.com', '2', '1612134000', '1617898016', 1),
('BRL9307074', 'Brenda', 'Ramirez Lopez', '3333333', '1', 'brenda@hmail.com', '1', '1610492400', '1617898180', 1),
('CPM8004047', 'Coral', 'Perlita Mejia', '3332323222', '0', 'pers@sks.com', '2', '1610146800', '1610146800', 1),
('FFL9612252', 'Fernanda', 'Fernandez Lopez', '2020202020', '0', 'ferlofer@gmail.com', '3', '1616540400', '1618176928', 1),
('LVG9405285', 'Luis Antonio', 'Vazquez Garcia', '4444545454', '0', 'hamcon@sjs.com', '1', '1609369200', '1618177403', 1),
('MTR2009246', 'Marcela', 'Thermopólis Renaldi', '3332323333', '1', 'mtr@icloud.com', '3', '1600898400', '1618174470', 1),
('OEP9902289', 'Otro', 'Ejemplo Prueba', '3456789098', '0', 'EEee@ssss.co', '1', '1616540400', '1616540400', 1),
('PEP7907128', 'Prueba', 'Ejemplo Prueba', '3682761', '1', 'example@example.com', '3', '1604790000', '1617903262', 1),
('PPE00123112', 'Paola', 'Prueba Ejemplo', '2978904', '1', 'pao.prueba.ejemplo@example.com', '2', '1617919200', '1618167420', 1),
('PRG00010111', 'Paola', 'Roman Gomez', '2222860394', '0', 'pao.rogo@gmail.com', '2', '1617746400', '1617827934', 1),
('STR2103232', 'Sara', 'Thermopólis Renaldi', '3445678889', '0', 'sara@sdsd.com', '2', '1616454000', '1618174226', 1);

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
  `zona_cuerpo` varchar(255) COLLATE utf8_bin NOT NULL,
  `comentarios` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteBitacora`
--

INSERT INTO `ClienteBitacora` (`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `centro`, `calificacion`, `timestamp`, `zona_cuerpo`, `comentarios`) VALUES
('FFL9612252', 'CAV01', '8', '1', '5', '1618176928', '17', 'Es muy buen trabajo de abdomen'),
('FFL9612252', 'CAV01', '9', '2', '3', '1618176376', '17,3,9,6,11', 'Vamos a ver abd, antebra,pierna,pubis, zona alba'),
('LVG9405285', 'FAC23', '8', '1', '5', '1618177403', '', 'Ya no tiene puntos negros el vato'),
('MTR2009246', 'MAS32', '10', '3', '5', '1618174470', '', 'If you hear me let me know'),
('STR2103232', 'DEP01', '10', '3', '5', '1618174226', '23', 'Todo el cuerpo, segunda sesion de sonata a la paz'),
('STR2103232', 'DEP01', '8', '1', '5', '1618172632', '17,12,13,22,6', 'Son 5 tratamientos, Abd,entrece,frente,oreja,pubis.');

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
('PPE00123112', '2000-12-31', ''),
('PPP90020215', '1990-02-02', '72000'),
('PPP9607101', '1996-07-10', '12345'),
('PRG00010111', '2000-01-01', '72850'),
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
('CPM8004047', 'inactivo'),
('FFL9612252', 'activo'),
('JVG21031912', 'activo'),
('LVG9405285', 'activo'),
('MRC21031911', 'activo'),
('MTR2009246', 'activo'),
('OEP9902289', 'activo'),
('PEP7907128', 'activo'),
('PPE00123112', 'activo'),
('PPP90020215', 'activo'),
('PPP9607101', 'activo'),
('PRG00010111', 'activo'),
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
('LVG9405285', 'FAC23', '8', 'FAC23', '', '1618177403'),
('MTR2009246', 'MAS32', '10', 'MAS32', '', '1618174470');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteTratamientoEspecial`
--

CREATE TABLE `ClienteTratamientoEspecial` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `zona` varchar(255) COLLATE utf8_bin NOT NULL,
  `detalle_zona` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_sesion` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteTratamientoEspecial`
--

INSERT INTO `ClienteTratamientoEspecial` (`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `nombre_tratamiento`, `zona`, `detalle_zona`, `timestamp`, `num_sesion`) VALUES
('FFL9612252', 'CAV01', '8', 'Cavitacion', '17', '40', '1618176928', 2),
('FFL9612252', 'CAV01', '9', 'Cavitacion', '17,3,9,6,11', '1,9', '1618176376', 1),
('STR2103232', 'DEP01', '10', 'Depilacion', '23', 'Todo', '1618174226', 2),
('STR2103232', 'DEP01', '8', 'Depilacion', '17,12,13,22,6', '19,20', '1618172632', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `id_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `descripcion_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `costo_unitario_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `stock_disponible_producto` int(5) NOT NULL,
  `centro_producto` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
('CAV01', 'Cavitación', '60', 'si'),
('CCE42', 'Exfoliación corporal [Cuidado Corporal]', '70', 'si'),
('CCP43', 'Post-operatorio [Cuidado Corporal]', '60', 'si'),
('CCV44', 'Velo de novia [Cuidado Corporal]', '120', 'si'),
('DEP01', 'Depilación', '60', 'si'),
('FAC16', 'Facial Plus Oxigenante', '', 'si'),
('FAC17', 'Facial Plus Despigmentante', '', 'si'),
('FAC18', 'Facial Plus Hidratante', '', 'si'),
('FAC19', 'Facial Plus Reafirmante', '', 'si'),
('FAC20', 'Facial Premium C.Proof', '', 'si'),
('FAC21', 'Facial Premium Collagen', '', 'si'),
('FAC22', 'Facial Premium Purity', '', 'si'),
('FAC23', 'Facial Premium For men', '', 'si'),
('FAC24', 'Facial Premium Hyaluronic', '', 'si'),
('FAC25', 'Facial Premium Hydrafacial', '', 'si'),
('FAC26', 'Facial Básico', '', 'si'),
('FD01', 'Foto-depilación', '60', 'si'),
('MAS31', 'Masaje Hindú', '30', 'si'),
('MAS32', 'Masaje Descontracturante 30', '30', 'si'),
('MAS33', 'Masaje Descontracturante 50', '50', 'si'),
('MAS34', 'Masaje relajante', '50', 'si'),
('MAS35', 'Masaje piedras calientes 60', '60', 'si'),
('MAS36', 'Masaje piedras calientes 90', '90', 'si'),
('MAS37', 'Masaje Deportivo', '60', 'si'),
('MAS38', 'Masaje Drenaje linfático', '60', 'si'),
('MAS39', 'Masaje Prenatal', '50', 'si'),
('MAS40', 'Masaje Podal', '20', 'si'),
('MAS41', 'Masaje Aromavela', '', 'si'),
('MDA13', 'Microdermoabrasión cara', '', 'si'),
('MDA14', 'Microdermoabrasión espalda', '', 'si'),
('MDA15', 'Microdermoabrasión escote', '', 'si'),
('PIG06', 'Pigmentación Cara', '60', 'si'),
('PIG07', 'Pigmentación Cuello', '60', 'si'),
('PIG08', 'Pigmentación Escote', '60', 'si'),
('PIG09', 'Pigmentación Manos', '60', 'si'),
('RED27', 'Reductivo Liposis', '', 'si'),
('RED28', 'Reductivo radiofrecuencia facial plus', '60', 'si'),
('RED29', 'Reductivo radiofrecuencia corporal', '20', 'si'),
('RED30', 'Reductivo radiofrecuencia facial', '30', 'si'),
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
('CCE42', '1000'),
('CCP43', '600'),
('CCV44', '1380'),
('FAC16', '650'),
('FAC17', '650'),
('FAC18', '650'),
('FAC19', '750'),
('FAC20', '1800'),
('FAC21', '850'),
('FAC22', '850'),
('FAC23', '900'),
('FAC24', '850'),
('FAC25', '1100'),
('FAC26', '400'),
('FD01', '400'),
('MAS31', '300'),
('MAS32', '350'),
('MAS33', '630'),
('MAS34', '550'),
('MAS35', '700'),
('MAS36', '900'),
('MAS37', '750'),
('MAS38', '700'),
('MAS39', '550'),
('MAS40', '150'),
('MAS41', '700'),
('MDA13', '800'),
('MDA14', '800'),
('MDA15', '400'),
('PIG06', '700'),
('PIG07', '400'),
('PIG08', '700'),
('PIG09', '450'),
('RED27', '600'),
('RED28', '700'),
('RED29', '300'),
('RED30', '500'),
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
('FFL96122524', 'FFL9612252', 'CAV01', 1, '599', '1618176376', '2'),
('FFL96122525', 'FFL9612252', 'CAV01', 2, '3940', '1618176928', '1'),
('LVG9405285FAC236', 'LVG9405285', 'FAC23', 2, '900', '1618177403', '1'),
('MTR2009246MAS323', 'MTR2009246', 'MAS32', 2, '350', '1618174470', '3'),
('STR21032321', 'STR2103232', 'DEP01', 1, '499', '1618172632', '1'),
('STR21032322', 'STR2103232', 'DEP01', 1, '', '1618174226', '3');

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
(22, 'Orejas'),
(23, '**TODO EL CUERPO**');

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
  ADD PRIMARY KEY (`id_cliente`,`id_tratamiento`,`id_cosmetologa`,`centro`,`calificacion`,`timestamp`) USING BTREE;

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
  ADD PRIMARY KEY (`id_cliente`,`id_tratamiento`,`id_cosmetologa`,`timestamp`,`num_sesion`) USING BTREE;

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD KEY `id_producto` (`id_producto`);

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
