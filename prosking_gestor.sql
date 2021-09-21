-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2021 at 07:13 AM
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
('AAH5212055', 'Asela Gloria', 'Alducin Hernadez', '2221823483', '0', 'sandra_alducin@hotmail.com', '3', '1624665600', '1624665600', 1),
('AF2111183', 'Araceli', 'Flores', '9981368046', '0', 'ara.flores@hotmail.com', '3', '1624579200', '1624579200', 1),
('AF84111819', 'ARACELI ', 'FLORES', '9981368046', '0', 'araflores@hotmail.com', '3', '1625097600', '1625230024', 1),
('AGT81111821', 'AMARA', 'GRACIA TERUEL', '2224558681', '0', 'tony@tony.com', '2', '1625090400', '1626818400', 1),
('AJF00111231', 'ARMANDO', 'JUAREZ FFERMIN', '2998037', '1', 'corre@cor.com', '2', '1626843600', '1628140868', 1),
('AVF96010123', 'ARANZA URSULA', 'VAZQUEZ FERMIN', '3682761', '0', 'sdasdas@assds.com', '3', '1625349600', '1625863939', 1),
('AVG18102229', 'AURELIA', 'VAZQUEZ GARCIA', '2449075', '0', 'auri@vg.com', '2', '1626325200', '1629582959', 1),
('BGZ21071215', 'Brismar', 'Garcia Zuñiga', '2227590828', '0', 'brisszu@gmail.com', '3', '1624838400', '1624838400', 1),
('CZ21071930', 'CARLOS', 'ZAYAS', '2860394', '0', '', '2', '1626670800', '1626670800', 1),
('DRR97121411', 'Daleth Carolina ', 'Rojas Rojas ', '2229062788', '0', 'd_Caro9714@hotmail.com', '3', '1624838400', '1624882843', 1),
('ECJ89030612', 'Elia Gabriela ', 'Cruz Jiménez ', '2227397352', '0', 'elycruz_89@hotmail.com', '3', '1624838400', '1624838400', 1),
('EES00111026', 'EJEMPLO DE PRUEBA', 'EXAMPLE SSD', '3682761', '1', 'casa@ccs.com', '3', '1625893200', '1625893200', 1),
('EG98012114', 'Elma', 'Gonzalez', '2222622913', '0', 'elma2198@hotmail.com', '3', '1624838400', '1624838400', 1),
('IC2102247', 'Isabella', ' Corte De La Torre ', '2224451317', '0', 'isabella.corte@hotmail.com', '3', '1624665600', '1624665600', 1),
('IG2104084', 'Indira', 'Gallardo', '2225050577', '0', 'i17g24@hotmail.com', '3', '1624579200', '1624579200', 1),
('JKS21071127', 'JACQUELINE', 'KURI', '2222523683', '0', '', '3', '1625954400', '1630533600', 1),
('JR2110031', 'Jocelyn', 'Rosas', '2441106388', '0', 'jocelynrosas3@gmail.com', '3', '1623369600', '1624884399', 1),
('KPG86080716', 'KAREN', 'Perea García ', '2223225496', '0', 'karpergar@hotmail.com', '3', '1625011200', '1625073503', 1),
('LG7704198', 'Lorena ', 'Garza ', '2224936304', '0', 'yubarta77@hotmail.com', '3', '1624838400', '1624882798', 1),
('LH2103212', 'Leslie', 'Hernández ', '2225049912', '0', 'leslie.herban20@gmail.com', '3', '1624579200', '1624579200', 1),
('LT04111517', 'Larizza ', 'Tellez  Estrada ', '2226707001', '0', 'vrs_e@hotmail.com', '3', '1625097600', '1625149417', 1),
('LVG21071025', 'LUIS ANTONIO', 'VAZQUEZ GARCIA', '4444335354', '0', '', '3', '1625893200', '1625893200', 1),
('LVG24', 'LUIS ANTONIO', 'VAZQUEZ GARCIA', '2244556623', '0', 'sasad@sasda.com', '3', '1625868000', '1625868000', 1),
('LVG96110722', 'LUIS ANTONIO', 'VAZQUEZ GARCIA', '2226772173', '0', 'tony@proslin.com', '1', '1625263200', '1630366367', 1),
('MED98022320', 'Marisol ', 'Espinoza Delgado', '2441180558', '0', 'espinoza.delgado.marisol@gmail.com', '3', '1625097600', '1625160951', 1),
('PVR21071629', 'JOSE LUIS', 'VAZQUEZ ROMANO', '2337584', '0', '', '1', '1626386400', '1630703715', 1),
('SFE91012510', 'Susana', 'Flores Espinoza ', '5540464196', '0', 'susana2501@outlook.com', '3', '1624838400', '1624838400', 1),
('SFL1102129', 'Sofía ', 'Flores López ', '2223736338', '0', 'pauyes@hotmail.com', '3', '1624838400', '1624838400', 1),
('SG96071813', 'Sheila Rubi', 'Gonzalez ', '2291316611', '0', 'shei.r.g@hotmail.com', '3', '1624838400', '1624838400', 1),
('VAB91101718', 'VALERIA', 'ALMANZA BADILLO', '2222523683', '0', 'valeriaalmanzab@gmail.com', '3', '1625097600', '1625475655', 1),
('YCA8304196', 'Yarmille', 'Cortes Antuño ', '5580584677', '0', 'yarmille_cortes@hotmail.com', '3', '1624665600', '1624665600', 1);

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
('AF84111819', 'DEP01', '11', '3', '1', '1625230024', '24,', '', 'AF84111819DEP0117'),
('AGT81111821', 'ACN12', '15', '2', '1', '1625239885', '', 'Holaa', 'AGT81111821ACN1218'),
('AGT81111821', 'CAV01', '15', '2', '', '1625239885', '17,10,', 'Perritos', 'AGT81111821ACN1218'),
('AGT81111821', 'CCP43', '15', '2', '1', '1626033591', '', '', 'AGT81111821CCP4354'),
('AGT81111821', 'DEP01', '15', '2', '', '1625239885', '23,17,7,', 'Peke', 'AGT81111821ACN1218'),
('AGT81111821', 'DEP01', '9', '2', '1', '1625302904', '4,', 'hasds', 'AGT81111821DEP0136'),
('AGT81111821', 'FAC16', '15', '2', '1', '1625241291', '', 'ff', 'AGT81111821FAC1622'),
('AGT81111821', 'FAC18', '15', '2', '1', '1626033556', '', '', 'AGT81111821FAC1853'),
('AGT81111821', 'RED30', '15', '2', '', '1625239885', '', 'Bug', 'AGT81111821ACN1218'),
('AJF00111231', 'CAV01', '9', '2', '1', '1628140868', '18,', '', 'AJF00111231CAV0172'),
('AJF00111231', 'DEP01', '9', '2', '1', '1627986465', '7,', 'prueba', 'AJF00111231DEP0170'),
('AJF00111231', 'DEP01', '9', '2', '1', '1628112984', '', 'funcionará?', 'AJF00111231DEP0171'),
('AVF96010123', 'CAV01', '17', '3', '1', '1625863939', '18,', 'Cavitación', 'AVF96010123DEP0143'),
('AVF96010123', 'DEP01', '17', '3', '1', '1625863939', '10,20,', 'Es una prueba de depilacion', 'AVF96010123DEP0143'),
('AVF96010123', 'MDA15', '17', '3', '1', '1625863939', '', '', 'AVF96010123DEP0143'),
('AVG18102229', 'DEP01', '9', '2', '1', '1629436726', '17,', 'hola', 'AVG18102229DEP0173'),
('AVG18102229', 'DEP01', '9', '2', '1', '1629436765', '19,', '', 'AVG18102229DEP0174'),
('AVG18102229', 'FAC22', '9', '2', '1', '1629437042', '', '', 'AVG18102229FAC2275'),
('DRR97121411', 'DEP01', '16', '3', '1', '1624882843', '2,24,', '', 'DRR97121411DEP0111'),
('JKS21071127', 'CAV01', '17', '3', '1', '1629916991', '17,4,18,10,9', '2do tratamiento', 'JKS21071127DEP01110'),
('JKS21071127', 'CAV01', '17', '3', '1', '1629917408', '17,18,9', '2do comentarios', 'JKS21071127DEP01115'),
('JKS21071127', 'DEP01', '17', '3', '1', '1629916991', '17,3,2,4,12,18,13,10,19,7,24,14,', '1er tratamiento', 'JKS21071127DEP01110'),
('JKS21071127', 'DEP01', '17', '3', '1', '1629917408', '21,5,16,8,20,22,15,1,9,6,11,', '1ero', 'JKS21071127DEP01115'),
('JKS21071127', 'FAC17', '17', '3', '1', '1629916991', '', '3er tratamiento', 'JKS21071127DEP01110'),
('JKS21071127', 'FAC18', '17', '3', '1', '1629917408', '', '3ro editado', 'JKS21071127DEP01115'),
('JKS21071127', 'MAS36', '17', '3', '1', '1629916991', '', '4to tratamiento', 'JKS21071127DEP01110'),
('JKS21071127', 'RJV03', '17', '3', '1', '1629917408', '', '4to', 'JKS21071127DEP01115'),
('JR2110031', 'CAV01', '11', '3', '1', '1623693639', '17,', '', 'JR2110031CAV014'),
('JR2110031', 'DEP01', '11', '3', '', '1623693639', '2,20,', '', 'JR2110031CAV014'),
('JR2110031', 'DEP01', '11', '3', '1', '1623428832', '2,20,', '', 'JR2110031DEP012'),
('JR2110031', 'DEP01', '11', '3', '1', '1623428915', '2,20,', '', 'JR2110031DEP013'),
('JR2110031', 'DEP01', '11', '3', '1', '1624884399', '2,4,', '', 'JR2110031DEP0112'),
('JR2110031', 'FAC24', '11', '3', '1', '1623428698', '', '', 'JR2110031FAC241'),
('KPG86080716', 'DEP01', '16', '3', '1', '1625073503', '3,4,24,', 'V. # 10528', 'KPG86080716DEP0113'),
('LG7704198', 'DEP01', '16', '3', '1', '1624882530', '2,24,8,9,', '', 'LG7704198DEP016'),
('LG7704198', 'DEP01', '16', '3', '1', '1624882798', '', '', 'LG7704198DEP0110'),
('LT04111517', 'DEP01', '16', '3', '1', '1625149417', '2,8,9,', 'Hija de Lic. Tellez ', 'LT04111517DEP0114'),
('LVG96110722', 'ACN10', '8', '1', '1', '1626011332', '', 'lplplp', 'LVG96110722MAS4049'),
('LVG96110722', 'CAV01', '8', '1', '1', '1626129539', '17,4,18,', 'cavitacion perrona', 'LVG96110722MAS4160'),
('LVG96110722', 'CAV01', '8', '1', '1', '1626350349', '17,4,18,10', 'Ya se edito', 'LVG96110722FAC2463'),
('LVG96110722', 'CAV01', '8', '1', '1', '1629437822', '4,', '', 'LVG96110722CAV0177'),
('LVG96110722', 'CAV01', '8', '1', '1', '1629552472', '10,9,', '', 'LVG96110722DEP0181'),
('LVG96110722', 'CAV01', '8', '1', '1', '1629560130', '18,10,9,', 'mj', 'LVG96110722CAV0196'),
('LVG96110722', 'CAV01', '8', '1', '1', '1629560154', '17,', 'jh', 'LVG96110722CAV0197'),
('LVG96110722', 'CAV01', '8', '1', '1', '1629560273', '17,', 'hola', 'LVG96110722CAV0199'),
('LVG96110722', 'CAV01', '8', '1', '1', '1630363785', '17,4,18,10', 'hola. esto es un comentario de prueba para el 2do tratamiento editado largo', 'LVG96110722DEP01123'),
('LVG96110722', 'DEP01', '8', '1', '1', '1626127755', '23', 'ads', 'LVG96110722DEP0156'),
('LVG96110722', 'DEP01', '8', '1', '1', '1626350349', '', '', 'LVG96110722FAC2463'),
('LVG96110722', 'DEP01', '8', '1', '1', '1629552412', '23,', 'todo', 'LVG96110722DEP0180'),
('LVG96110722', 'DEP01', '8', '1', '1', '1629552472', '4,', '', 'LVG96110722DEP0181'),
('LVG96110722', 'DEP01', '8', '1', '1', '1629559987', '23,', 'dosa', 'LVG96110722DEP0195'),
('LVG96110722', 'DEP01', '8', '1', '1', '1629560230', '24,14,20,1,6', 'foo lore ipsum ram copia prueba', 'LVG96110722DEP0198'),
('LVG96110722', 'FAC20', '8', '1', '1', '1626011386', '', 'ljkjlj', 'LVG96110722FAC2051'),
('LVG96110722', 'FAC20', '8', '1', '1', '1629497357', '', 'Vamos a agregarle un tratamiento editado porque ya debo de dormir y es tarde', 'LVG96110722FAC2078'),
('LVG96110722', 'FAC24', '8', '1', '1', '1626350349', '', '', 'LVG96110722FAC2463'),
('LVG96110722', 'FAC25', '8', '1', '1', '1626350349', '', '', 'LVG96110722FAC2463'),
('LVG96110722', 'FD01', '8', '1', '1', '1626127755', '', 'Durmiendo editado', 'LVG96110722DEP0156'),
('LVG96110722', 'MAS40', '8', '1', '1', '1626011332', '', 'iioioio', 'LVG96110722MAS4049'),
('LVG96110722', 'MAS41', '8', '1', '1', '1626129539', '', 'Descuento', 'LVG96110722MAS4160'),
('MED98022320', 'DEP01', '16', '3', '1', '1625160951', '2,', '', 'MED98022320DEP0115'),
('PVR21071629', 'CAV01', '8', '1', '1', '1630395110', '17,4,18,10,9', 'Comentario de prueba largoooo \'dssd\'', 'PVR21071629CAV01125'),
('PVR21071629', 'CAV01', '8', '1', '1', '1630703715', '17', 'Hola amigos esto esta editado para ver las diferencias editado', 'PVR21071629DEP01119'),
('PVR21071629', 'DEP01', '8', '1', '1', '1630703715', '17,3,2,4,12,18,19', 'Hola amigos esto esta editado para ver las diferencias', 'PVR21071629DEP01119'),
('SFL1102129', '', '16', '3', '', '1624882674', '', '', 'SFL1102129DEP018'),
('SFL1102129', 'DEP01', '16', '3', '1', '1624882586', '9,', '', 'SFL1102129DEP017'),
('SFL1102129', 'DEP01', '16', '3', '1', '1624882674', '9,', '', 'SFL1102129DEP018'),
('VAB91101718', 'ACN10', '16', '3', '1', '1625267926', '', 'para ver el ts', 'VAB91101718ACN1028'),
('VAB91101718', 'ACN11', '16', '3', '1', '1625243967', '', 'wdsas', 'VAB91101718ACN1133'),
('VAB91101718', 'CAV01', '17', '3', '1', '1625475655', '4,10,', '', 'VAB91101718FAC2238'),
('VAB91101718', 'DEP01', '11', '3', '1', '1625229927', '2,24,', 'VALE 10509 2 DE 3', 'VAB91101718DEP0116'),
('VAB91101718', 'DEP01', '16', '3', '1', '1625243967', '20,1,', 'yryr', 'VAB91101718ACN1133'),
('VAB91101718', 'FAC22', '17', '3', '1', '1625475655', '', '', 'VAB91101718FAC2238'),
('VAB91101718', 'MAS36', '16', '3', '1', '1625241347', '', 'Br', 'VAB91101718MAS3623'),
('VAB91101718', 'MDA13', '16', '3', '1', '1625266952', '', 'Hola', 'VAB91101718RJV0524'),
('VAB91101718', 'MDA14', '16', '3', '1', '1625243168', '', 'weesdsetg', 'VAB91101718MDA1430'),
('VAB91101718', 'RED29', '16', '3', '1', '1625243040', '', 'w', 'VAB91101718RED2929'),
('VAB91101718', 'RJV05', '16', '3', '1', '1625266952', '', 'Gosl', 'VAB91101718RJV0524');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteOpcional`
--

CREATE TABLE `ClienteOpcional` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp_cliente` varchar(10) COLLATE utf8_bin NOT NULL,
  `id_monedero` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ClienteOpcional`
--

INSERT INTO `ClienteOpcional` (`id_cliente`, `fecha_cliente`, `cp_cliente`, `id_monedero`) VALUES
('AAH5212055', '1952-12-05', '72150', ''),
('AF2111183', '2021-11-18', '00000', ''),
('AF84111819', '1984-11-18', '72150', ''),
('AGT81111821', '1981-11-18', '72830', 'hio'),
('AJF00111231', '1900-11-12', '99089', 'monedero300'),
('AVF96010123', '1996-01-01', '', ''),
('AVG18102229', '2018-10-22', '', '910'),
('BGZ21071215', '2021-07-12', '72310', ''),
('CZ21071930', '2021-07-19', '', '860'),
('DRR97121411', '1997-12-14', '90790', ''),
('ECJ89030612', '1989-03-06', '', ''),
('EES00111026', '2000-11-10', '72590', ''),
('EG98012114', '1998-01-21', '72150', ''),
('IC2102247', '2021-02-24', '72176', ''),
('IG2104084', '2021-04-08', '72470', ''),
('JKS21071127', '2021-07-11', '', ''),
('JR2110031', '2021-10-03', '74260', ''),
('KPG86080716', '1986-08-07', '72040', ''),
('LG7704198', '1977-04-19', '72410', ''),
('LH2103212', '2021-03-21', '64240', ''),
('LT04111517', '2004-11-15', '72777', ''),
('LVG21071025', '2021-07-10', '89099', ''),
('LVG24', '1625868000', '', ''),
('LVG96110722', '1996-11-07', '72830', ''),
('MED98022320', '1998-02-23', '74210', ''),
('PVR21071629', '1966-11-07', '', ''),
('SFE91012510', '1991-01-25', '90570', ''),
('SFL1102129', '2011-02-12', '72190', ''),
('SG96071813', '1996-07-18', '72365', ''),
('VAB91101718', '1991-10-17', '72990', ''),
('YCA8304196', '1983-04-19', '', '');

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
('AAH5212055', 'activo'),
('AF2111183', 'activo'),
('AF84111819', 'activo'),
('AGT81111821', 'activo'),
('AJF00111231', 'activo'),
('AVF96010123', 'activo'),
('AVG18102229', 'activo'),
('BGZ21071215', 'activo'),
('CZ21071930', 'activo'),
('DRR97121411', 'activo'),
('ECJ89030612', 'activo'),
('EES00111026', 'activo'),
('EG98012114', 'activo'),
('IC2102247', 'activo'),
('IG2104084', 'activo'),
('JKS21071127', 'activo'),
('JR2110031', 'activo'),
('KPG86080716', 'activo'),
('LG7704198', 'activo'),
('LH2103212', 'activo'),
('LT04111517', 'activo'),
('LVG21071025', 'activo'),
('LVG24', 'activo'),
('LVG96110722', 'activo'),
('MED98022320', 'activo'),
('PVR21071629', 'activo'),
('SFE91012510', 'activo'),
('SFL1102129', 'activo'),
('SG96071813', 'activo'),
('VAB91101718', 'activo'),
('YCA8304196', 'activo');

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
('AGT81111821', 'ACN12', '15', 'ACN12', '', '1625239885'),
('AGT81111821', 'CCP43', '15', 'CCP43', '', '1626033591'),
('AGT81111821', 'FAC16', '15', 'FAC16', '', '1625241291'),
('AGT81111821', 'FAC18', '15', 'FAC18', '', '1626033556'),
('AGT81111821', 'RED30', '15', 'RED30', '', '1625239885'),
('AVF96010123', 'MDA15', '17', 'MDA15', '', '1625863939'),
('AVG18102229', 'FAC22', '9', 'FAC22', '', '1629437042'),
('JKS21071127', 'FAC17', '17', 'FAC17', '', '1629916991'),
('JKS21071127', 'FAC18', '17', 'FAC18', '', '1629917408'),
('JKS21071127', 'MAS36', '17', 'MAS36', '', '1629916991'),
('JKS21071127', 'RJV03', '17', 'RJV03', '', '1629917408'),
('JR2110031', 'FAC24', '11', 'FAC24', '', '1623428698'),
('LVG96110722', 'ACN10', '8', 'ACN10', '', '1626011332'),
('LVG96110722', 'FAC20', '8', 'FAC20', '', '1626011386'),
('LVG96110722', 'FAC20', '8', 'FAC20', '', '1629497357'),
('LVG96110722', 'FAC24', '8', 'FAC24', '', '1626350349'),
('LVG96110722', 'FAC25', '8', 'FAC25', '', '1626350349'),
('LVG96110722', 'FD01', '8', 'FD01', '', '1626127755'),
('LVG96110722', 'MAS40', '8', 'MAS40', '', '1626011332'),
('LVG96110722', 'MAS41', '8', 'MAS41', '', '1626129539'),
('VAB91101718', 'ACN10', '16', 'ACN10', '', '1625267926'),
('VAB91101718', 'ACN11', '16', 'ACN11', '', '1625243967'),
('VAB91101718', 'FAC22', '17', 'FAC22', '', '1625475655'),
('VAB91101718', 'MAS36', '16', 'MAS36', '', '1625241347'),
('VAB91101718', 'MDA13', '16', 'MDA13', '', '1625266952'),
('VAB91101718', 'MDA14', '16', 'MDA14', '', '1625243168'),
('VAB91101718', 'RED29', '16', 'RED29', '', '1625243040'),
('VAB91101718', 'RJV05', '16', 'RJV05', '', '1625266952');

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
('AF84111819', 'DEP01', '11', 'DEP01', '24,', '1', '1625230024', 1),
('AGT81111821', 'CAV01', '15', 'CAV01', '17,10,', '1', '1625239885', 1),
('AGT81111821', 'DEP01', '15', 'DEP01', '23,17,7,', '12', '1625239885', 1),
('AGT81111821', 'DEP01', '9', 'DEP01', '4,', '5', '1625302904', 1),
('AJF00111231', 'DEP01', '9', 'DEP01', '', '6', '1628112984', 1),
('AJF00111231', 'CAV01', '9', 'CAV01', '18,', '0', '1628140868', 1),
('AJF00111231', 'DEP01', '9', 'DEP01', '7,', '2', '1627986465', 1),
('AVF96010123', 'DEP01', '17', 'DEP01', '10,20,', '1', '1625863939', 1),
('AVF96010123', 'CAV01', '17', 'CAV01', '18,', '0', '1625863939', 1),
('AVG18102229', 'DEP01', '9', 'DEP01', '17,', '2', '1629436726', 1),
('AVG18102229', 'DEP01', '9', 'DEP01', '19,', '6', '1629436765', 1),
('DRR97121411', 'DEP01', '16', 'DEP01', '2,24,', '2', '1624882843', 1),
('JKS21071127', 'CAV01', '17', 'CAV01', '17,18,9', '0', '1629917408', 3),
('JKS21071127', 'DEP01', '17', 'DEP01', '17,3,2,4,12,18,13,10,19,7,24,14,', '10', '1629916991', 1),
('JKS21071127', 'CAV01', '17', 'CAV01', '17,4,18,10,9', '0', '1629916991', 2),
('JKS21071127', 'DEP01', '17', 'DEP01', '21,5,16,8,20,22,15,1,9,6,11,', '15', '1629917408', 2),
('JR2110031', 'CAV01', '11', 'CAV01', '17,', '1', '1623693639', 1),
('JR2110031', 'DEP01', '11', 'DEP01', '2,20,', '1', '1623693639', 1),
('JR2110031', 'DEP01', '11', 'DEP01', '2,20,', '2', '1623428832', 1),
('JR2110031', 'DEP01', '11', 'DEP01', '2,20,', '2', '1623428915', 1),
('JR2110031', 'DEP01', '11', 'DEP01', '2,4,', '2', '1624884399', 1),
('KPG86080716', 'DEP01', '16', 'DEP01', '3,4,24,', '3', '1625073503', 1),
('LG7704198', 'DEP01', '16', 'DEP01', '', '6', '1624882798', 1),
('LG7704198', 'DEP01', '16', 'DEP01', '2,24,8,9,', '6', '1624882530', 1),
('LT04111517', 'DEP01', '16', 'DEP01', '2,8,9,', '5', '1625149417', 1),
('LVG96110722', 'DEP01', '8', 'DEP01', '', '10', '1626350349', 1),
('LVG96110722', 'CAV01', '8', 'CAV01', '10,9,', '0', '1629552472', 1),
('LVG96110722', 'CAV01', '8', 'CAV01', '17,', '0', '1629560154', 6),
('LVG96110722', 'CAV01', '8', 'CAV01', '17,', '0', '1629560273', 7),
('LVG96110722', 'CAV01', '8', 'CAV01', '17,4,18,', '0', '1626129539', 1),
('LVG96110722', 'CAV01', '8', 'CAV01', '17,4,18,10', '0', '1626350349', 1),
('LVG96110722', 'CAV01', '8', 'CAV01', '18,10,9,', '0', '1629560130', 6),
('LVG96110722', 'DEP01', '8', 'DEP01', '23', '12', '1626127755', 1),
('LVG96110722', 'DEP01', '8', 'DEP01', '23,', '3', '1629552412', 1),
('LVG96110722', 'DEP01', '8', 'DEP01', '23,', '3', '1629559987', 6),
('LVG96110722', 'DEP01', '8', 'DEP01', '24,14,20,1,6', '11', '1629560230', 8),
('LVG96110722', 'CAV01', '8', 'CAV01', '4,', '0', '1629437822', 1),
('LVG96110722', 'DEP01', '8', 'DEP01', '4,', '4', '1629552472', 1),
('MED98022320', 'DEP01', '16', 'DEP01', '2,', '1', '1625160951', 1),
('PVR21071629', 'CAV01', '8', 'CAV01', '17', '0', '1630703715', 2),
('PVR21071629', 'DEP01', '8', 'DEP01', '17,3,2,4,12,18,19', '7', '1630703715', 2),
('PVR21071629', 'CAV01', '8', 'CAV01', '17,4,18,10,9', '0', '1630395110', 2),
('SFL1102129', '', '16', '', '', '', '1624882674', 1),
('SFL1102129', 'DEP01', '16', 'DEP01', '9,', '2', '1624882586', 1),
('SFL1102129', 'DEP01', '16', 'DEP01', '9,', '2', '1624882674', 1),
('VAB91101718', 'DEP01', '11', 'DEP01', '2,24,', '1', '1625229927', 1),
('VAB91101718', 'DEP01', '16', 'DEP01', '20,1,', '1', '1625243967', 1),
('VAB91101718', 'CAV01', '17', 'CAV01', '4,10,', '1', '1625475655', 1);

-- --------------------------------------------------------

--
-- Table structure for table `DetallesEdicionVenta`
--

CREATE TABLE `DetallesEdicionVenta` (
  `id_venta` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `timestamp_venta` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `timestamp_edicion` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `tipo_edicion` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `antes` text COLLATE utf8mb4_bin NOT NULL,
  `despues` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `DetallesEdicionVenta`
--

INSERT INTO `DetallesEdicionVenta` (`id_venta`, `timestamp_venta`, `timestamp_edicion`, `tipo_edicion`, `antes`, `despues`) VALUES
('LVG96110722DEP0198', '1629560230', '1630966153', 'Tratamiento', '[[{\"id_venta\":\"LVG96110722DEP0198\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":2,\"referencia_pago\":\"dd\",\"monto\":\"3344\",\"timestamp\":\"1629560230\",\"centro\":\"1\",\"costo_tratamiento\":\"3344\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"6,\",\"detalle_zona\":\"11\",\"timestamp\":\"1629560230\",\"num_sesion\":8}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1629560230\",\"zona_cuerpo\":\"6,\",\"comentarios\":\"foo\",\"id_venta\":\"LVG96110722DEP0198\"}]]', '[[{\"id_venta\":\"LVG96110722DEP0198\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":2,\"referencia_pago\":\"dd\",\"monto\":\"3300\",\"timestamp\":\"1629560230\",\"centro\":\"1\",\"costo_tratamiento\":\"3300\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"24,14,20,1,6\",\"detalle_zona\":\"11\",\"timestamp\":\"1629560230\",\"num_sesion\":8}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1629560230\",\"zona_cuerpo\":\"24,14,20,1,6\",\"comentarios\":\"foo lore ipsum ram copia prueba\",\"id_venta\":\"LVG96110722DEP0198\"}]]'),
('LVG96110722FAC2078', '1629497357', '1630965593', 'Tratamiento', '[[{\"id_venta\":\"LVG96110722FAC2078\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"metodo_pago\":6,\"referencia_pago\":\"zzr75844\",\"monto\":\"1800\",\"timestamp\":\"1629497357\",\"centro\":\"1\",\"costo_tratamiento\":\"1800\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1629497357\",\"zona_cuerpo\":\"\",\"comentarios\":\"\",\"id_venta\":\"LVG96110722FAC2078\"}]]', '[[{\"id_venta\":\"LVG96110722FAC2078\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"metodo_pago\":6,\"referencia_pago\":\"zzr75844\",\"monto\":\"1800\",\"timestamp\":\"1629497357\",\"centro\":\"1\",\"costo_tratamiento\":\"1800\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1629497357\",\"zona_cuerpo\":\"\",\"comentarios\":\"Vamos a agregarle un tratamiento editado\",\"id_venta\":\"LVG96110722FAC2078\"}]]'),
('LVG96110722FAC2078', '1629497357', '1630966060', 'Producto', '[{\"id_venta\":\"LVG96110722FAC2078\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"\",\"metodo_pago\":6,\"referencia_pago\":\"zzr75844\",\"monto\":\"471.00\",\"timestamp\":\"1629497357\",\"centro\":\"1\",\"costo_tratamiento\":\"\",\"id_productos\":\"xxxx\",\"costo_producto\":\"471\",\"cantidad_producto\":\"1\",\"id_cosmetologa\":\"8\"}]', '[{\"id_venta\":\"LVG96110722FAC2078\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"\",\"metodo_pago\":6,\"referencia_pago\":\"zzr75844\",\"monto\":\"470.00\",\"timestamp\":\"1629497357\",\"centro\":\"1\",\"costo_tratamiento\":\"\",\"id_productos\":\"xxxx\",\"costo_producto\":\"470\",\"cantidad_producto\":\"1\",\"id_cosmetologa\":\"8\"}]'),
('LVG96110722FAC2078', '1629497357', '1630966091', 'Tratamiento', '[[{\"id_venta\":\"LVG96110722FAC2078\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"metodo_pago\":6,\"referencia_pago\":\"zzr75844\",\"monto\":\"1800\",\"timestamp\":\"1629497357\",\"centro\":\"1\",\"costo_tratamiento\":\"1800\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1629497357\",\"zona_cuerpo\":\"\",\"comentarios\":\"Vamos a agregarle un tratamiento editado\",\"id_venta\":\"LVG96110722FAC2078\"}]]', '[[{\"id_venta\":\"LVG96110722FAC2078\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"metodo_pago\":6,\"referencia_pago\":\"zzr75844\",\"monto\":\"1800\",\"timestamp\":\"1629497357\",\"centro\":\"1\",\"costo_tratamiento\":\"1800\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"FAC20\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1629497357\",\"zona_cuerpo\":\"\",\"comentarios\":\"Vamos a agregarle un tratamiento editado porque ya debo de dormir y es tarde\",\"id_venta\":\"LVG96110722FAC2078\"}]]'),
('LVG96110722FAC2463', '1626350349', '1630929402', 'Producto', '[{\"id_venta\":\"LVG96110722FAC2463\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"\",\"metodo_pago\":3,\"referencia_pago\":\"Mag\",\"monto\":\"320.00\",\"timestamp\":\"1626350349\",\"centro\":\"1\",\"costo_tratamiento\":\"\",\"id_productos\":\"HJS67\",\"costo_producto\":\"320\",\"cantidad_producto\":\"1\",\"id_cosmetologa\":\"8\"}]', '[{\"id_venta\":\"LVG96110722FAC2463\",\"id_cliente\":\"LVG96110722\",\"id_tratamiento\":\"\",\"metodo_pago\":3,\"referencia_pago\":\"Mag\",\"monto\":\"310.00\",\"timestamp\":\"1626350349\",\"centro\":\"1\",\"costo_tratamiento\":\"\",\"id_productos\":\"HJS67\",\"costo_producto\":\"310\",\"cantidad_producto\":\"1\",\"id_cosmetologa\":\"8\"}]'),
('PVR21071629DEP01119', '1630703715', '1630964596', 'Tratamiento', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"2184\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"2184\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"18,19,9,6\",\"detalle_zona\":\"7\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"18,19,9,6\",\"comentarios\":\"ddffdfdfd\",\"id_venta\":\"PVR21071629DEP01119\"}]]', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"2184\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"2184\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"18,19,9\",\"detalle_zona\":\"7\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"18,19,9,6\",\"comentarios\":\"ddffdfdfd\",\"id_venta\":\"PVR21071629DEP01119\"}]]'),
('PVR21071629DEP01119', '1630703715', '1630964793', 'Tratamiento', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"700\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"700\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"CAV01\",\"zona\":\"17,4,18,10,9\",\"detalle_zona\":\"0\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"17,4,18,10,9\",\"comentarios\":\"Hola amigos\",\"id_venta\":\"PVR21071629DEP01119\"}]]', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"700\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"700\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"CAV01\",\"zona\":\"17,4,18,10,9\",\"detalle_zona\":\"0\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"17,4,18,10,9\",\"comentarios\":\"Hola amigos\",\"id_venta\":\"PVR21071629DEP01119\"}]]'),
('PVR21071629DEP01119', '1630703715', '1630964923', 'Tratamiento', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"2180\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"2180\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"18,19,9\",\"detalle_zona\":\"7\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"18,19,9\",\"comentarios\":\"ddffdfdfd\",\"id_venta\":\"PVR21071629DEP01119\"}]]', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"2200\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"2200\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"18,19,11\",\"detalle_zona\":\"7\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"18,19,11\",\"comentarios\":\"Hola amigos esto esta editado para ver las diferencias\",\"id_venta\":\"PVR21071629DEP01119\"}]]'),
('PVR21071629DEP01119', '1630703715', '1630965179', 'Tratamiento', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"2200\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"2200\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"18,19,11\",\"detalle_zona\":\"7\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"18,19,11\",\"comentarios\":\"Hola amigos esto esta editado para ver las diferencias\",\"id_venta\":\"PVR21071629DEP01119\"}]]', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"2200\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"2200\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"DEP01\",\"zona\":\"17,3,2,4,12,18,19\",\"detalle_zona\":\"7\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"DEP01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"17,3,2,4,12,18,19\",\"comentarios\":\"Hola amigos esto esta editado para ver las diferencias\",\"id_venta\":\"PVR21071629DEP01119\"}]]'),
('PVR21071629DEP01119', '1630703715', '1630966303', 'Tratamiento', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"900\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"900\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"CAV01\",\"zona\":\"17,4,18,10,9\",\"detalle_zona\":\"0\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"17,4,18,10,9\",\"comentarios\":\"Hola amigos esto esta editado para ver las diferencias\",\"id_venta\":\"PVR21071629DEP01119\"}]]', '[[{\"id_venta\":\"PVR21071629DEP01119\",\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"metodo_pago\":3,\"referencia_pago\":\"Apple Pay\",\"monto\":\"930\",\"timestamp\":\"1630703715\",\"centro\":\"1\",\"costo_tratamiento\":\"930\",\"id_productos\":\"\",\"costo_producto\":\"\",\"cantidad_producto\":\"\",\"id_cosmetologa\":\"8\"}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"nombre_tratamiento\":\"CAV01\",\"zona\":\"17\",\"detalle_zona\":\"0\",\"timestamp\":\"1630703715\",\"num_sesion\":2}],[{\"id_cliente\":\"PVR21071629\",\"id_tratamiento\":\"CAV01\",\"id_cosmetologa\":\"8\",\"centro\":\"1\",\"calificacion\":\"1\",\"timestamp\":\"1630703715\",\"zona_cuerpo\":\"17\",\"comentarios\":\"Hola amigos esto esta editado para ver las diferencias editado\",\"id_venta\":\"PVR21071629DEP01119\"}]]');

-- --------------------------------------------------------

--
-- Table structure for table `Monedero`
--

CREATE TABLE `Monedero` (
  `id_monedero` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa_venta` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa_uso` varchar(255) COLLATE utf8_bin NOT NULL,
  `dinero_inicial` varchar(255) COLLATE utf8_bin NOT NULL,
  `tratamientos_inicial` varchar(255) COLLATE utf8_bin NOT NULL,
  `precios_unitarios` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_zonas` varchar(255) COLLATE utf8_bin NOT NULL,
  `zonas_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `cantidad` varchar(255) COLLATE utf8_bin NOT NULL,
  `dinero_final` varchar(255) COLLATE utf8_bin NOT NULL,
  `tratamientos_final` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp_creacion` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp_uso` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Monedero`
