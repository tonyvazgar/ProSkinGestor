-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2021 at 11:30 PM
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
('AB98070914', 'Arturo', 'Beristain', '2222222444', '0', 'arturo@proskin.com.mx', '1', '1618437600', '1618508205', 1),
('AVG21032610', 'Auri', 'Vazquez Garcia', '3333333', '1', 'tiony@ee.com', '2', '1616713200', '1617831449', 1),
('AVG9602283', 'Auri', 'Vazquez Garcias', '2869374', '1', 'auri@ejemplo.com', '2', '1612134000', '1617898016', 1),
('BRL9307074', 'Brenda', 'Ramirez Lopez', '3333333', '1', 'brenda@hmail.com', '1', '1610492400', '1618437798', 1),
('CPM8004047', 'Coral', 'Perlita Mejia', '3332323222', '0', 'pers@sks.com', '2', '1610146800', '1610146800', 1),
('ERG66100116', 'Emilio', 'Rosas Gil', '1234567', '1', 'Emilio.rogil@asdf.com', '3', '1618869600', '1618910827', 1),
('FFL9612252', 'Fernanda', 'Fernandez Lopez', '2020202020', '0', 'ferlofer@gmail.com', '3', '1616540400', '1618176928', 1),
('LF09041513', 'Laura', 'Flores', '1653792876', '0', 'lau.flores@gmail.com', '1', '1618437600', '1618610208', 1),
('LVG9405285', 'Luis Antonio', 'Vazquez Garcia', '4444545454', '0', 'hamcon@sjs.com', '1', '1609369200', '1618177403', 1),
('MTR2009246', 'Marcela', 'Thermopólis Renaldi', '3332323333', '1', 'mtr@icloud.com', '3', '1600898400', '1618174470', 1),
('OEP9902289', 'Otro', 'Ejemplo Prueba', '3456789098', '0', 'EEee@ssss.co', '1', '1616540400', '1618435382', 1),
('PEP7907128', 'Prueba', 'Ejemplo Prueba', '3682761', '1', 'example@example.com', '3', '1604790000', '1618343275', 1),
('PPE00123112', 'Paola', 'Prueba Ejemplo', '2978904', '1', 'pao.prueba.ejemplo@example.com', '2', '1617919200', '1618167420', 1),
('PRG00010111', 'Paola', 'Roman Gomez', '2222860394', '0', 'pao.rogo@gmail.com', '2', '1617746400', '1617827934', 1),
('RL96061115', 'Roy', 'Lazcano', '1234567890', '0', 'roy@laz.com', '3', '1618610400', '1618610400', 1),
('STR2103232', 'Sara', 'Thermopólis Renaldi', '3445678889', '0', 'sara@sdsd.com', '2', '1616454000', '1618599933', 1);

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
  `comentarios` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_venta` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteBitacora`
--

