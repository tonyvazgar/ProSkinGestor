-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2021 at 08:01 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `ClienteOpcional`
--

CREATE TABLE `ClienteOpcional` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp_cliente` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ClienteStatus`
--

CREATE TABLE `ClienteStatus` (
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Table structure for table `CorteDeCaja`
--

CREATE TABLE `CorteDeCaja` (
  `timestamp` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_documento` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cosmetologa` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_centro` varchar(5) COLLATE utf8_bin NOT NULL,
  `total_efectivo` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_ventas_efectivo` int(5) NOT NULL,
  `total_tdc` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_ventas_tdc` int(5) NOT NULL,
  `total_tdd` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_ventas_tdd` int(5) NOT NULL,
  `total_transferencia` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_ventas_transferencia` int(5) NOT NULL,
  `total_deposito` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_ventas_deposito` int(5) NOT NULL,
  `id_corte_caja` varchar(255) COLLATE utf8_bin NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_bin NOT NULL,
  `nombre_archivo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Table structure for table `TratamientoPrecio`
--

CREATE TABLE `TratamientoPrecio` (
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `precio` varchar(255) COLLATE utf8_bin NOT NULL
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
  `status` text COLLATE utf8_bin NOT NULL,
  `id_sucursal_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Ventas`
--

CREATE TABLE `Ventas` (
  `id_venta` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_cliente` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_tratamiento` varchar(255) COLLATE utf8_bin NOT NULL,
  `metodo_pago` varchar(255) COLLATE utf8_bin NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `ZonasCuerpo`
--

CREATE TABLE `ZonasCuerpo` (
  `id_zona` int(3) NOT NULL,
  `nombre_zona` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Indexes for table `CorteDeCaja`
--
ALTER TABLE `CorteDeCaja`
  ADD PRIMARY KEY (`timestamp`,`id_centro`);

--
-- Indexes for table `DetallesEdicionVenta`
--
ALTER TABLE `DetallesEdicionVenta`
  ADD PRIMARY KEY (`id_venta`,`timestamp_edicion`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