--

INSERT INTO `Monedero` (`id_monedero`, `id_cliente`, `id_cosmetologa_venta`, `id_cosmetologa_uso`, `dinero_inicial`, `tratamientos_inicial`, `precios_unitarios`, `num_zonas`, `zonas_tratamiento`, `cantidad`, `dinero_final`, `tratamientos_final`, `timestamp_creacion`, `timestamp_uso`) VALUES
('600', 'AJF00111231', '9', '', '25176', '[\"DEP01\",\"CAV01\",\"FAC23\",\"MAS40\"]', '', '', '', '[\"4\",\"2\",\"5\",\"10\"]', '', '', '1627920515', ''),
('780', 'AJF00111231', '9', '', '1500', '\"\"', '', '', '', '\"\"', '[\"0\"]', '', '1627920525', ''),
('9009', 'AJF00111231', '9', '', '10400', '\"\"', '\"\"', '', '\"\"', '\"\"', '', '', '1629425320', ''),
('assa', 'AJF00111231', '9', '', '60960', '[\"DEP01\",\"CAV01\",\"CCP43\",\"DEP01\"]', '[\"5184\",\"788\",\"600\",\"3344\"]', '', '[\"18\",\"\",\"\",\"11\"]', '[\"10\",\"2\",\"7\",\"1\"]', '', '', '1629425310', ''),
('mon1', 'AJF00111231', '9', '', '29782', '[\"ACN10\",\"CCE42\",\"DEP01\",\"CAV01\",\"FAC19\",\"DEP01\"]', '[\"700\",\"1000\",\"1872\",\"700\",\"750\",\"1264\"]', '[\"\",\"\",\"6\",\"\",\"\",\"4\"]', '[\"\",\"\",\"17,3,4,13,19,24,14,5,8,22,9,11\",\"18,9\",\"\",\"23\"]', '[\"5\",\"2\",\"8\",\"5\",\"1\",\"4\"]', '', '', '1629436082', ''),
('mon12', 'AJF00111231', '9', '', '7444', '[\"DEP01\",\"CAV01\",\"RED30\",\"RED28\"]', '[\"1872\",\"300\",\"500\",\"700\"]', '', '[\"6\",\"\",\"\",\"\"]', '[\"2\",\"5\",\"3\",\"1\"]', '', '', '1629436115', ''),
('mon13', 'AJF00111231', '9', '', '9780', '[\"DEP01\",\"CAV01\",\"FAC19\"]', '[\"640\",\"200\",\"750\"]', '', '[\"20,22,15,1,9,6,11\",\"17,4,18,10,9\",\"\"]', '[\"2\",\"5\",\"10\"]', '', '', '1629436110', ''),
('mon14', 'AJF00111231', '9', '', '100', '\"\"', '\"\"', '', '\"\"', '\"\"', '', '', '1629436130', ''),
('monedero300', 'AJF00111231', '9', '', '15522', '[\"DEP01\",\"CAV01\",\"FAC19\",\"MAS32\",\"DEP01\"]', '[\"2184\",\"600\",\"750\",\"320\",\"1950\"]', '[\"7\",\"\",\"\",\"\",\"7\"]', '[\"8,11\",\"17,4,18,10,9\",\"\",\"\",\"23\"]', '[\"3\",\"1\",\"6\",\"6\",\"1\"]', '', '', '1629461301', ''),
('xx', 'xx', 'xx', '', 'xxx', 'xx', '', '', '', '', '', '', 'xxx', ''),
('xxaasd', 'AJF00111231', '9', '', '7200', '[\"DEP01\"]', '[\"3600\"]', '', 'Array', '[\"2\"]', '', '', '1629425332', '');

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
('0SH01', 'MIGUETT', '', 'SHAMPOO VAU CON PARTÍCULAS Y EXTRACTO DE BAMBÚ', '150ML', 0, '325', '3'),
('123', 'AINHOA', 'SKIN PRIMES', 'EXFOLIANTE DE ARROZ', '200ml', 0, '500', '3'),
('2000080', 'AINHOA', 'OTRO', 'GEL POST DEPILATORIO CON EXTRACTO DE ALGODON', '200ML', 1, '527', '3'),
('20035040', 'AINHOA', 'OTRO', 'ACEITE CALIENTE DE MASAJE LAVANDA', '80G', 1, '516', '3'),
('34560', 'AINHOA', 'COLLAGEN+', 'PRUEBA PARA VER EXISTENCIA', '100ml', 4, '50', '3'),
('430V3', 'GERMAINE', '', 'GEL DESINFECTANTE', '30ml', 2, '300', '3'),
('CG03', 'MIGUETT', '', 'PRUEBA 1', '30L', 70, '200', '1'),
('CPE03', 'MIGUETT', '', 'CREMA DE NOPAL PARA BOLSAS DE OJOS', '50ML', 0, '471', '3'),
('CPE04', 'MIGUETT', '', 'CREMA DE COLAGENO E', '50ML', 1, '471', '3'),
('GP01', 'MIGUETT', '', 'SHAMPOO DERMOLIMPIADOR HIPOALERGÉNICO ', '150ML', 1, '294', '3'),
('HJS67', 'MIGUETT', '', 'PRUEBA PARA REFERENCIA DE PAGO', 'PRUEBA PARA REFERENCIA DE PAGOPRUEBA PARA REFERENCIA DE PAGO', 6, '325', '1'),
('HSHG01', 'MIGUETT', '', 'SHAMPOO GOLD -CHAMPÁN DELUXE CON ESFERAS VITAMINADAS ', '150ML', 10, '312', '3'),
('JSHAC2', 'MIGUETT', '', 'SHAMPOO ACNEID: PREBIOTICOS + C. ACTIVADO', '150ML', 0, '368', '3'),
('KGIF8', 'AINHOA', 'SPA LUXURY', 'PRERJND', 'BUENA SUERTE', 47, '35', '1'),
('P1579', 'AINHOA', 'PURITY', 'CREMA SEBORREGULADORA', '200ML', 1, '1716', '3'),
('P1875', 'AINHOA', 'BODY LINE UP', 'CRIO GEL', '500ML', 1, '1060', '3'),
('P48.8', 'GERMAINE', '', 'ACTIVADOR DEFENSAS ESENCIALES DE LA PIEL', '30ML', 0, '1465', '3'),
('P8000N', 'AINHOA', 'OTRO', 'ACIDO GLICOLICO', '50ML', 1, '1063', '3'),
('PP02', 'MIGUETT', '', 'POLVOS MINOTRASLUCIDOS COLOR PIEL ', '25G', 0, '338', '3'),
('R1572N', 'AINHOA', 'WHITESS', 'CREMA DESPIGMENTANTE', '50ML', 1, '668', '3'),
('R1862N', 'AINHOA', 'PURITY', 'FLUIDO PURIFICANTE', '30ML', 2, '754', '3'),
('R1899N', 'AINHOA', 'OTRO', 'CREMA HIDRO NUTRITIVA CON EXTRACTO DE CAVIAR', '50ML', 1, '1000', '3'),
('R1902N', 'AINHOA', 'OTRO', 'CONTORNO DE OJOS LUXE', '15ML', 1, '593', '3'),
('R2250', 'AINHOA', 'COLLAGEN+', 'CREMA FIRMEZA Y VOLUMEN', '50ML', 1, '1466', '3'),
('R2252', 'AINHOA', 'COLLAGEN+', 'CONTORNO DE OJOS LIFT-REAFIRMANTE', '15 ml', 10, '1153', '2'),
('R2301', 'AINHOA', 'MULTIVIT', 'CONTORNO DE OJOS LUMINOSO', '15ML', 1, '916', '3'),
('R2302', 'AINHOA', 'MULTIVIT', 'CREMA MULTIVITAMINAS ', '50ML', 3, '1231', '3'),
('R8002N', 'AINHOA', 'HYALURONIC', 'CREMA ESENCIAL HYALURONIC', '50ML', 1, '1444', '3'),
('R8007N', 'AINHOA', 'HYALURONIC', 'SERUM ESENCIAL', '50ML', 1, '1403', '3'),
('XCX23320', 'GERMAINE', '', 'HIDRO GEL ALOE VERA', '100 ML', 17, '340', '3'),
('col332', 'AINHOA', 'COLLAGEN+', 'DSSDSD', '100ml', 0, '70', '3'),
('hhsdids', 'AINHOA', 'SENSKIN', 'CREMA DE CACAHUATE', '100ML', 3, '54.96', '3'),
('hvyf675', 'GERMAINE', '', 'PRODUUCTO 363', 'PRUEBA PARA VER LOS MULTIPRODUCTS', 18, '28', '1'),
('kio', 'AINHOA', 'PURITY', 'INVENTARIO ', '40ml', 0, '90', '2'),
('mau445', 'AINHOA', 'COLLAGEN+', 'MAURO', '10ml', 4, '33.50', '3'),
('nooaplsd', 'GERMAINE', '', 'GEL DE NOPAL PARA MANOS DELICADAS', '300ML', 15, '200', '2'),
('vvnm', 'MIGUETT', '', 'PRUEBA INVENTARIO PARA VER QUE TAN EFECTIVO ES EL DISEÑO', '30g', 6, '40', '2'),
('xamp', 'AINHOA', 'PURITY', 'PRUEBA PRODUCTOS', '100ml', 8, '190', '2'),
('xuva', 'AINHOA', 'COLLAGEN+', 'UVAS', '100GRMS', 3, '40', '3'),
('xxxx', 'MIGUETT', '', 'ELIXIR DE NOPAL', '50ml', 6, '471', '1'),
('youtube', 'AINHOA', 'COLLAGEN+', 'YOUTUBE COLLAGEN+', '100ML', 5, '340.07', '3');