INSERT INTO `ClienteBitacora` (`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `centro`, `calificacion`, `timestamp`, `zona_cuerpo`, `comentarios`, `id_venta`) VALUES
('AB98070914', 'DEP01', '8', '1', '3', '1618508034', '18', 'Le quemé la espalda y le mandé una crema de aloe vera', 'AB98070914DEP0130'),
('AB98070914', 'DEP01', '8', '1', '5', '1618508205', '9', ' ', 'AB98070914DEP0131'),
('BRL9307074', 'PIG08', '8', '1', '5', '1618437798', '', 'f', 'BRL9307074PIG0822'),
('ERG66100116', 'CAV01', '10', '3', '4', '1618910627', '17,4,13,19,', 'Son 4 estrellas con 4 zonas y 340 con tarjeta (cavilación)', ''),
('ERG66100116', 'CAV01', '10', '3', '4', '1618910827', '19,', '', ''),
('FFL9612252', 'CAV01', '8', '1', '5', '1618176928', '17', 'Es muy buen trabajo de abdomen', ''),
('FFL9612252', 'CAV01', '9', '2', '3', '1618176376', '17,3,9,6,11', 'Vamos a ver abd, antebra,pierna,pubis, zona alba', ''),
('LF09041513', 'CAV01', '8', '1', '3', '1618497786', '17', 'Eggs-xelente ', 'LF09041513CAV0123'),
('LF09041513', 'CCP43', '9', '2', '5', '1618609081', '', 'PRueba para ver como funcionan los selectivos', 'LF09041513CCP4335'),
('LF09041513', 'FAC24', '9', '2', '5', '1618610208', '', '', 'LF09041513FAC2436'),
('LF09041513', 'MAS37', '8', '1', '5', '1618498112', '', 'Hace cromssfit', 'LF09041513MAS3724'),
('LVG9405285', 'FAC23', '8', '1', '5', '1618177403', '', 'Ya no tiene puntos negros el vato', ''),
('MTR2009246', 'MAS32', '10', '3', '5', '1618174470', '', 'If you hear me let me know', ''),
('OEP9902289', 'CAV01', '8', '1', '5', '1618435298', '4,18,19,8', '1ra sesión de cavitación en sonata', 'OEP9902289CAV0119'),
('OEP9902289', 'CAV01', '9', '2', '2', '1618435382', '10,19,7,14', '2da sesión en plaza real', 'OEP9902289CAV0120'),
('OEP9902289', 'DEP01', '10', '3', '5', '1618435103', '17,2,18,19,14,16,20,6', '3ra sesión en la plaz', 'OEP9902289DEP0117'),
('OEP9902289', 'DEP01', '8', '1', '5', '1618435202', '23', '4ta sesion y final en sonata', 'OEP9902289DEP0118'),
('OEP9902289', 'DEP01', '9', '2', '5', '1618434733', '20,22,15,1,9,6,11', 'Primera depilacion en plaza real', 'OEP990228915'),
('OEP9902289', 'DEP01', '9', '2', '5', '1618434947', '4,12,20,1', 'Segunda sesion en plaza real', 'OEP990228916'),
('OEP9902289', 'MDA13', '8', '1', '5', '1618434347', '', 'Vamos a ver si ya funciona nuevas columnas de venta (Tratamiento normal -> microdermoabrasión cara)', 'OEP9902289MDA1313'),
('OEP9902289', 'RED27', '9', '2', '5', '1618434552', '', 'Tratamiento normal reductivo liposis', 'OEP9902289RED2714'),
('PEP7907128', 'FAC25', '8', '1', '5', '1618343275', '', 'Muy bonito cutis', 'PEP7907128FAC257'),
('RL96061115', 'CAV01', '9', '2', '4', '1618873712', '3,13,20,1,', 'zsecfgtgbnjiolñ', 'RL96061115CAV0137'),
('RL96061115', 'DEP01', '9', '2', '3', '1618873712', '23,', 'qwertyuiop', 'RL96061115DEP0137'),
('RL96061115', 'DEP01', '9', '2', '5', '1618874911', '2,12,', 'hace sueño', ''),
('RL96061115', 'FAC19', '9', '2', '1', '1618874955', '', '', ''),
('RL96061115', 'FAC19', '9', '2', '3', '1618874764', '', 'ya a dormir', ''),
('RL96061115', 'FAC19', '9', '2', '3', '1618874911', '', 'ya a dormir', ''),
('RL96061115', 'FAC23', '9', '2', '4', '1618873712', '', 'asdfghjklñ', 'RL96061115FAC2337'),
('RL96061115', 'MAS31', '9', '2', '1', '1618874598', '', 'd', ''),
('STR2103232', 'CAV01', '9', '2', '5', '1618599933', '17,3,2,12', 'Perris está viendo la ventana', 'STR2103232CAV0134'),
('STR2103232', 'DEP01', '10', '3', '5', '1618174226', '23', 'Todo el cuerpo, segunda sesion de sonata a la paz', ''),
('STR2103232', 'DEP01', '8', '1', '5', '1618172632', '17,12,13,22,6', 'Son 5 tratamientos, Abd,entrece,frente,oreja,pubis.', '');

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
('AB98070914', '1998-07-09', ''),
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
('ERG66100116', '1966-10-01', '74777'),
('FFL9612252', '1996-12-25', '72300'),
('JFG9601017', '1996-01-01', '7240'),
('JM0001014', '2000-01-01', '72840'),
('JPM2103183', '2021-03-18', ''),
('JVG21031912', '2009-07-16', '72830'),
('LF09041513', '2009-04-15', '73902'),
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
('RL96061115', '1996-06-11', ''),
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
('2317', 'activo'),
('AB98070914', 'activo'),
('ADV96110710', 'activo'),
('AMT18102713', 'activo'),
('ATR21032114', 'activo'),
('AVG21032610', 'activo'),
('AVG9602283', 'activo'),
('BRL9307074', 'activo'),
('BRO94091315', 'activo'),
('BRO94091316', 'activo'),
('CPM8004047', 'inactivo'),
('ERG66100116', 'activo'),
('FFL9612252', 'activo'),
('JVG21031912', 'activo'),
('LF09041513', 'activo'),
('LPG96100913', 'activo'),
('LVG9405285', 'activo'),
('MRC21031911', 'activo'),
('MTR2009246', 'activo'),
('OEP9902289', 'activo'),
('PEP7907128', 'activo'),
('PPE00123112', 'activo'),
('PPP90020215', 'activo'),
('PPP9607101', 'activo'),
('PRG00010111', 'activo'),
('RL96061115', 'activo'),
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
('BRL9307074', 'PIG08', '8', 'PIG08', '', '1618437798'),
('LF09041513', 'CCP43', '9', 'CCP43', '', '1618609081'),
('LF09041513', 'FAC24', '9', 'FAC24', '', '1618610208'),
('LF09041513', 'MAS37', '8', 'MAS37', '', '1618498112'),
('LVG9405285', 'FAC23', '8', 'FAC23', '', '1618177403'),
('MTR2009246', 'MAS32', '10', 'MAS32', '', '1618174470'),
('OEP9902289', 'MDA13', '8', 'MDA13', '', '1618434347'),
('OEP9902289', 'RED27', '9', 'RED27', '', '1618434552'),
('PEP7907128', 'FAC25', '8', 'FAC25', '', '1618343275'),
('RL96061115', 'FAC19', '9', 'FAC19', '', '1618874764'),
('RL96061115', 'FAC19', '9', 'FAC19', '', '1618874911'),
('RL96061115', 'FAC19', '9', 'FAC19', '', '1618874955'),
('RL96061115', 'FAC23', '9', 'FAC23', '', '1618873712'),
('RL96061115', 'MAS31', '9', 'MAS31', '', '1618874598');

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
('AB98070914', 'DEP01', '8', 'Depilacion', '18', '4', '1618508034', 1),
('AB98070914', 'DEP01', '8', 'Depilacion', '9', '4', '1618508205', 2),
('ERG66100116', 'CAV01', '10', 'CAV01', '17,4,13,19,', '7', '1618910627', 1),
('ERG66100116', 'CAV01', '10', 'CAV01', '19,', '13', '1618910827', 1),
('FFL9612252', 'CAV01', '8', 'Cavitacion', '17', '40', '1618176928', 2),
('FFL9612252', 'CAV01', '9', 'Cavitacion', '17,3,9,6,11', '1,9', '1618176376', 1),
('LF09041513', 'CAV01', '8', 'Cavitacion', '17', 'Lomjas', '1618497786', 1),
('OEP9902289', 'CAV01', '8', 'Cavitacion', '4,18,19,8', '4', '1618435298', 1),
('OEP9902289', 'CAV01', '9', 'Cavitacion', '10,19,7,14', '5,9,10', '1618435382', 2),
('OEP9902289', 'DEP01', '10', 'Depilacion', '17,2,18,19,14,16,20,6', '8,9', '1618435103', 3),
('OEP9902289', 'DEP01', '8', 'Depilacion', '23', '3', '1618435202', 4),
('OEP9902289', 'DEP01', '9', 'Depilacion', '20,22,15,1,9,6,11', '1,5', '1618434733', 1),
('OEP9902289', 'DEP01', '9', 'Depilacion', '4,12,20,1', '3,7', '1618434947', 2),
('RL96061115', 'CAV01', '9', 'CAV01', '3,13,20,1,', '18', '1618873712', 1),
('RL96061115', 'DEP01', '9', 'DEP01', '23,', '4', '1618873712', 1),
('RL96061115', 'DEP01', '9', 'DEP01', '2,12,', '6', '1618874911', 1),
('STR2103232', 'CAV01', '9', 'Cavitacion', '17,3,2,12', '4', '1618599933', 1),
('STR2103232', 'DEP01', '10', 'Depilacion', '23', 'Todo', '1618174226', 2),
('STR2103232', 'DEP01', '8', 'Depilacion', '17,12,13,22,6', '19,20', '1618172632', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `id_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `marca_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `linea_producto` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `descripcion_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `presentacion_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `stock_disponible_producto` int(5) NOT NULL DEFAULT 0,
  `costo_unitario_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `centro_producto` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`id_producto`, `marca_producto`, `linea_producto`, `descripcion_producto`, `presentacion_producto`, `stock_disponible_producto`, `costo_unitario_producto`, `centro_producto`) VALUES