-- --------------------------------------------------------

--
-- Table structure for table `ProductosApartados`
--

CREATE TABLE `ProductosApartados` (
  `id_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `centro_producto` varchar(50) COLLATE utf8_bin NOT NULL,
  `cantidad_producto` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp_inicial` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp_final` varchar(255) COLLATE utf8_bin NOT NULL
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
  `id_sucursal_usuario` int(11) NOT NULL,
  `jerarquia` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`, `id_sucursal_usuario`, `jerarquia`) VALUES
(8, 'Cecilia', 'sonata@proskin.com', '$2y$10$XfrGDv443rXAgesAhSfiTu8AAJWolQDxteAQ/ZxOG7pUP8qTPTS1C', 635339, 'notverified', 1, '1'),
(9, 'Mónica', 'plazaReal@proskin.com', '$2y$10$a1qB3Q3RV9kANUZcrFwP/uxs.h0YperX1UXbdHNNhIFu8McU/4DWS', 190930, 'notverified', 2, '2'),
(11, 'Jocelyn', 'jocelynrosas@hotmail.com', '$2y$10$GhNrzmxhyk2JuTOAKlACdeq5IaEsrOgt/o8Mz.FoirQe5fPn8XVU2', 285728, 'notverified', 3, '2'),
(12, 'Alejandra López Sánchez', 'ginjerale@icloud.com', '$2y$10$ErAwd5qMOEfifZ58WQNVQuWTNezJNDe2h2wYjQYz39U0kZcvWo6Mu', 380753, 'notverified', 1, '2'),
(13, 'Diana Pérez Pérez', 'redna555@hotmail.com', '$2y$10$BXyKsjeC14ZeNDqZOqNN.OoZBt3zlRhzNgFSLBeowxZazENIkIXLm', 772508, 'notverified', 1, '2'),
(14, 'Violeta de Lázaro Jiménez', 'violetadl67@gmail.com', '$2y$10$frM7zDJzzpaEyqrmj8o6B.UdH8FwtNEPbIh3BVd.ppqjX6RHvAJNC', 882430, 'notverified', 2, '2'),
(15, 'Paulina López Sánchez', 'p.lopezsanchez93@gmail.com', '$2y$10$UFwTquj1AFvlDmM0kgedZ.psay2D0r1WyDz31Huxagl6Mc9V7gPIW', 178299, 'notverified', 2, '2'),
(16, 'Joselin Vadena Quitl', 'joss.qtl@gmail.com', '$2y$10$5MIl2o29pOFjcROnGYu5X.3j7xviNudaOW1NpWnU93Kjj62ptW3xu', 633811, 'notverified', 3, '2'),
(17, 'Maria Orozco', 'lapaz@proskin.com', '$2y$10$XfrGDv443rXAgesAhSfiTu8AAJWolQDxteAQ/ZxOG7pUP8qTPTS1C', 1223, 'no verified', 3, '2'),
(18, 'Magali Pérez Pérez', 'magali.mpr14@gmail.com', '$2y$10$.Rpf1GVASaZowhFC5e3Me.rfEVWVnX.HusOUrxZo9Y.t3jVGgv7jG', 896908, 'notverified', 2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `Ventas`
--

CREATE TABLE `Ventas` (
  `id_venta` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `metodo_pago` int(5) NOT NULL,
  `referencia_pago` varchar(255) COLLATE utf8_bin NOT NULL,
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

INSERT INTO `Ventas` (`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `referencia_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) VALUES
('col33221568', '', '', 2, 'ejemplo referencia', '100.00', '1626560852', '2', '', '34560', '50', '2', '15'),
('XCX2332031741', '', '', 4, '', '1020.00', '1625476872', '3', '', 'XCX23320', '340', '3', '17'),
('hvyf6751847', '', '', 6, 'REFERENCIA', '105.00', '1626009470', '1', '', 'KGIF8', '35', '3', '8'),
('CG0318108', '', '', 6, 'xxczb', '1600.00', '1629583128', '1', '', 'CG03', '200', '8', '8'),
('xxxx18121', '', '', 1, 'fdff', '2400', '1630533945', '1', '', 'xxxx', '800', '3', '8'),
('ssdd31627', '', '', 1, '', '280.00', '1625242682', '3', '', 'ssdd', '280', '1', '16'),
('ssdd31626', '', '', 1, '', '300.00', '1625242007', '3', '', 'ssdd', '300', '1', '16'),
('HJS671846', '', '', 6, 'xxxxsd', '325.00', '1626008958', '1', '', 'HJS67', '325', '1', '8'),
('xxxx1885', '', '', 6, 'bayou', '471.00', '1629556435', '1', '', 'xxxx', '471', '1', '8'),
('hvyf6751847', '', '', 6, 'REFERENCIA', '56.00', '1626009470', '1', '', 'hvyf675', '28', '2', '8'),
('ssdd31632', '', '', 1, '', '600.00', '1625243910', '3', '', 'ssdd', '300', '2', '16'),
('col33221568', '', '', 2, 'ejemplo referencia', '70.00', '1626560852', '2', '', 'col332', '70', '1', '15'),
('XCX2332031741', '', '', 4, '', '900.00', '1625476872', '3', '', '430V3', '300', '3', '17'),
('AF84111819DEP0117', 'AF84111819', 'DEP01', 1, '', '400', '1625230024', '3', '400', '', '', '', '11'),
('AGT81111821DEP0136', 'AGT81111821', '', 1, '', '594.00', '1625302904', '2', '', 'CG03', '594', '1', '9'),
('AGT81111821CCP4354', 'AGT81111821', '', 6, '567781', '594.00', '1626033591', '2', '', 'CG03', '594', '1', '15'),
('AGT81111821ACN1218', 'AGT81111821', 'ACN12', 2, '', '700', '1625239885', '2', '700', '', '', '', '15'),
('AGT81111821ACN1218', 'AGT81111821', 'CAV01', 2, '', '550', '1625239885', '2', '550', '', '', '', '15'),
('AGT81111821CCP4354', 'AGT81111821', 'CCP43', 6, '567781', '600', '1626033591', '2', '600', '', '', '', '15'),
('AGT81111821DEP0136', 'AGT81111821', 'DEP01', 1, '', '1580', '1625302904', '2', '1580', '', '', '', '9'),
('AGT81111821ACN1218', 'AGT81111821', 'DEP01', 2, '', '3600', '1625239885', '2', '3600', '', '', '', '15'),
('AGT81111821FAC1622', 'AGT81111821', 'FAC16', 1, '', '650', '1625241291', '2', '650', '', '', '', '15'),
('AGT81111821FAC1853', 'AGT81111821', 'FAC18', 6, '', '650', '1626033556', '2', '650', '', '', '', '15'),
('AGT81111821ACN1218', 'AGT81111821', 'RED30', 2, '', '500', '1625239885', '2', '500', '', '', '', '15'),
('AJF00111231CAV0172', 'AJF00111231', 'CAV01', 6, '', '500', '1628140868', '2', '500', '', '', '', '9'),
('AJF00111231DEP0171', 'AJF00111231', 'DEP01', 1, '', '1872', '1628112984', '2', '1872', '', '', '', '9'),
('AJF00111231DEP0170', 'AJF00111231', 'DEP01', 1, 'apple pay', '640', '1627986465', '2', '640', '', '', '', '9'),
('AVF96010123DEP0143', 'AVF96010123', 'CAV01', 2, 'una', '1389', '1625863939', '3', '1389', '', '', '', '17'),
('AVF96010123DEP0143', 'AVF96010123', 'DEP01', 2, 'una', '400', '1625863939', '3', '400', '', '', '', '17'),
('AVF96010123DEP0143', 'AVF96010123', 'MDA15', 2, 'una', '400', '1625863939', '3', '400', '', '', '', '17'),
('AVG18102229CG03107', 'AVG18102229', '', 6, 'd', '1782.00', '1629582959', '2', '', 'CG03', '594', '3', '9'),
('AVG18102229FAC2275', 'AVG18102229', '', 6, '', '594.00', '1629437042', '2', '', 'CG03', '594', '1', '9'),
('AVG18102229DEP0174', 'AVG18102229', 'DEP01', 6, '89', '1872', '1629436765', '2', '1872', '', '', '', '9'),
('AVG18102229DEP0173', 'AVG18102229', 'DEP01', 6, '90', '640', '1629436726', '2', '640', '', '', '', '9'),
('AVG18102229FAC2275', 'AVG18102229', 'FAC22', 6, '', '850', '1629437042', '2', '850', '', '', '', '9'),
('DRR97121411DEP0111', 'DRR97121411', 'DEP01', 1, '', '640', '1624882843', '3', '640', '', '', '', '16'),
('JKS21071127DEP01115', 'JKS21071127', '', 4, '82789234', '1400', '1629917408', '3', '', 'JSHAC2', '700.00', '2', '17'),
('JKS21071127DEP01115', 'JKS21071127', '', 4, '82789234', '1465.00', '1629917408', '3', '', 'P48.8', '1465', '1', '17'),
('JKS21071127DEP01115', 'JKS21071127', '', 4, '82789234', '325.00', '1629917408', '3', '', '0SH01', '325', '1', '17'),
('JKS21071127DEP01115', 'JKS21071127', '', 4, '82789234', '720', '1629917408', '3', '', 'PP02', '360', '2', '17'),
('JKS21071127DEP01110', 'JKS21071127', 'CAV01', 4, '99320047', '2000', '1629916991', '3', '2000', '', '', '', '17'),
('JKS21071127DEP01115', 'JKS21071127', 'CAV01', 4, '82789234', '900', '1629917408', '3', '900', '', '', '', '17'),
('JKS21071127DEP01110', 'JKS21071127', 'DEP01', 4, '99320047', '3040', '1629916991', '3', '3040', '', '', '', '17'),
('JKS21071127DEP01115', 'JKS21071127', 'DEP01', 4, '82789234', '4440', '1629917408', '3', '4440', '', '', '', '17'),
('JKS21071127DEP01110', 'JKS21071127', 'FAC17', 4, '99320047', '650', '1629916991', '3', '650', '', '', '', '17'),
('JKS21071127DEP01115', 'JKS21071127', 'FAC18', 4, '82789234', '640', '1629917408', '3', '640', '', '', '', '17'),
('JKS21071127DEP01110', 'JKS21071127', 'MAS36', 4, '99320047', '900', '1629916991', '3', '900', '', '', '', '17'),
('JKS21071127DEP01115', 'JKS21071127', 'RJV03', 4, '82789234', '400', '1629917408', '3', '400', '', '', '', '17'),
('JR2110031CAV014', 'JR2110031', 'CAV01', 2, '', '600', '1623693639', '3', '600', '', '', '', '11'),
('JR2110031DEP012', 'JR2110031', 'DEP01', 1, '', '640', '1623428832', '3', '640', '', '', '', '11'),
('JR2110031DEP013', 'JR2110031', 'DEP01', 1, '', '640', '1623428915', '3', '640', '', '', '', '11'),
('JR2110031CAV014', 'JR2110031', 'DEP01', 2, '', '640', '1623693639', '3', '640', '', '', '', '11'),
('JR2110031DEP0112', 'JR2110031', 'DEP01', 2, '', '640', '1624884399', '3', '640', '', '', '', '11'),
('JR2110031FAC241', 'JR2110031', 'FAC24', 2, '', '850', '1623428698', '3', '850', '', '', '', '11'),
('KPG86080716DEP0113', 'KPG86080716', 'DEP01', 2, '', '960', '1625073503', '3', '960', '', '', '', '16'),
('LG7704198DEP016', 'LG7704198', 'DEP01', 2, '', '1872', '1624882530', '3', '1872', '', '', '', '16'),
('LG7704198DEP0110', 'LG7704198', 'DEP01', 1, '', '1872', '1624882798', '3', '1872', '', '', '', '16'),
('LT04111517DEP0114', 'LT04111517', 'DEP01', 5, '', '1580', '1625149417', '3', '1580', '', '', '', '16'),
('LVG96110722CG03101', 'LVG96110722', '', 1, '', '1188.00', '1629573808', '1', '', 'CG03', '594', '2', '8'),
('LVG96110722MAS4160', 'LVG96110722', '', 6, '00036773x', '20', '1626129539', '1', '', 'hvyf675', '60.00', '3', '8'),
('LVG96110722DEP0156', 'LVG96110722', '', 6, '0001469', '224.00', '1626127755', '1', '', 'hvyf675', '28', '8', '8'),
('LVG96110722FAC2463', 'LVG96110722', '', 3, 'Mag', '310.00', '1626350349', '1', '', 'HJS67', '310', '1', '8'),
('LVG96110722CG03106', 'LVG96110722', '', 6, '', '400.00', '1629582936', '1', '', 'CG03', '200', '2', '8'),
('LVG96110722FAC2078', 'LVG96110722', '', 6, 'zzr75844', '470.00', '1629497357', '1', '', 'xxxx', '470', '1', '8'),
('LVG96110722xxxx86', 'LVG96110722', '', 2, 'sd', '471.00', '1629557102', '1', '', 'xxxx', '471', '1', '8'),
('null', 'LVG96110722', '', 1, 'vvv', '471.00', '1630386780', '1', '', 'xxxx', '471', '1', '8'),
('LVG96110722FAC2051', 'LVG96110722', '', 6, '900089', '650.00', '1626011386', '1', '', 'HJS67', '325', '2', '8'),
('LVG96110722CG03109', 'LVG96110722', '', 2, '41522133', '800.00', '1629583836', '1', '', 'CG03', '200', '4', '8'),
('LVG96110722MAS4049', 'LVG96110722', 'ACN10', 6, '897098796', '700', '1626011332', '1', '700', '', '', '', '8'),
('LVG96110722MAS4160', 'LVG96110722', 'CAV01', 6, '00036773x', '1490', '1626129539', '1', '1490', '', '', '', '8'),
('LVG96110722CAV0177', 'LVG96110722', 'CAV01', 3, '', '200', '1629437822', '1', '200', '', '', '', '8'),
('LVG96110722FAC2463', 'LVG96110722', 'CAV01', 3, 'Mag', '400', '1626350349', '1', '400', '', '', '', '8'),
('LVG96110722CAV0199', 'LVG96110722', 'CAV01', 2, '53xxs62', '500', '1629560273', '1', '500', '', '', '', '8'),
('LVG96110722DEP0181', 'LVG96110722', 'CAV01', 6, '8889', '700', '1629552472', '1', '700', '', '', '', '8'),
('LVG96110722CAV0196', 'LVG96110722', 'CAV01', 6, '899', '800', '1629560130', '1', '800', '', '', '', '8'),
('LVG96110722CAV0197', 'LVG96110722', 'CAV01', 3, '', '900', '1629560154', '1', '900', '', '', '', '8'),
('LVG96110722DEP0181', 'LVG96110722', 'DEP01', 6, '8889', '1264', '1629552472', '1', '1264', '', '', '', '8'),
('LVG96110722FAC2463', 'LVG96110722', 'DEP01', 3, 'Mag', '3040', '1626350349', '1', '3040', '', '', '', '8'),
('LVG96110722DEP0198', 'LVG96110722', 'DEP01', 2, 'dd', '3300', '1629560230', '1', '3300', '', '', '', '8'),
('LVG96110722DEP0156', 'LVG96110722', 'DEP01', 6, '0001469', '3600', '1626127755', '1', '3600', '', '', '', '8'),
('LVG96110722DEP0180', 'LVG96110722', 'DEP01', 6, 'ref30093', '960', '1629552412', '1', '960', '', '', '', '8'),
('LVG96110722DEP0195', 'LVG96110722', 'DEP01', 6, 'd', '960', '1629559987', '1', '960', '', '', '', '8'),
('LVG96110722FAC2051', 'LVG96110722', 'FAC20', 6, '900089', '1800', '1626011386', '1', '1800', '', '', '', '8'),
('LVG96110722FAC2078', 'LVG96110722', 'FAC20', 6, 'zzr75844', '1800', '1629497357', '1', '1800', '', '', '', '8'),
('LVG96110722FAC2463', 'LVG96110722', 'FAC24', 3, 'Mag', '850', '1626350349', '1', '850', '', '', '', '8'),
('LVG96110722FAC2463', 'LVG96110722', 'FAC25', 3, 'Mag', '1100', '1626350349', '1', '1100', '', '', '', '8'),
('LVG96110722DEP0156', 'LVG96110722', 'FD01', 6, '0001469', '400', '1626127755', '1', '400', '', '', '', '8'),
('LVG96110722MAS4049', 'LVG96110722', 'MAS40', 6, '897098796', '150', '1626011332', '1', '150', '', '', '', '8'),
('LVG96110722MAS4160', 'LVG96110722', 'MAS41', 6, '00036773x', '790', '1626129539', '1', '790', '', '', '', '8'),
('MED98022320DEP0115', 'MED98022320', 'DEP01', 1, '', '400', '1625160951', '3', '400', '', '', '', '16'),
('PVR21071629CG03100', 'PVR21071629', '', 2, 'clear', '1188.00', '1629573647', '1', '', 'CG03', '594', '2', '8'),
('PVR21071629CAV01125', 'PVR21071629', '', 3, '472927cju77', '1200.00', '1630395110', '1', '', 'CG03', '200', '5', '8'),
('PVR21071629CAV01125', 'PVR21071629', '', 3, '472927cju77', '1300.00', '1630395110', '1', '', 'HJS67', '325', '4', '8'),
('PVR21071629hvyf67594', 'PVR21071629', '', 5, '', '28.00', '1629558547', '1', '', 'hvyf675', '28', '1', '8'),
('PVR21071629HJS67102', 'PVR21071629', '', 6, '', '325.00', '1629573982', '1', '', 'HJS67', '325', '1', '8'),
('PVR21071629xxxx87', 'PVR21071629', '', 6, 'bartier', '471.00', '1629558229', '1', '', 'xxxx', '471', '1', '8'),
('PVR21071629xxxx87', 'PVR21071629', '', 6, 'bartier', '594.00', '1629558229', '1', '', 'CG03', '594', '1', '8'),
('PVR21071629CG03105', 'PVR21071629', '', 6, 's', '594.00', '1629574108', '1', '', 'CG03', '594', '1', '8'),
('PVR21071629HJS67103', 'PVR21071629', '', 6, '', '650.00', '1629574019', '1', '', 'HJS67', '325', '2', '8'),
('PVR21071629HJS67104', 'PVR21071629', '', 6, 'sds', '650.00', '1629574041', '1', '', 'HJS67', '325', '2', '8'),
('PVR21071629CAV01125', 'PVR21071629', 'CAV01', 3, '472927cju77', '600', '1630395110', '1', '600', '', '', '', '8'),
('PVR21071629DEP01119', 'PVR21071629', 'CAV01', 3, 'Apple Pay', '930', '1630703715', '1', '930', '', '', '', '8'),
('PVR21071629DEP01119', 'PVR21071629', 'DEP01', 3, 'Apple Pay', '2200', '1630703715', '1', '2200', '', '', '', '8'),
('SFL1102129DEP018', 'SFL1102129', '', 1, '', '', '1624882674', '3', '', '', '', '', '16'),
('SFL1102129DEP017', 'SFL1102129', 'DEP01', 1, '', '640', '1624882586', '3', '640', '', '', '', '16'),
('SFL1102129DEP018', 'SFL1102129', 'DEP01', 1, '', '640', '1624882674', '3', '640', '', '', '', '16'),
('VAB91101718MDA1430', 'VAB91101718', '', 4, '', '300.00', '1625243168', '3', '', 'ssdd', '300', '1', '16'),
('VAB91101718FAC2238', 'VAB91101718', '', 3, '', '500.00', '1625475655', '3', '', '123', '500', '1', '17'),
('VAB91101718ACN1133', 'VAB91101718', '', 1, '', '600.00', '1625243967', '3', '', 'ssdd', '300', '2', '16'),
('VAB91101718ACN1028', 'VAB91101718', 'ACN10', 2, '', '700', '1625267926', '3', '700', '', '', '', '16'),
('VAB91101718ACN1133', 'VAB91101718', 'ACN11', 1, '', '400', '1625243967', '3', '400', '', '', '', '16'),
('VAB91101718FAC2238', 'VAB91101718', 'CAV01', 3, '', '22', '1625475655', '3', '22', '', '', '', '17'),
('VAB91101718DEP0116', 'VAB91101718', 'DEP01', 5, '', '0', '1625229927', '3', '0', '', '', '', '11'),
('VAB91101718ACN1133', 'VAB91101718', 'DEP01', 1, '', '2323', '1625243967', '3', '2323', '', '', '', '16'),
('VAB91101718FAC2238', 'VAB91101718', 'FAC22', 3, '', '850', '1625475655', '3', '850', '', '', '', '17'),
('VAB91101718MAS3623', 'VAB91101718', 'MAS36', 1, '', '900', '1625241347', '3', '900', '', '', '', '16'),
('VAB91101718RJV0524', 'VAB91101718', 'MDA13', 1, '', '800', '1625266952', '3', '800', '', '', '', '16'),
('VAB91101718MDA1430', 'VAB91101718', 'MDA14', 4, '', '800', '1625243168', '3', '800', '', '', '', '16'),
('VAB91101718RED2929', 'VAB91101718', 'RED29', 1, '', '300', '1625243040', '3', '300', '', '', '', '16'),
('VAB91101718RJV0524', 'VAB91101718', 'RJV05', 1, '', '1050', '1625266952', '3', '1050', '', '', '', '16');

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
(23, '**TODO EL CUERPO**'),
(24, 'LSMP');

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
  ADD PRIMARY KEY (`id_cliente`,`zona`,`detalle_zona`,`timestamp`);

--
-- Indexes for table `DetallesEdicionVenta`
--
ALTER TABLE `DetallesEdicionVenta`
  ADD PRIMARY KEY (`id_venta`,`timestamp_edicion`);

--
-- Indexes for table `Monedero`
--
ALTER TABLE `Monedero`
  ADD PRIMARY KEY (`id_monedero`);

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`id_producto`,`centro_producto`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