('***OTRO', 'AINHOA', 'OTRO', 'CRIOGEL', '1 KG', 10, '1060', '2'),
('***PACK01', 'AINHOA', 'PACKS', 'MULTIVIT KIT (SÉRUM + CREMA)', '', 10, '1494', '2'),
('***PACK02', 'AINHOA', 'PACKS', 'HYALURONIC KIT (SÉRUM FIRMEZA + CREMA ESENCIAL)', '', 10, '1526', '2'),
('***PACK03', 'AINHOA', 'PACKS', 'HYALURONIC KIT BEAUTY ADDICT (SÉRUM + CONTORNO DE OJOS)', '', 10, '1228', '2'),
('***PACK04', 'AINHOA', 'PACKS', 'COLLAGEN + KIT (SÉRUM FIRMEZA ABSOLUTA + CREMA)', '', 10, '1428', '2'),
('***PACK05', 'AINHOA', 'PACKS', 'BIOME CARE KIT (CREMA D. ANTIPOLUCIÓN + C. OJOS ANTIPOLUCIÓN', '', 10, '1226', '2'),
('0SH01', 'MIGUETT', '', 'SHAMPOO VAU CON PARTÍCULAS Y EXTRACTO DE BAMBÚ', '150 ML', 10, '325', '2'),
('2000080', 'AINHOA', 'OTRO (DESC)', 'GEL POST DEPILATORIO CON EXTRACTO DE ALGODÓN', '200 ML', 10, '527', '2'),
('20035040', 'AINHOA', 'OTRO (DESC)', 'VELA ACEITE CALIENTE RELAJANTE LAVANDA ', '80 GR', 10, '516', '2'),
('20039020', 'AINHOA', 'OTRO (DESC)', 'ACEITE CALIENTE FRUTOS DE LA PASION', '35 GR', 10, '516', '2'),
('AA800', 'MIGUETT', '', 'AMPOLLETA COLAGELL 3000 C/CÁPSULAS DE COLÁGENO', '5/5 ML', 10, '76', '2'),
('AA805', 'MIGUETT', '', 'AMPOLLETA REAFIRMANTE CON ELASTINA; HY Y PLACENTA', '5/5 ML', 10, '74', '2'),
('AA810', 'MIGUETT', '', 'AMPOLLETA NUT PLUS', '5/5 ML', 10, '74', '2'),
('AA815', 'MIGUETT', '', 'AMPOLLETA L-S-N SUERO HIDRATANTE', '5/5 ML', 10, '50', '2'),
('AA820', 'MIGUETT', '', 'AMPOLLETA HUMECTANTE ACLARADORA', '5/2 ML ', 10, '76', '2'),
('AA825', 'MIGUETT', '', 'AMPOLLETA ANTISEBORREICA ACNEID', '5/2 ML', 10, '70', '2'),
('BBIAXI', 'MIGUETT', '', 'SUERO SÚPER ACLARANTE DE AXILAS Y ENTREPIERNAS', '150 ML', 10, '546', '2'),
('BDEM', 'MIGUETT', '', 'DEMAQUILLANTE BIFÁSICO', '60 ML', 10, '224', '2'),
('CG01', 'MIGUETT', '', 'CREMA JAZMÍN HUMECTANTE', '100 GR', 10, '448', '2'),
('CG02', 'MIGUETT', '', 'CREMA DE NOPAL', '100 GR', 10, '527', '2'),
('CG03', 'MIGUETT', '', 'CREMA DE  COLAGENO \"E\" Y ELASTINA', '100 GR', 10, '594', '2'),
('CP01', 'MIGUETT', '', 'CREMA REVITOX ', '65 ML', 10, '258', '2'),
('CPE03', 'MIGUETT', '', 'CREMA DE NOPAL', '50 GR', 10, '471', '2'),
('CPE04', 'MIGUETT', '', 'CREMA DE  COLAGENO \"E\" Y ELASTINA', '50 GR', 10, '471', '2'),
('DAROB', 'MIGUETT', '', 'AROMAVELA BLANCA (ACEITE CALIENTE PARA MASAJES)', '50 GR', 10, '291', '2'),
('DAROVE', 'MIGUETT', '', 'AROVAMELA VERDE (ACEITE CALIENTE PARA MASAJES)', '50 GR', 10, '291', '2'),
('DAROVI', 'MIGUETT', '', 'AROMAVELA VIOLETA (ACEITE CALIENTE PARA MASAJES)', '50 GR', 10, '291', '2'),
('E34.29', 'GERMAINE', '', 'HIDROGEL ALOE VERA ', '200 ML', 10, '472', '2'),
('E35.1', 'GERMAINE', '', 'PROF-CABALLERO C-PLUS FOR MEN', '7 SESIONES', 10, '530', '2'),
('E39.5', 'GERMAINE', '', 'CITY PROOF- PROGRAMA OXIGENANTE ANTI POLUCIÓN', '5 SESIONES', 10, '960', '2'),
('EVMFIT', 'MIGUETT', '', 'MASCARILLA FITOESTIMULINAS CLIMATERIUM + REAFIRMANTE', '250 GR', 10, '910', '2'),
('EVMO', 'MIGUETT', '', 'MASCARILLA OXIFRESH', '100 GR', 10, '546', '2'),
('GG01', 'MIGUETT', '', 'SHAMPOO DERMOLIMPIADOR HIPOALERGÉNICO ', '250 ML', 10, '455', '2'),
('GG03', 'MIGUETT', '', 'GEL FACIAL HIDROGEL', '250 ML', 10, '522', '2'),
('GP004', 'MIGUETT', '', 'DEMAQUILLANTE AZUL', '65 ML', 10, '224', '2'),
('GP01', 'MIGUETT', '', 'SHAMPOO DERMOLIMPIADOR HIPOALERGÉNICO ', '150 ML', 10, '294', '2'),
('HACHA02', 'MIGUETT', '', 'ACEITE GOLD CHAMPÁN DELUXE', '250 ML', 10, '549', '2'),
('HAR0O2', 'MIGUETT', '', 'ACEITE DE ROSAS - ROSE OIL', '250 ML', 10, '549', '2'),
('HHSUE', 'MIGUETT', '', 'SUERO ANTIRIDES (RETINOL+ CHAMPÁN+CAVIAR) ', '150 ML', 10, '650', '2'),
('HORO', 'MIGUETT', '', 'MASCARILLA ORO PLÁSTICA ', '250 GR', 10, '910', '2'),
('HSHG01', 'MIGUETT', '', 'SHAMPOO GOLD -CHAMPÁN DELUXE CON ESFERAS VITAMINADAS ', '150 ML', 10, '312', '2'),
('HSHG02', 'MIGUETT', '', 'SHAMPOO GOLD -CHAMPÁN DELUXE CON ESFERAS VITAMINADAS ', '250 ML', 10, '455', '2'),
('IRL', 'MIGUETT', '', 'GEL REPAIR LASER CRISTAL ', '30 ML', 10, '559', '2'),
('JAMNA', 'MIGUETT', '', 'AMPOLLETA NAISHA ULTRA LIFT CÉLULAS MADRE & H.', '5/5 ML', 10, '100', '2'),
('JAMPA', 'MIGUETT', '', 'AMPOLLETA CONCENTRADO DE A. HIALURÓNICO ', '5/5 ML', 10, '120', '2'),
('JCOL', 'MIGUETT', '', 'LOCIÓN COLÁGENO  + AC. HIALURÓNICO ', '150 ML', 10, '598', '2'),
('JDEV', 'MIGUETT', '', 'MASCARILLA DEVI ULTRA LIFT C. MADRE & H. REFORMULADO ', '100 GR', 10, '520', '2'),
('JFIL', 'MIGUETT', '', 'FILTRO SOLAR ABSOLUTTA FPS 40', '150 ML', 10, '336', '2'),
('JINT', 'MIGUETT', '', 'CREMA INTESIVE HYALURONIC  + HEXAPEPTIDOS ABSOLUTTA', '50 GRS', 10, '780', '2'),
('JOISH', 'MIGUETT', '', 'LOCIÓN OISHI AMATISTA CON CÉLULAS MADRE', '130 ML', 10, '624', '2'),
('JPAR', 'MIGUETT', '', 'CREMA PARA PÁRPADOS BOOSTER TAURINA', '15 GR', 10, '358', '2'),
('JPLAS', 'MIGUETT', '', 'MASCARILLA PLÁSTICA  NEGRA CON CARBÓN ACTIVADO', '250 GR', 10, '728', '2'),
('JRO02', 'MIGUETT', '', 'LOCIÓN HUMECTANTE DE ROSAS', '500 ML', 10, '515', '2'),
('JSHAC1', 'MIGUETT', '', 'SHAMPOO ACNEID: PREBIOTICOS + C. ACTIVADO', '250 ML', 10, '496', '2'),
('JSHAC2', 'MIGUETT', '', 'SHAMPOO ACNEID: PREBIOTICOS + C. ACTIVADO', '150 ML', 10, '368', '2'),
('JUJI02', 'MIGUETT', '', 'ACEITE BOTÁNICO JITAH ', '250 ML', 10, '538', '2'),
('KA0001', 'MIGUETT', '', 'AMPOLLETA A-9-9 DESENSIBILIZANTE', '5/2 ML', 10, '70', '2'),
('KAM001', 'MIGUETT', '', 'ÁMBAR ARMONIZADOR ECO-ENERGÉTICO', '150 ML', 10, '414', '2'),
('KAM002', 'MIGUETT', '', 'ÁMBAR ARMONIZADOR ECO-ENERGÉTICO', '250 ML', 10, '594', '2'),
('KDA0001', 'MIGUETT', '', 'AMPOLLETA DAKUMI OXIGENANTE ', '5/2 ML', 10, '80', '2'),
('KKSI0001', 'MIGUETT', '', 'AMPOLLETA SILONE D-3-9 CON AHAS Y VITAMINA C', '5/2 ML', 10, '76', '2'),
('LG01', 'MIGUETT', '', 'LOCIÓN DE RAÍCES SILVESTRES', '500 ML ', 10, '461', '2'),
('MG01', 'MIGUETT', '', 'MASCARILLA DE EXTRACTO DE ALGAS VERDES', '280 GR', 10, '611', '2'),
('MG011', 'MIGUETT', '', 'MASCARILLA DE EXTRACTO DE ALGAS VERDES', '250 GR', 10, '611', '2'),
('MG12', 'MIGUETT', '', 'MASCARILLA BIOREGENERANTE ANTI-AGE', '250 GR', 10, '715', '2'),
('OAC03', 'MIGUETT', '', 'ACEITE NOGAH DE BAMBÚ', '1 LT', 10, '728', '2'),
('OSH02', 'MIGUETT', '', 'SHAMPOO VAU CON PARTÍCULAS Y EXTRACTO DE BAMBÚ', '250 ML', 10, '455', '2'),
('P1569N', 'AINHOA', 'PURITY', 'GEL LIMPIADOR ULTRA PURIFICANTE PURITY', '500 ML', 10, '1152', '2'),
('P1572N', 'AINHOA', 'WHITESS', 'TÓNICO FACIAL WHITESS', '500 ML', 10, '737', '2'),
('P1579', 'AINHOA', 'PURITY', 'CREMA SEBORREGULADORA PURITY', '200 ML', 10, '1716', '2'),
('P1811NN', 'AINHOA', 'PURITY', 'TÓNICO FACIAL PURITY', '500 ML', 10, '753', '2'),
('P1830NN', 'AINHOA', 'SENSKIN', 'LOCIÓN LIMPIADORA SENSKIN ', '500 ML ', 10, '892', '2'),
('P1831NN', 'AINHOA', 'SENSKIN', 'TÓNICO FACIAL SENSKIN ', '500 ML', 10, '832', '2'),
('P1832TN', 'AINHOA', 'SENSKIN', 'CREMA HIDRATANTE SENSKIN', '200 ML', 10, '699', '2'),
('P1833TN', 'AINHOA', 'SENSKIN', 'CREMA NUTRITIVA SENSKIN', '200 ML', 10, '751', '2'),
('P1862', 'AINHOA', 'PURITY', 'CONCENTRADO PURIFICANTE PURITY', '10 ML/2ML', 10, '56', '2'),
('P1862NN', 'AINHOA', 'PURITY', 'CONCENTRADO PURIFICANTE', '50ML', 10, '54', '2'),
('P1883TN', 'AINHOA', 'OTRO (DESC)', 'CREMA OXIGENANTE OXYGEN', '200 ML', 10, '766', '2'),
('P1897N', 'AINHOA', 'OTRO (DESC)', 'LECHE LIMPIADORA LUXE', '500 ML', 10, '813', '2'),
('P1898N', 'AINHOA', 'OTRO (DESC)', 'TÓNICO FACIAL LUXE', '500 ML', 10, '709', '2'),
('P1900TN', 'AINHOA', 'OTRO (DESC)', 'CREMA DE DÍA Y NOCHE CON EXTRACTO DE CAVIAR LUXE', '200 ML', 10, '1028', '2'),
('P1903TN', 'AINHOA', 'OTRO (DESC)', 'MÁSCARA FACIAL LUXE', '200 ML', 10, '804', '2'),
('P2005TN', 'AINHOA', 'OTRO (DESC)', 'CREMA DÍA Y NOCHE CON EXTRACTO DE CAVIAR Y ORO LUXE GOLD', '200 ML', 10, '1416', '2'),
('P2009', 'AINHOA', 'OTRO (DESC)', 'MÁSCARA FACIAL LUXE GOLD', '200 ML', 10, '909', '2'),
('P2103N', 'AINHOA', 'OTRO', 'BIOLOGICO IRIS ZINC', '8 ML', 10, '179', '2'),
('P2104NN', 'AINHOA', 'COLLAGEN+', 'BIOLÓGICO COLÁGENO', '8/2 ML', 10, '74', '2'),
('P2111NN', 'AINHOA', 'SENSKIN', 'CONCENTRADO SENSITIVE ', '8ML', 10, '50', '2'),
('P2134TN', 'AINHOA', 'SPECIFIC', 'PEELING FACIAL SPECIFIC', '200 ML', 10, '808', '2'),
('P2137N', 'AINHOA', 'BODY LINE UP GRADE', 'EXFOLIANTE CORPORAL UP GRADE', '500 ML', 10, '1828', '2'),
('P2138N', 'AINHOA', 'BODY LINE UP GRADE', 'ACEITE DE MASAJE ANTICELULÍTICO-DRENANTE', '1 KG', 10, '1725', '2'),
('P2141TN', 'AINHOA', 'PURITY', 'MÁSCARA FACIAL PURIFICANTE PURITY', '200 ML', 10, '552', '2'),
('P2145TN', 'AINHOA', 'OTRO (DESC)', 'GEL ANTICELULÍTICO ', '200 ML', 10, '1359', '2'),
('P2151', 'AINHOA', 'BODY LINE UP GRADE', 'CREMA DE MASAJE REMODELANTE', '1 KG', 10, '2894', '2'),
('P2159TN', 'AINHOA', 'SENSKIN', 'MÁSCARA FACIAL SENSKIN', '200 ML', 10, '618', '2'),
('P2162T', 'AINHOA', 'WHITESS', 'MÁSCARA FACIAL WHITESS', '200 ML', 10, '615', '2'),
('P2176TN', 'AINHOA', 'WHITESS', 'CREMA DESPINGMENTANTE WHITESS', '200 ML', 10, '927', '2'),
('P2250', 'AINHOA', 'COLLAGEN+', 'CREMA FIRMEZA Y VOLUMEN COLLAGEN +', '200 ML', 10, '1830', '2'),
('P2260', 'AINHOA', 'COLLAGEN+', 'MÁSCARA TENSO-REAFIRMANTE COLLAGEN +', '200 ML', 10, '1609', '2'),
('P2270', 'AINHOA', 'COLLAGEN+', 'CONCENTRADO FACIAL REAFIRMANTE', '50ML/2ML', 10, '73', '2'),
('P2300', 'AINHOA', 'MULTIVIT', 'CREMA RICA MULTIVITAMINAS', '200ML', 10, '1494', '2'),
('P2305', 'AINHOA', 'MULTIVIT', 'MÁSCARA MULTIVITAMINAS ', '200 ML', 10, '1261', '2'),
('P2306T', 'AINHOA', 'MULTIVIT', 'CONCENTRADO FACIAL ULTRA-VITAMINADO', '50 ML/2ML', 10, '63', '2'),
('P2402T', 'AINHOA', 'BIOME CARE', 'CONCENTRADO FACIAL ANTI-POLUCIÓN+B169 ', '50 ML', 10, '1572', '2'),
('P2404', 'AINHOA', 'BIOME CARE', 'CREMA RICA DEFENSA ANTI-POLUCIÓN', '200 ML', 10, '1506', '2'),
('P2406', 'AINHOA', 'BIOME CARE', 'MÁSCARA FACIAL ANTI-POLUCIÓN DETOX', '200 ML', 10, '1327', '2'),
('P2600', 'AINHOA', 'CANNABI7', 'EMULSSION 7 BENEFICIOS AC CANNABIS ', '200ML', 10, '1365', '2'),
('P2602', 'AINHOA', 'CANNABI9', 'ACEITE FACIAL CANNABIS', '50ML/2ML', 10, '57', '2'),
('P2604', 'AINHOA', 'CANNABI8', 'MASCARA FACIAL 7 BENEFICIOS AC CANNABIS ', '200ML', 10, '1140', '2'),
('P2701N', 'AINHOA', 'OTRO (DESC)', 'LECHE LIMPIADORA OLIVE SPECIFIC', '500 ML', 10, '611', '2'),
('P2702N', 'AINHOA', 'OTRO (DESC)', 'TÓNICO FACIAL OLIVE SPECIFIC', '500 ML', 10, '545', '2'),
('P2703N', 'AINHOA', 'OLIVE', 'CREMA DÍA Y NOCHE OLIVE', '200 ML', 10, '899', '2'),
('P2704', 'AINHOA', 'OTRO (DESC)', 'CREMA CONTORNO DE OJOS OLIVE', '200 ML', 10, '766', '2'),
('P2705N', 'AINHOA', 'OLIVE', 'MÁSCARA FACIAL OLIVE', '200 ML', 10, '709', '2'),
('P48.2', 'GERMAINE', '', 'CONTINOUS DEFENSE EMULSION EXCEL THERAPY', '50 ML', 10, '1730', '2'),
('P48.3', 'GERMAINE', '', 'CONTORNO DE OJOS ESSENCE', '15 ML', 10, '1010', '2'),
('P48.8', 'GERMAINE', '', 'FIRST ESSENCE EXCEL THERAPY', '30 ML', 10, '1465', '2'),
('P48.9', 'GERMAINE', '', '365 SOFT SCRUB', '150 ML', 10, '965', '2'),
('P8000N', 'AINHOA', 'SPECIFIC', 'ACIDO GLICÓLICO  SPECIFIC', '50 ML', 10, '1063', '2'),
('P8001', 'AINHOA', 'SPECIFIC', 'ÁCIDO HIALURONICO SPECIFIC', '50 ML /2ML', 10, '49', '2'),
('P8001N', 'AINHOA', 'HYALURONIC', 'ACIDO HYALURONICO ', '50ML/2ML', 10, '53', '2'),
('P8003T', 'AINHOA', 'HYALURONIC', 'CREMA RICA ESENCIAL HYALURONIC', '200 ML', 10, '1913', '2'),
('P8006N', 'AINHOA', 'SPECIFIC', 'PEELING ENZIMÁTICO SPECIFIC', '50 ML/2ML', 10, '35', '2'),
('P8008', 'AINHOA', 'HYALURONIC', 'MÁSCARA FACIAL ESENCIAL HYALURONIC', '200 ML', 10, '1592', '2'),
('P8014N', 'AINHOA', 'SKIN PRIMERS', 'ACIDO GLICOLICO', '50ML/2ML', 10, '44', '2'),
('PACK672020', 'AINHOA', 'PACKS', 'PACK COLLAGEN + (SERUM + CONTORNO + CREMA', '', 10, '1835', '2'),
('PACK702020', 'AINHOA', 'PACKS', 'PACK HYALURONIC (SERUM + CONTORNO + CREMA)', '', 10, '2134', '2'),
('PE01', 'MIGUETT', '', 'SOLUCIÓN (A)', '250 ML', 10, '403', '2'),
('PP02', 'MIGUETT', '', 'POLVOS MINOTRASLUCIDOS COLOR PIEL ', '25 GR', 10, '338', '2'),
('QAMPAM', 'MIGUETT', '', 'ÁMPULAS AMATISTA TECNO IMPLANT (EFECTO IMPLANTE)', '6/4 ML', 10, '100', '2'),
('QAMTU', 'MIGUETT', '', 'ÁMPULAS TURQUESA LIFTING (EFECTO IMPLANTE)', '6/4 ML', 10, '112', '2'),
('QGEL', 'MIGUETT', '', 'GEL REPARADOR  ZAFIRO (EFECTO IMPLANTE)', '30 ML', 10, '583', '2'),
('R1561N', 'AINHOA', 'OTRO (DESC)', 'BASE SECANTE PURITY', '15 ML', 10, '327', '2'),
('R1562N', 'AINHOA', 'PURITY', 'CREMA SEBORREGULADORA PURITY', '50 ML', 10, '655', '2'),
('R1569N', 'AINHOA', 'PURITY', 'GEL LIMPIADOR ULTRA PURIFICANTE PURITY', '200 ML', 10, '761', '2'),
('R1571', 'AINHOA', 'WHITESS', 'COMPLEJO BLANQUEADOR WHITESS', '8 ML', 10, '374', '2'),
('R1571NN', 'AINHOA', 'WHITESS', 'COMPLEJO BLANQUEADOR WHITESS', '50ML/2ML', 10, '55', '2'),
('R1572N', 'AINHOA', 'WHITESS', 'TÓNICO FACIAL WHITESS', '200 ML', 10, '684', '2'),
('R1576N', 'AINHOA', 'WHITESS', 'CREMA DESPINGMENTANTE WHITESS', '50 ML', 10, '668', '2'),
('R1802', 'AINHOA', 'OTRO (DESC)', 'CREMA HIDRATANTE CON JALEA REAL', '50 ML', 10, '771', '2'),
('R1811N', 'AINHOA', 'PURITY', 'TÓNICO FACIAL PURITY', '200 ML', 10, '637', '2'),
('R1830N', 'AINHOA', 'SENSKIN', 'LOCIÓN LIMPIADORA SENSKIN ', '200 ML', 10, '732', '2'),
('R1831N', 'AINHOA', 'SENSKIN', 'TÓNICO FACIAL SENSKIN ', '200 ML', 10, '683', '2'),
('R1832N', 'AINHOA', 'SENSKIN', 'CREMA HIDRATANTE SENSKIN', '50 ML', 10, '735', '2'),
('R1862N', 'AINHOA', 'OTRO (DESC)', 'FLUIDO PURIFICANTE PURITY', '30 ML', 10, '697', '2'),
('R1880N', 'AINHOA', 'OTRO (DESC)', 'CREMA OXIGENANTE OXYGEN', '50 ML', 10, '652', '2'),
('R1881TN', 'AINHOA', 'OTRO (DESC)', 'MÁSCARA FACIAL OXIGENANTE OXYGEN', '200 ML', 10, '794', '2'),
('R1884N', 'AINHOA', 'OXYGEN', 'CONCENTRADO OXIGENANTE OXYGEN', '10 ML/2ML', 10, '65', '2'),
('R1899N', 'AINHOA', 'OTRO (DESC)', 'CREMA HIDRO-NUTRITIVA CON EXTRACTO DE CAVIAR LUXE', '50 ML', 10, '1000', '2'),
('R1901', 'AINHOA', 'OTRO (DESC)', 'SÉRUM FACIAL CON EXTRACTO DE CAVIAR', '30 ML', 10, '784', '2'),
('R1902N', 'AINHOA', 'OTRO (DESC)', 'CONTORNO DE OJOS CON EXTRACTO DE CAVIAR LUXE', '15 ML', 10, '593', '2'),
('R1910TN', 'AINHOA', 'SPECIFIC', 'GEL LIMPIADOR ENERGIZANTE', '200 ML', 10, '570', '2'),
('R1912', 'AINHOA', 'OTRO (DESC)', 'CREMA HIDRA-VITAL', '50 ML', 10, '476', '2'),
('R1916', 'AINHOA', 'OTRO (DESC)', 'CREMA HIDRATANTE SPF 50', '50 ML', 10, '1044', '2'),
('R2005N', 'AINHOA', 'OTRO (DESC)', 'CREMA DÍA Y NOCHE LUXE GOLD CON EXTRACTO DE CAVIAR Y ORO', '50 ML', 10, '965', '2'),
('R2006N', 'AINHOA', 'OTRO (DESC)', 'SÉRUM FACIAL CON EXTRACTO DE CAVIAR Y ORO LUXE GOLD', '30 ML', 10, '992', '2'),
('R2007N', 'AINHOA', 'OTRO (DESC)', 'CONTORNO DE OJOS CON EXTRACTO DE CAVIAR Y ORO LUXE GOLD', '15 ML', 10, '757', '2'),
('R2014A', 'AINHOA', 'OTRO (DESC)', 'CC FACIAL CREAM PORCELAIN', '50 ML', 10, '715', '2'),
('R2014B', 'AINHOA', 'OTRO (DESC)', 'CC FACIAL CREAM NUDE', '50 ML', 10, '715', '2'),
('R2250', 'AINHOA', 'COLLAGEN+', 'CREMA FIRMEZA Y VOLUMEN COLLAGEN +', '50 ML', 10, '1466', '2'),
('R2251', 'AINHOA', 'COLLAGEN+', 'CREMA CUELLO Y ESCOTE COLLAGEN +', '50 ML', 10, '1434', '2'),
('R2252', 'AINHOA', 'COLLAGEN+', 'CONTORNO DE OJOS LIFT- REAFIRMANTE COLLAGEN +', '15 ML', 10, '1109', '2'),
('R2253', 'AINHOA', 'COLLAGEN+', 'SÉRUM FIRMEZA ABSOLUTA', '50 ML', 10, '1368', '2'),
('R2300', 'AINHOA', 'MULTIVIT', 'CREMA RICA MULTIVITAMINAS', '50 ML', 10, '1231', '2'),
('R2301', 'AINHOA', 'MULTIVIT', 'CONTORNO DE OJOS LUMINOSO', '15 ML', 10, '916', '2'),
('R2302', 'AINHOA', 'MULTIVIT', 'CREMA MULTIVITAMINAS', '50 ML', 10, '1231', '2'),
('R2306TP', 'AINHOA', 'MULTIVIT', 'CONCENTRADO LUMINOSO VITAMINADO ', '50 ML', 10, '1551', '2'),
('R2316N', 'AINHOA', 'OTRO (DESC)', 'MEN 24 HRS VITALITY', '50 ML', 10, '702', '2'),
('R2400', 'AINHOA', 'BIOME CARE', 'CREMA LIGERA DEFENSA ANTI-POLUCIÓN', '50 ML', 10, '1380', '2'),
('R2401', 'AINHOA', 'BIOME CARE', 'GEL MICELAR', '200 ML', 10, '782', '2'),
('R2403', 'AINHOA', 'BIOME CARE', 'CONTORNO DE OJOS ANTI-POLUCIÓN', '15 ML', 10, '941', '2'),
('R2404', 'AINHOA', 'BIOME CARE', 'CREMA RICA DEFENSA ANTI-POLUCIÓN', '50 ML', 10, '1380', '2'),
('R2501', 'AINHOA', 'OTRO (DESC)', 'LIFTING CONTORNO DE OJOS LUXE DIAMOND ', '15 ML', 10, '1194', '2'),
('R2600', 'AINHOA', 'CANNABI10', 'EMULSSION 7 BENEFICIOS AC CANNABIS ', '50ML', 10, '1099', '2'),
('R2701N', 'AINHOA', 'OTRO (DESC)', 'LECHE LIMPIADORA OLIVE SPECIFIC', '200 ML', 10, '598', '2'),
('R2702N', 'AINHOA', 'OTRO (DESC)', 'TÓNICO FACIAL OLIVE SPECIFIC', '200 ML', 10, '569', '2'),
('R2703N', 'AINHOA', 'OLIVE', 'CREMA DÍA Y NOCHE OLIVE', '50 ML', 10, '564', '2'),
('R2704N', 'AINHOA', 'OLIVE', 'CONTORNO DE OJOS OLIVE', '15 ML', 10, '396', '2'),
('R8002N', 'AINHOA', 'HYALURONIC', 'CREMA ESENCIAL HYALURONIC ', '50 ML', 10, '1444', '2'),
('R8003N', 'AINHOA', 'HYALURONIC', 'CREMA RICA ESENCIAL HYALURONIC', '50 ML', 10, '1444', '2'),
('R8004N', 'AINHOA', 'HYALURONIC', 'CONTORNO DE OJOS HYALURONIC ', '15 ML', 10, '1181', '2'),
('R8007N', 'AINHOA', 'HYALURONIC', 'SÉRUM ESENCIAL ', '50 ML', 10, '1403', '2'),
('R8010N', 'AINHOA', 'SKIN PRIMERS', 'LECHE LIMPIADORA', '350 ML', 10, '896', '2'),
('R8011N', 'AINHOA', 'SKIN PRIMERS', 'TÓNICO FACIAL', '350 ML', 10, '621', '2'),
('R8012N', 'AINHOA', 'SKIN PRIMERS', 'DESMAQUILLANTE DE OJOS Y LABIOS', '200 ML', 10, '757', '2'),
('R8013N', 'AINHOA', 'SKIN PRIMERS', 'FLUIDO ANTIEDAD SPF 50 BLOQUEADOR SOLAR', '50 ML', 10, '1022', '2'),
('RAMP', 'MIGUETT', '', 'AMPOLLETA M-D DESENSIBILIZANTE', '6/4 ML', 10, '50', '2'),
('RMH', 'MIGUETT', '', 'MASCARILLA DIAMOND HERKIMER ECONOPACK- NO CONTIENE FLUIDO', '200 GR', 10, '865', '2'),
('RMO', 'MIGUETT', '', 'MASCARILLA ORO PLÁSTICA - ENVASE  ECONOPACK', '200 GR', 10, '910', '2'),
('RMP', 'MIGUETT', '', 'MASCARILLA PLATINUM PEARL - ECONOPACK- NO CONTIENE FLUIDO', '200 GR', 10, '1.430', '2'),
('RPAN50', 'MIGUETT', '', 'PROTECTOR SOLAR FPS 50', '50 ML', 10, '520', '2'),
('S/N', 'MIGUETT', '', 'GEL HIPOTÉRMICO DEEP OCEAN', '500 ML', 10, '579', '2'),
('SP604', 'AINHOA', 'SPA LUXURY', 'CREMA DE MASAJE DE CAVIAR SPA LUXURY', '1 KG', 10, '791', '2'),
('SP606', 'AINHOA', 'SPA LUXURY', 'CREMA DE MASAJE DE ROSAS SPA LUXURY', '1 KG', 10, '1728', '2'),
('SPAG025', 'MIGUETT', '', 'GEL HIPOTÉRMICO DEEP OCEAN ', '250 ML', 10, '388', '2'),
('VVAS01', 'MIGUETT', '', 'SHAMPOO ACALLI CON ESFERAS DE JOJOBA', '150 ML', 10, '364', '2'),
('WGOLDSH', 'MIGUETT', '', 'CREMA GOLD SHIZEN (LUXURY 24K)', '30 ML', 10, '672', '2'),
('XCREM01', 'MIGUETT', '', 'CREMA ACTIVE CONTOUR REDUCTIVA CON ALCACHOFA 90-60-90', '250 ML ', 10, '515', '2'),
('YACE', 'MIGUETT', '', 'ACEITE AMALESH DESINCRUSTANTE HERBAL CUARZO ROSA', '15 ML', 10, '197', '2'),
('YAN', 'MIGUETT', '', 'AMPOLLETA NAISHA ULTRA LIFT CÉLULAS MADRE & H.', '6/4 ML', 10, '100', '2'),
('YSH01', 'MIGUETT', '', 'SHAMPOO NARA ÁMBAR (GEMOLOGY DELUXE)', '150 ML', 10, '299', '2'),
('YSH02', 'MIGUETT', '', 'SHAMPOO NARA ÁMBAR (GEMOLOGY DELUXE)', '250 ML', 10, '442', '2'),
('ZORO25', 'MIGUETT', '', 'MASCARILLA MOUSSE DE ORO ', '270 GR', 10, '677', '2');

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
  `centro` varchar(2) COLLATE utf8_bin NOT NULL,
  `costo_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_productos` varchar(255) COLLATE utf8_bin NOT NULL,
  `costo_producto` varchar(10) COLLATE utf8_bin NOT NULL,
  `cantidad_producto` varchar(5) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Ventas`
--

INSERT INTO `Ventas` (`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) VALUES
('ERG66100116CAV014', 'ERG66100116', 'CAV01', 2, '340', '1618910627', '3', '340', '', '', '', '10'),
('ERG66100116CAV015', 'ERG66100116', 'CAV01', 3, '9999', '1618910827', '3', '9999', '', '', '', '10'),
('RL96061115FAC191', 'RL96061115', 'DEP01', 1, '10800', '1618874911', '2', '10800', '', '', '', '9'),
('RL96061115FAC191', 'RL96061115', 'FAC19', 1, '750', '1618874911', '2', '750', '', '', '', '9'),
('RL96061115FAC193', 'RL96061115', 'FAC19', 1, '750', '1618874955', '2', '750', '', '', '', '9');

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
  ADD PRIMARY KEY (`id_producto`);

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
  ADD PRIMARY KEY (`id_cliente`,`id_tratamiento`,`monto`,`timestamp`);

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
