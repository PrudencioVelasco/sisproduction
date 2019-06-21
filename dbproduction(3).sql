-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-06-2019 a las 04:01:05
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbproduction`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `direccionfacturacion` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idcliente`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `rfc`, `nombre`, `abreviatura`, `direccion`, `direccionfacturacion`, `activo`, `idusuario`, `fecha`) VALUES
(1, 'VEPP9004288D4', 'LG MXLI', 'LG', 'Calle Órbita 36, Parque Industrial Mexicali II, 21397, Pimsa II, Mexicali, B.C.', 'Calle Órbita 36, Parque Industrial Mexicali II, 21397, Pimsa II, Mexicali, B.C.', 1, 3, '2019-04-25 15:06:53'),
(2, 'XXXXXXXXXXXXXXXX', '20', '20', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(3, 'XXXXXXXXXXXXXXXX', '53', '53', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(5, 'XXXXXXXXXXXXXXXX', 'ACE', 'ACE', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(6, 'XXXXXXXXXXXXXXXX', 'B', 'B', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(7, 'XXXXXXXXXXXXXXXX', 'BIOPAPEL', 'BIOPAPEL', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(8, 'XXXXXXXXXXXXXXXX', 'B-ROLLER', 'B-ROLLER', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(9, 'XXXXXXXXXXXXXXXX', 'C Y S', 'C Y S', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(10, 'XXXXXXXXXXXXXXXX', 'DDCAM', 'DDCAM', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(11, 'XXXXXXXXXXXXXXXX', 'DELTA', 'DELTA', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(12, 'XXXXXXXXXXXXXXXX', 'EATON', 'EATON', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(13, 'XXXXXXXXXXXXXXXX', 'FEDERICO', 'FEDERICO', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(14, 'XXXXXXXXXXXXXXXX', 'H', 'H', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(15, 'XXXXXXXXXXXXXXXX', 'HANA', 'HANA', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(16, 'XXXXXXXXXXXXXXXX', 'HANIL', 'HANIL', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(17, 'XXXXXXXXXXXXXXXX', 'J.COX', 'J.COX', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(18, 'XXXXXXXXXXXXXXXX', 'JM', 'JM', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(19, 'XXXXXXXXXXXXXXXX', 'KANG SEO', 'KANG SEO', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(20, 'XXXXXXXXXXXXXXXX', 'LG', 'LG', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(21, 'XXXXXXXXXXXXXXXX', 'LG CHICAGO', 'LG CHICAGO', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(22, 'XXXXXXXXXXXXXXXX', 'LGERS', 'LGERS', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(24, 'XXXXXXXXXXXXXXXX', 'LM', 'LM', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(25, 'XXXXXXXXXXXXXXXX', 'LOURDES', 'LOURDES', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(26, 'XXXXXXXXXXXXXXXX', 'OH SUNG', 'OH SUNG', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(28, 'XXXXXXXXXXXXXXXX', 'OH SUNG D', 'OH SUNG D', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(29, 'XXXXXXXXXXXXXXXX', 'OH SUNG E', 'OH SUNG E', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(31, 'XXXXXXXXXXXXXXXX', 'QT', 'QT', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(32, 'XXXXXXXXXXXXXXXX', 'RASTA AFRI', 'RASTA AFRI', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(33, 'XXXXXXXXXXXXXXXX', 'SHAWMUT', 'SHAWMUT', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(34, 'XXXXXXXXXXXXXXXX', 'SKD', 'SKD', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(35, 'XXXXXXXXXXXXXXXX', 'TCL', 'TCL', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(36, 'XXXXXXXXXXXXXXXX', 'TRIMEK', 'TRIMEK', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(37, 'XXXXXXXXXXXXXXXX', 'WISE UNI.INC', 'WISE UNI.INC', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00'),
(38, 'XXXXXXXXXXXXXXXX', 'WOORI USA', 'WOORI USA', 'NO DEFINIDO', '', 1, 3, '2019-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleparte`
--

DROP TABLE IF EXISTS `detalleparte`;
CREATE TABLE IF NOT EXISTS `detalleparte` (
  `iddetalleparte` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `idparte` int(11) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `revision` varchar(120) NOT NULL,
  `pallet` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`iddetalleparte`),
  KEY `idestatus` (`idestatus`),
  KEY `idusuario` (`idusuario`),
  KEY `idparte` (`idparte`),
  KEY `idlinea` (`idlinea`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleparte`
--

INSERT INTO `detalleparte` (`iddetalleparte`, `folio`, `idparte`, `modelo`, `revision`, `pallet`, `cantidad`, `idlinea`, `idestatus`, `idusuario`, `fecharegistro`) VALUES
(81, 81, 3, 'Mode 1', '1', 0, 0, 3, 1, 6, '2019-03-30 18:40:52'),
(82, 82, 5, 'Mode 94', '1', 0, 0, 1, 1, 6, '2019-03-30 18:45:43'),
(83, 83, 3, 'as', 'as', 0, 0, 4, 1, 3, '2019-04-08 08:46:13'),
(84, 84, 231, 'Modelo 4', '1', 0, 0, 3, 1, 3, '2019-04-22 08:15:36'),
(85, 85, 9, 'Model 4', '1', 0, 0, 4, 1, 3, '2019-04-17 12:08:00'),
(86, 86, 230, 'Modelo 4', '1', 0, 0, 2, 1, 3, '2019-04-25 15:38:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallestatus`
--

DROP TABLE IF EXISTS `detallestatus`;
CREATE TABLE IF NOT EXISTS `detallestatus` (
  `iddetallestatus` int(11) NOT NULL AUTO_INCREMENT,
  `iddetalleparte` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `comentariosrechazo` text NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`iddetallestatus`),
  KEY `iddetalleparte` (`iddetalleparte`),
  KEY `idstatus` (`idstatus`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

DROP TABLE IF EXISTS `linea`;
CREATE TABLE IF NOT EXISTS `linea` (
  `idlinea` int(11) NOT NULL AUTO_INCREMENT,
  `nombrelinea` varchar(100) NOT NULL,
  PRIMARY KEY (`idlinea`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`idlinea`, `nombrelinea`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivorechazo`
--

DROP TABLE IF EXISTS `motivorechazo`;
CREATE TABLE IF NOT EXISTS `motivorechazo` (
  `idmotivorechazo` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(250) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idmotivorechazo`),
  KEY `idproceso` (`idproceso`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motivorechazo`
--

INSERT INTO `motivorechazo` (`idmotivorechazo`, `motivo`, `idproceso`, `activo`) VALUES
(1, 'Material mal identificado.', 2, 1),
(2, 'Cantidad de pallet errónea.', 2, 1),
(3, 'Material en mal estado.', 2, 1),
(4, 'Mal entarimado/flejado.', 2, 1),
(5, 'Hoja de transferencia mal elaborada,(consecutivo)', 2, 1),
(6, 'Producto no conforme.', 2, 1),
(7, 'No tiene hoja de transferencia.', 2, 1),
(8, 'Personal que selle y firme de liberado.', 2, 1),
(9, 'No liberado por calidad.', 3, 1),
(10, 'Cantidad incorrecta.', 3, 1),
(11, 'Mal identificado.', 3, 1),
(12, 'Estibamiento incorrecto vs spec de empaque.', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordensalida`
--

DROP TABLE IF EXISTS `ordensalida`;
CREATE TABLE IF NOT EXISTS `ordensalida` (
  `idordensalida` int(11) NOT NULL AUTO_INCREMENT,
  `idsalida` int(11) NOT NULL,
  `idpalletcajas` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `pallet` int(11) NOT NULL,
  `caja` int(11) NOT NULL,
  `revision` varchar(20) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idordensalida`),
  KEY `idsalida` (`idsalida`),
  KEY `idparte` (`idpalletcajas`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palletcajas`
--

DROP TABLE IF EXISTS `palletcajas`;
CREATE TABLE IF NOT EXISTS `palletcajas` (
  `idpalletcajas` int(11) NOT NULL AUTO_INCREMENT,
  `idtransferancia` int(11) NOT NULL,
  `pallet` int(11) NOT NULL,
  `idcajas` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idpalletcajas`),
  KEY `iddetalleparte` (`idtransferancia`),
  KEY `idestatus` (`idestatus`),
  KEY `idusuario` (`idusuario`),
  KEY `idcajas` (`idcajas`),
  KEY `idcajas_2` (`idcajas`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palletcajas`
--

INSERT INTO `palletcajas` (`idpalletcajas`, `idtransferancia`, `pallet`, `idcajas`, `idestatus`, `idusuario`, `fecharegistro`) VALUES
(144, 1, 1, 1, 3, 3, '2019-06-20 16:48:27'),
(145, 1, 1, 1, 3, 3, '2019-06-20 16:48:59'),
(146, 1, 1, 2, 3, 3, '2019-06-20 16:48:59'),
(147, 1, 1, 1, 12, 3, '2019-06-20 16:46:30'),
(148, 1, 1, 1, 12, 3, '2019-06-20 16:46:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palletcajasestatus`
--

DROP TABLE IF EXISTS `palletcajasestatus`;
CREATE TABLE IF NOT EXISTS `palletcajasestatus` (
  `idpalletcajasestatus` int(11) NOT NULL AUTO_INCREMENT,
  `idpalletcajas` int(11) NOT NULL,
  `idmotivorechazo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  KEY `idpalletcajasestatus` (`idpalletcajasestatus`),
  KEY `idmotivorechazo` (`idmotivorechazo`),
  KEY `idpalletcajas` (`idpalletcajas`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palletcajasestatus`
--

INSERT INTO `palletcajasestatus` (`idpalletcajasestatus`, `idpalletcajas`, `idmotivorechazo`, `idusuario`, `fecharegistro`) VALUES
(8, 144, 2, 3, '2019-06-20 00:00:00'),
(9, 144, 5, 3, '2019-06-20 16:48:24'),
(10, 144, 5, 3, '2019-06-20 16:48:26'),
(11, 144, 5, 3, '2019-06-20 16:48:27'),
(12, 145, 3, 3, '2019-06-20 16:48:59'),
(13, 146, 3, 3, '2019-06-20 16:48:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palletcajasproceso`
--

DROP TABLE IF EXISTS `palletcajasproceso`;
CREATE TABLE IF NOT EXISTS `palletcajasproceso` (
  `idpalletcajasproceso` int(11) NOT NULL AUTO_INCREMENT,
  `idpalletcajas` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idpalletcajasproceso`),
  KEY `idestatus` (`idestatus`),
  KEY `idpalletcajas` (`idpalletcajas`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palletcajasproceso`
--

INSERT INTO `palletcajasproceso` (`idpalletcajasproceso`, `idpalletcajas`, `idestatus`, `idusuario`, `fecharegistro`) VALUES
(79, 144, 1, 3, '2019-06-20 12:05:59'),
(80, 145, 17, 3, '2019-06-20 12:09:48'),
(81, 144, 17, 3, '2019-06-20 12:11:42'),
(82, 144, 17, 3, '2019-06-20 12:12:28'),
(83, 144, 1, 3, '2019-06-20 16:30:49'),
(84, 144, 1, 3, '2019-06-20 16:31:53'),
(85, 144, 12, 3, '2019-06-20 16:32:23'),
(86, 145, 12, 3, '2019-06-20 16:32:23'),
(87, 147, 12, 3, '2019-06-20 16:46:30'),
(88, 148, 12, 3, '2019-06-20 16:46:30'),
(89, 144, 3, 3, '2019-06-20 16:48:24'),
(90, 144, 3, 3, '2019-06-20 16:48:26'),
(91, 144, 3, 3, '2019-06-20 16:48:27'),
(92, 145, 3, 3, '2019-06-20 16:48:59'),
(93, 146, 3, 3, '2019-06-20 16:48:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parte`
--

DROP TABLE IF EXISTS `parte`;
CREATE TABLE IF NOT EXISTS `parte` (
  `idparte` int(11) NOT NULL AUTO_INCREMENT,
  `numeroparte` varchar(200) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fecharegistro` datetime DEFAULT NULL,
  PRIMARY KEY (`idparte`),
  KEY `idcliente` (`idcliente`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=385 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parte`
--

INSERT INTO `parte` (`idparte`, `numeroparte`, `idcliente`, `idusuario`, `activo`, `fecharegistro`) VALUES
(3, 'EC-CD-8100', 1, 3, 1, '2019-04-10 00:00:00'),
(4, 'MOD-TEST-28', 1, 6, 1, '2019-04-10 00:00:00'),
(5, 'TEST-MOD-1', 1, 3, 1, '2019-04-10 00:00:00'),
(6, 'MAY67613402', 1, 3, 1, '2019-04-10 00:00:00'),
(7, 'MAY66148402', 1, 3, 1, '2019-04-10 00:00:00'),
(8, 'MAY67431203', 1, 3, 1, '2019-04-10 00:00:00'),
(9, 'MAY67028601', 1, 3, 1, '2019-04-10 00:00:00'),
(10, 'MAY67855402', 1, 3, 1, '2019-04-10 00:00:00'),
(11, 'MAY67578801', 1, 3, 1, '2019-04-10 00:00:00'),
(12, 'TALL 5', 7, 3, 1, '2019-04-10 00:00:00'),
(13, 'TALLA-5', 7, 3, 1, '2019-04-10 00:00:00'),
(14, 'MAY67459101', 1, 3, 1, '2019-04-10 00:00:00'),
(15, 'MAY67431603', 1, 3, 1, '2019-04-10 00:00:00'),
(16, 'MAY67431501', 1, 3, 1, '2019-04-10 00:00:00'),
(17, 'DEDC280D4', 10, 3, 1, '2019-04-10 00:00:00'),
(18, 'MAY67328803', 1, 3, 1, '2019-04-10 00:00:00'),
(19, 'MAY67429302', 1, 3, 1, '2019-04-10 00:00:00'),
(20, 'MAY67456601', 1, 3, 1, '2019-04-10 00:00:00'),
(21, 'DEDE281D4', 10, 3, 1, '2019-04-10 00:00:00'),
(22, 'MAY67272003', 1, 3, 1, '2019-04-10 00:00:00'),
(23, 'DEDE400D4', 10, 3, 1, '2019-04-10 00:00:00'),
(24, 'MAY67089302', 1, 3, 1, '2019-04-10 00:00:00'),
(25, 'MAY67450501', 1, 3, 1, '2019-04-10 00:00:00'),
(26, 'MAY67654302', 1, 3, 1, '2019-04-10 00:00:00'),
(27, 'MAY67476301', 1, 3, 1, '2019-04-10 00:00:00'),
(28, 'MAY67577101', 1, 3, 1, '2019-04-10 00:00:00'),
(29, 'MAY67895502', 1, 3, 1, '2019-04-10 00:00:00'),
(30, 'MAY65831601', 1, 3, 1, '2019-04-10 00:00:00'),
(31, 'MAY67891601', 1, 3, 1, '2019-04-10 00:00:00'),
(32, 'MAY67868201', 1, 3, 1, '2019-04-10 00:00:00'),
(33, 'MAY67830403', 1, 3, 1, '2019-04-10 00:00:00'),
(34, 'OFD-0105B', 26, 3, 1, '2019-04-10 00:00:00'),
(35, 'MAY67582202', 1, 3, 1, '2019-04-10 00:00:00'),
(36, 'JCSB 543A', 17, 3, 1, '2019-04-10 00:00:00'),
(37, 'MAY67127901', 1, 3, 1, '2019-04-10 00:00:00'),
(38, 'MAY67413701', 1, 3, 1, '2019-04-10 00:00:00'),
(39, '49 INCH-PAD', 17, 3, 1, '2019-04-10 00:00:00'),
(40, 'MAY67098302', 1, 3, 1, '2019-04-10 00:00:00'),
(41, 'MAY67852909', 1, 3, 1, '2019-04-10 00:00:00'),
(42, 'MAY67431201', 1, 3, 1, '2019-04-10 00:00:00'),
(43, 'MAY67478804', 1, 3, 1, '2019-04-10 00:00:00'),
(44, 'MAY66389502', 1, 3, 1, '2019-04-10 00:00:00'),
(45, 'PAD-ALEN', 7, 3, 1, '2019-04-10 00:00:00'),
(46, 'MAY67675302', 1, 3, 1, '2019-04-10 00:00:00'),
(47, 'MAY67089202', 1, 3, 1, '2019-04-10 00:00:00'),
(48, 'MAY67450503', 1, 3, 1, '2019-04-10 00:00:00'),
(49, 'MAY67476308', 1, 3, 1, '2019-04-10 00:00:00'),
(50, 'MAY67549501', 1, 3, 1, '2019-04-10 00:00:00'),
(51, 'MAY67431601', 1, 3, 1, '2019-04-10 00:00:00'),
(52, 'MAY67669604', 1, 3, 1, '2019-04-10 00:00:00'),
(53, 'MAY67098301', 1, 3, 1, '2019-04-10 00:00:00'),
(54, 'BX-HD-DBLW', 31, 3, 1, '2019-04-10 00:00:00'),
(55, 'MAY67530901', 1, 3, 1, '2019-04-10 00:00:00'),
(56, 'MAY67509701', 1, 3, 1, '2019-04-10 00:00:00'),
(57, 'SI32-13082-002G-JVC', 11, 3, 1, '2019-04-10 00:00:00'),
(58, 'PAD-ALEN-B', 7, 3, 1, '2019-04-10 00:00:00'),
(59, 'MAY67713007', 1, 3, 1, '2019-04-10 00:00:00'),
(60, 'MAY67713004', 1, 3, 1, '2019-04-10 00:00:00'),
(61, 'KANG SEO', 19, 3, 1, '2019-04-10 00:00:00'),
(62, 'MAY67858401', 1, 3, 1, '2019-04-10 00:00:00'),
(63, 'MAY67478803', 1, 3, 1, '2019-04-10 00:00:00'),
(64, 'A10-5GTA-132082-002G-ATV', 11, 3, 1, '2019-04-10 00:00:00'),
(65, 'GTA-132082-002G-ATV', 11, 3, 1, '2019-04-10 00:00:00'),
(66, 'MAY66249703', 1, 3, 1, '2019-04-10 00:00:00'),
(67, 'MAY67429501', 1, 3, 1, '2019-04-10 00:00:00'),
(68, 'MAY68049101', 1, 3, 1, '2019-04-10 00:00:00'),
(69, 'MAY67909601', 1, 3, 1, '2019-04-10 00:00:00'),
(70, 'MAY67868202', 1, 3, 1, '2019-04-10 00:00:00'),
(71, 'MAY67431703', 1, 3, 1, '2019-04-10 00:00:00'),
(72, 'MFZ55267508', 1, 3, 1, '2019-04-10 00:00:00'),
(73, 'MFZ55267510', 1, 3, 1, '2019-04-10 00:00:00'),
(74, 'MFZ55267507', 1, 3, 1, '2019-04-10 00:00:00'),
(75, 'MFZ55267505', 1, 3, 1, '2019-04-10 00:00:00'),
(76, 'MFZ55267506', 1, 3, 1, '2019-04-10 00:00:00'),
(77, 'MFZ55267509', 1, 3, 1, '2019-04-10 00:00:00'),
(78, 'MAY66174202', 1, 3, 1, '2019-04-10 00:00:00'),
(79, 'MAY65725401', 1, 3, 1, '2019-04-10 00:00:00'),
(80, 'MAY67675303', 1, 3, 1, '2019-04-10 00:00:00'),
(81, 'MAY67414601', 1, 3, 1, '2019-04-10 00:00:00'),
(82, 'MAY67456801', 1, 3, 1, '2019-04-10 00:00:00'),
(83, 'JVC 43', 11, 3, 1, '2019-04-10 00:00:00'),
(84, 'MAY67868305', 1, 3, 1, '2019-04-10 00:00:00'),
(85, 'MAY67560301', 1, 3, 1, '2019-04-10 00:00:00'),
(86, 'MAY67695801', 1, 3, 1, '2019-04-10 00:00:00'),
(87, 'MAY67858501', 1, 3, 1, '2019-04-10 00:00:00'),
(88, 'MAY68288101', 1, 3, 1, '2019-04-10 00:00:00'),
(89, 'MAY68292201', 1, 3, 1, '2019-04-10 00:00:00'),
(90, 'MAY67654301', 1, 3, 1, '2019-04-10 00:00:00'),
(91, 'MAY67672020', 1, 3, 1, '2019-04-10 00:00:00'),
(92, 'MAY68270505', 1, 3, 1, '2019-04-10 00:00:00'),
(93, 'MAY68290101', 1, 3, 1, '2019-04-10 00:00:00'),
(94, '200-SI24J-02G-JVC', 16, 3, 1, '2019-04-10 00:00:00'),
(95, '100018(ALP3)', 33, 3, 1, '2019-04-10 00:00:00'),
(96, '100093(ALP3)', 33, 3, 1, '2019-04-10 00:00:00'),
(97, '100-SI39-13282-JVC', 16, 3, 1, '2019-04-10 00:00:00'),
(98, 'MAY68292301', 1, 3, 1, '2019-04-10 00:00:00'),
(99, 'MAY68292401', 1, 3, 1, '2019-04-10 00:00:00'),
(100, 'ALP 2', 33, 3, 1, '2019-04-10 00:00:00'),
(101, '32-00002-0277-025', 7, 3, 1, '2019-04-10 00:00:00'),
(102, '100-32SM-13282-ATV', 16, 3, 1, '2019-04-10 00:00:00'),
(103, 'F534808900', 36, 3, 1, '2019-04-10 00:00:00'),
(104, '32-0004-502-097', 7, 3, 1, '2019-04-10 00:00:00'),
(105, '32-0004-0502-097', 7, 3, 1, '2019-04-10 00:00:00'),
(106, '32-0004-0496-097', 7, 3, 1, '2019-04-10 00:00:00'),
(107, '32-0004-0497-097', 7, 3, 1, '2019-04-10 00:00:00'),
(108, '200-32CT-200G-ATV', 16, 3, 1, '2019-04-10 00:00:00'),
(109, '100-32SP-13282-SP', 16, 3, 1, '2019-04-10 00:00:00'),
(110, '200-SI32T-02G-JVC', 16, 3, 1, '2019-04-10 00:00:00'),
(111, 'MAY68288102', 1, 3, 1, '2019-04-10 00:00:00'),
(112, 'MZ55267510', 1, 3, 1, '2019-04-10 00:00:00'),
(113, '100-32SM-13282SP', 16, 3, 1, '2019-04-10 00:00:00'),
(114, '200-ATV24J-02G-ATV', 16, 3, 1, '2019-04-10 00:00:00'),
(115, 'A10-5H05-121387-001G-SI', 16, 3, 1, '2019-04-10 00:00:00'),
(116, 'A10-5H05-12387-001G-SI', 16, 3, 1, '2019-04-10 00:00:00'),
(117, 'ALP 1', 33, 3, 1, '2019-04-10 00:00:00'),
(118, 'MAY67749501', 1, 3, 1, '2019-04-10 00:00:00'),
(119, 'HANA', 15, 3, 1, '2019-04-10 00:00:00'),
(120, 'MAY67969802', 1, 3, 1, '2019-04-10 00:00:00'),
(121, 'MAY68270502', 1, 3, 1, '2019-04-10 00:00:00'),
(122, 'MAY68290201', 1, 3, 1, '2019-04-10 00:00:00'),
(123, 'TALLA-3', 7, 3, 1, '2019-04-10 00:00:00'),
(124, 'ETN-16', 12, 3, 1, '2019-04-10 00:00:00'),
(125, 'ETN-18', 12, 3, 1, '2019-04-10 00:00:00'),
(126, 'JCBC949A', 17, 3, 1, '2019-04-10 00:00:00'),
(127, 'ACE BOX 16', 5, 3, 1, '2019-04-10 00:00:00'),
(128, 'ALP 1®', 33, 3, 1, '2019-04-10 00:00:00'),
(129, 'SMALL BOX', 5, 3, 1, '2019-04-10 00:00:00'),
(130, 'BIG BOX', 5, 3, 1, '2019-04-10 00:00:00'),
(131, '32-00002-0277', 7, 3, 1, '2019-04-10 00:00:00'),
(132, 'MAY67900301', 1, 3, 1, '2019-04-10 00:00:00'),
(133, 'MAY67478801', 1, 3, 1, '2019-04-10 00:00:00'),
(134, 'JM-PAD-MEDIANA', 18, 3, 1, '2019-04-10 00:00:00'),
(135, 'BOX-DOUBLE RNG61', 19, 3, 1, '2019-04-10 00:00:00'),
(136, 'F534-8089-00', 36, 3, 1, '2019-04-10 00:00:00'),
(137, 'BOX', 8, 3, 1, '2019-04-10 00:00:00'),
(138, '267780', 8, 3, 1, '2019-04-10 00:00:00'),
(139, 'BX-15*15*10', 8, 3, 1, '2019-04-10 00:00:00'),
(140, 'RASTAFRI', 10, 3, 1, '2019-04-10 00:00:00'),
(141, 'RASTAFRI(SEPARADOR)', 10, 3, 1, '2019-04-10 00:00:00'),
(142, 'MAY67833601', 1, 3, 1, '2019-04-10 00:00:00'),
(143, '372-843A', 17, 3, 1, '2019-04-10 00:00:00'),
(144, '200-ATV24J-03G-ATV', 16, 3, 1, '2019-04-10 00:00:00'),
(145, 'PAD 624*424', 5, 3, 1, '2019-04-10 00:00:00'),
(146, '24 13/16 *16 15/16 *12 5/8', 5, 3, 1, '2019-04-10 00:00:00'),
(147, 'PAD-403*313', 5, 3, 1, '2019-04-10 00:00:00'),
(148, 'PTJOO-54020', 25, 3, 1, '2019-04-10 00:00:00'),
(149, 'OFD-310*470', 26, 3, 1, '2019-04-10 00:00:00'),
(150, 'RASTAFRI BOX', 10, 3, 1, '2019-04-10 00:00:00'),
(151, '100025(ALP 1)', 33, 3, 1, '2019-04-10 00:00:00'),
(152, '200-SI55J-02G-JVC', 16, 3, 1, '2019-04-10 00:00:00'),
(153, 'KS PAD (SEPARADOR)', 19, 3, 1, '2019-04-10 00:00:00'),
(154, 'MAY67713002', 1, 3, 1, '2019-04-10 00:00:00'),
(155, 'MAY66270002', 1, 3, 1, '2019-04-10 00:00:00'),
(156, 'MAY68351001', 1, 3, 1, '2019-04-10 00:00:00'),
(157, 'OHD-0227A', 26, 3, 1, '2019-04-10 00:00:00'),
(158, 'MAY67713005', 1, 3, 1, '2019-04-10 00:00:00'),
(159, 'RASTAFRI SEPARADOR', 10, 3, 1, '2019-04-10 00:00:00'),
(160, 'MAY65776403', 1, 3, 1, '2019-04-10 00:00:00'),
(161, 'MAY68452301', 1, 3, 1, '2019-04-10 00:00:00'),
(162, 'MAY68453701', 1, 3, 1, '2019-04-10 00:00:00'),
(163, 'MAY68452601', 1, 3, 1, '2019-04-10 00:00:00'),
(164, 'MAY68493402', 1, 3, 1, '2019-04-10 00:00:00'),
(165, 'MAY68452302', 1, 3, 1, '2019-04-10 00:00:00'),
(166, 'MAY68494701', 1, 3, 1, '2019-04-10 00:00:00'),
(167, 'MAY68494601', 1, 3, 1, '2019-04-10 00:00:00'),
(168, 'MAY68509101', 1, 3, 1, '2019-04-10 00:00:00'),
(169, 'MAY68452402', 1, 3, 1, '2019-04-10 00:00:00'),
(170, 'MAY68452401', 1, 3, 1, '2019-04-10 00:00:00'),
(171, 'MAY68488501', 1, 3, 1, '2019-04-10 00:00:00'),
(172, 'MAY68497101', 1, 3, 1, '2019-04-10 00:00:00'),
(173, 'MAY68493401', 1, 3, 1, '2019-04-10 00:00:00'),
(174, 'MAY68509301', 1, 3, 1, '2019-04-10 00:00:00'),
(175, 'MAY68452602', 1, 3, 1, '2019-04-10 00:00:00'),
(176, 'MAY6849004', 1, 3, 1, '2019-04-10 00:00:00'),
(177, 'MAY68459201', 1, 3, 1, '2019-04-10 00:00:00'),
(178, 'MAY68490004', 1, 3, 1, '2019-04-10 00:00:00'),
(179, 'MAY68496601', 1, 3, 1, '2019-04-10 00:00:00'),
(180, 'MAY68493603', 1, 3, 1, '2019-04-10 00:00:00'),
(181, 'MAY68529601', 1, 3, 1, '2019-04-10 00:00:00'),
(182, 'MAY67712403', 1, 3, 1, '2019-04-10 00:00:00'),
(183, 'MAY68448404', 1, 3, 1, '2019-04-10 00:00:00'),
(184, 'MAY67413702', 1, 3, 1, '2019-04-10 00:00:00'),
(185, 'MAY68522701', 1, 3, 1, '2019-04-10 00:00:00'),
(186, '200-32-HSDP-0104', 16, 3, 1, '2019-04-10 00:00:00'),
(187, 'Z827151-1', 33, 3, 1, '2019-04-10 00:00:00'),
(188, 'JCOX-580*950', 17, 3, 1, '2019-04-10 00:00:00'),
(189, 'MAY68272606', 1, 3, 1, '2019-04-10 00:00:00'),
(190, 'MAY68028001', 1, 3, 1, '2019-04-10 00:00:00'),
(191, 'MAY68468603', 1, 3, 1, '2019-04-10 00:00:00'),
(192, 'MAY68470105', 1, 3, 1, '2019-04-10 00:00:00'),
(193, 'MAY68464401', 1, 3, 1, '2019-04-10 00:00:00'),
(194, 'MAY68467903', 1, 3, 1, '2019-04-10 00:00:00'),
(195, 'MAY68520601', 1, 3, 1, '2019-04-10 00:00:00'),
(196, 'MAY68522801', 1, 3, 1, '2019-04-10 00:00:00'),
(197, 'MAY68451704', 1, 3, 1, '2019-04-10 00:00:00'),
(198, 'MAY68451702', 1, 3, 1, '2019-04-10 00:00:00'),
(199, 'MAY68488703', 1, 3, 1, '2019-04-10 00:00:00'),
(200, 'MAY68504201', 1, 3, 1, '2019-04-10 00:00:00'),
(201, 'MAY68273502', 1, 3, 1, '2019-04-10 00:00:00'),
(202, 'MAY68273501', 1, 3, 1, '2019-04-10 00:00:00'),
(203, 'MAY68512701', 1, 3, 1, '2019-04-10 00:00:00'),
(204, 'MAY68451703', 1, 3, 1, '2019-04-10 00:00:00'),
(205, 'MAY66990603', 1, 3, 1, '2019-04-10 00:00:00'),
(206, 'MAY68520603', 1, 3, 1, '2019-04-10 00:00:00'),
(207, 'MAY68520602', 1, 3, 1, '2019-04-10 00:00:00'),
(208, 'MAY68589801', 1, 3, 1, '2019-04-10 00:00:00'),
(209, 'AGF79482701', 1, 3, 1, '2019-04-10 00:00:00'),
(210, 'AGF79482702', 1, 3, 1, '2019-04-10 00:00:00'),
(211, 'PK520074ML', 12, 3, 1, '2019-04-10 00:00:00'),
(212, 'S44-110-ET-S', 12, 3, 1, '2019-04-10 00:00:00'),
(213, 'OFD-0104 c(n)', 29, 3, 1, '2019-04-10 00:00:00'),
(214, 'OFD-0104 C', 26, 3, 1, '2019-04-10 00:00:00'),
(215, 'OHD-0086Z F', 26, 3, 1, '2019-04-10 00:00:00'),
(216, 'OHD-0086 F', 26, 3, 1, '2019-04-10 00:00:00'),
(217, 'TRIPTICO CHICO', 9, 3, 1, '2019-04-10 00:00:00'),
(218, 'sw71-111-cs-c', 9, 3, 1, '2019-04-10 00:00:00'),
(219, '100025(ALP 1A)', 33, 3, 1, '2019-04-10 00:00:00'),
(220, 'JCB 843A', 17, 3, 1, '2019-04-10 00:00:00'),
(221, 'TRIPTICO 36*48 PAD', 9, 3, 1, '2019-04-10 00:00:00'),
(222, 'TRIPTICO ', 9, 3, 1, '2019-04-10 00:00:00'),
(223, 'N001001404', 1, 3, 1, '2019-04-10 00:00:00'),
(224, 'N001001405', 1, 3, 1, '2019-04-10 00:00:00'),
(225, 'PK520073 ML', 12, 3, 1, '2019-04-10 00:00:00'),
(226, 'MAY68503702', 1, 3, 1, '2019-04-10 00:00:00'),
(227, 'SVS20032CT002GATV', 35, 3, 1, '2019-04-10 00:00:00'),
(228, 'SEPARADOR 1', 26, 3, 1, '2019-04-10 00:00:00'),
(229, 'SEPARADOR 2', 28, 3, 1, '2019-04-10 00:00:00'),
(230, 'GPS-0077 D', 38, 3, 1, '2019-04-10 00:00:00'),
(231, 'GPS-0078-3', 38, 3, 1, '2019-04-10 00:00:00'),
(232, 'GPS-0077-3', 38, 3, 1, '2019-04-10 00:00:00'),
(233, '100018(ALP 1)', 33, 3, 1, '2019-04-10 00:00:00'),
(234, 'SVS200SI32J02GJVC', 35, 3, 1, '2019-04-10 00:00:00'),
(235, 'MAY68635601', 1, 3, 1, '2019-04-10 00:00:00'),
(236, 'MAY68631101', 1, 3, 1, '2019-04-10 00:00:00'),
(237, 'MAY68650601', 1, 3, 1, '2019-04-10 00:00:00'),
(238, 'SVS200ATV24J02GATV', 35, 3, 1, '2019-04-10 00:00:00'),
(239, '200SI49F-02G-JVC', 34, 3, 1, '2019-04-10 00:00:00'),
(240, 'MAY68649204', 1, 3, 1, '2019-04-10 00:00:00'),
(241, 'MAY68631301', 1, 3, 1, '2019-04-10 00:00:00'),
(242, 'MAY68589901', 1, 3, 1, '2019-04-10 00:00:00'),
(243, '100-32SM-13301-SP', 35, 3, 1, '2019-04-10 00:00:00'),
(244, 'SVS20032HSDP0104', 35, 3, 1, '2019-04-10 00:00:00'),
(245, 'MAY68667601', 1, 3, 1, '2019-04-10 00:00:00'),
(246, 'MAY68631501', 1, 3, 1, '2019-04-10 00:00:00'),
(247, 'CAJA TIPO MRSC ', 28, 3, 1, '2019-04-10 00:00:00'),
(248, 'MAY68608102', 1, 3, 1, '2019-04-10 00:00:00'),
(249, 'MAY68608101', 1, 3, 1, '2019-04-10 00:00:00'),
(250, 'MAY68748701', 1, 3, 1, '2019-04-10 00:00:00'),
(251, 'MAY68459202', 1, 3, 1, '2019-04-10 00:00:00'),
(252, 'MAY68808201', 1, 3, 1, '2019-04-10 00:00:00'),
(253, 'MAY67897001', 1, 3, 1, '2019-04-10 00:00:00'),
(254, 'MAY67852904', 1, 3, 1, '2019-04-10 00:00:00'),
(255, 'MAY67868203', 1, 3, 1, '2019-04-10 00:00:00'),
(256, 'MAY67747901', 1, 3, 1, '2019-04-10 00:00:00'),
(257, 'MAY67747701', 1, 3, 1, '2019-04-10 00:00:00'),
(258, 'MAY67714201', 1, 3, 1, '2019-04-10 00:00:00'),
(259, 'MAY66269802', 1, 3, 1, '2019-04-10 00:00:00'),
(260, 'MAY67891701', 1, 3, 1, '2019-04-10 00:00:00'),
(261, 'MAY67509601', 1, 3, 1, '2019-04-10 00:00:00'),
(262, 'MAY67272020', 1, 3, 1, '2019-04-10 00:00:00'),
(263, 'MAY67848601', 1, 3, 1, '2019-04-10 00:00:00'),
(264, 'MAY67893801', 1, 3, 1, '2019-04-10 00:00:00'),
(265, 'OFD-0104Z', 26, 3, 1, '2019-04-10 00:00:00'),
(266, 'MAY67675301', 1, 3, 1, '2019-04-10 00:00:00'),
(267, 'MAY67899401', 1, 3, 1, '2019-04-10 00:00:00'),
(268, 'MAY67748001', 1, 3, 1, '2019-04-10 00:00:00'),
(269, 'MAY67894402', 1, 3, 1, '2019-04-10 00:00:00'),
(270, 'MAY67852902', 1, 3, 1, '2019-04-10 00:00:00'),
(271, 'MAY67414602', 1, 3, 1, '2019-04-10 00:00:00'),
(272, 'MAY67713006', 1, 3, 1, '2019-04-10 00:00:00'),
(273, 'MAY67870102', 1, 3, 1, '2019-04-10 00:00:00'),
(274, 'MAY67788401', 1, 3, 1, '2019-04-10 00:00:00'),
(275, 'MAY67875301', 1, 3, 1, '2019-04-10 00:00:00'),
(276, 'prueba', 1, 3, 1, '2019-04-10 00:00:00'),
(277, 'MAY67900401', 1, 3, 1, '2019-04-10 00:00:00'),
(278, 'MAY68496101', 1, 3, 1, '2019-04-10 00:00:00'),
(279, 'MAY68635802', 1, 3, 1, '2019-04-10 00:00:00'),
(280, 'MAY68748501B', 22, 3, 1, '2019-04-10 00:00:00'),
(281, 'MAY67712303', 1, 3, 1, '2019-04-10 00:00:00'),
(282, 'PK514056EN', 12, 3, 1, '2019-04-10 00:00:00'),
(283, 'PK517053EN', 12, 3, 1, '2019-04-10 00:00:00'),
(284, 'PK514049EN', 12, 3, 1, '2019-04-10 00:00:00'),
(285, '76-58-1050-OAT1B', 35, 3, 1, '2019-04-10 00:00:00'),
(286, 'ATV-32SM-76-581050', 35, 3, 1, '2019-04-10 00:00:00'),
(287, 'MAY67862202', 1, 3, 1, '2019-04-10 00:00:00'),
(288, 'AGF79482745', 1, 3, 1, '2019-04-10 00:00:00'),
(289, 'PK517022EN', 12, 3, 1, '2019-04-10 00:00:00'),
(290, 'AGF79482744', 1, 3, 1, '2019-04-10 00:00:00'),
(291, 'MAY68530401', 1, 3, 1, '2019-04-10 00:00:00'),
(292, 'AGF79482743', 1, 3, 1, '2019-04-10 00:00:00'),
(293, 'PK518795ML', 12, 3, 1, '2019-04-10 00:00:00'),
(294, 'AGF79482747', 1, 3, 1, '2019-04-10 00:00:00'),
(295, 'MAY67210001', 1, 3, 1, '2019-04-10 00:00:00'),
(296, 'MAY68650502', 1, 3, 1, '2019-04-10 00:00:00'),
(297, 'SQY-SI40FS-02G-JVC', 34, 3, 1, '2019-04-10 00:00:00'),
(298, 'PK517021EN', 12, 3, 1, '2019-04-10 00:00:00'),
(299, 'PK526434MLCTN', 12, 3, 1, '2019-04-10 00:00:00'),
(300, 'PALLET COVER TOP', 21, 3, 1, '2019-04-10 00:00:00'),
(301, 'MDQ65896701-#1', 21, 3, 1, '2019-04-10 00:00:00'),
(302, 'CLP0011150I', 12, 3, 1, '2019-04-10 00:00:00'),
(303, 'wow meats box', 37, 3, 1, '2019-04-10 00:00:00'),
(304, 'CAJA TIPO MRSC (RSC)', 28, 3, 1, '2019-04-10 00:00:00'),
(305, 'PAD-325*510', 19, 3, 1, '2019-04-10 00:00:00'),
(306, 'JVC-32 ', 11, 3, 1, '2019-04-10 00:00:00'),
(307, 'PK517077ML', 12, 3, 1, '2019-04-10 00:00:00'),
(308, 'BOX 305*190*160', 15, 3, 1, '2019-04-10 00:00:00'),
(309, 'MAY69351001', 1, 3, 1, '2019-04-10 00:00:00'),
(310, 'MAY69370001', 1, 3, 1, '2019-04-10 00:00:00'),
(311, 'MAY69351301', 1, 3, 1, '2019-04-10 00:00:00'),
(312, 'MAY69329102', 1, 3, 1, '2019-04-10 00:00:00'),
(313, 'MAY69328502', 1, 3, 1, '2019-04-10 00:00:00'),
(314, 'MAY69313201', 1, 3, 1, '2019-04-10 00:00:00'),
(315, 'MAY69313101', 1, 3, 1, '2019-04-10 00:00:00'),
(316, 'MAY69351901', 1, 3, 1, '2019-04-10 00:00:00'),
(317, 'PK514042EN', 12, 3, 1, '2019-04-10 00:00:00'),
(318, 'MAY69375504', 1, 3, 1, '2019-04-10 00:00:00'),
(319, '32D1200(HKP)', 35, 3, 1, '2019-04-10 00:00:00'),
(320, 'ANTIDOTO 24OZ', 13, 3, 1, '2019-04-10 00:00:00'),
(321, 'MAY69329101', 1, 3, 1, '2019-04-10 00:00:00'),
(322, 'MAY67711802', 1, 3, 1, '2019-04-10 00:00:00'),
(323, 'PK526329ML', 12, 3, 1, '2019-04-10 00:00:00'),
(324, 'PK514026EN', 12, 3, 1, '2019-04-10 00:00:00'),
(325, 'MAY69329003', 1, 3, 1, '2019-04-10 00:00:00'),
(326, 'MAY67289002', 1, 3, 1, '2019-04-10 00:00:00'),
(327, 'MAY69329002', 1, 3, 1, '2019-04-10 00:00:00'),
(328, 'MAY69353601', 1, 3, 1, '2019-04-10 00:00:00'),
(329, 'MAY69373701', 1, 3, 1, '2019-04-10 00:00:00'),
(330, 'MAY69318901', 1, 3, 1, '2019-04-10 00:00:00'),
(331, 'MAY69356101', 1, 3, 1, '2019-04-10 00:00:00'),
(332, 'MAY68728607', 1, 3, 1, '2019-04-10 00:00:00'),
(333, 'MAY68728611', 1, 3, 1, '2019-04-10 00:00:00'),
(334, 'MAY67839902', 1, 3, 1, '2019-04-10 00:00:00'),
(335, 'MAY68728609', 1, 3, 1, '2019-04-10 00:00:00'),
(336, 'MAY69381001', 1, 3, 1, '2019-04-10 00:00:00'),
(337, 'ACE BOX 24', 5, 3, 1, '2019-04-10 00:00:00'),
(338, 'MAY69349001', 1, 3, 1, '2019-04-10 00:00:00'),
(339, 'MAY69374303', 1, 3, 1, '2019-04-10 00:00:00'),
(340, 'MAY68728608', 1, 3, 1, '2019-04-10 00:00:00'),
(341, '76519', 12, 3, 1, '2019-04-10 00:00:00'),
(342, 'PK518264ML', 12, 3, 1, '2019-04-10 00:00:00'),
(343, 'SVS76-611750-0AT1AC', 35, 3, 1, '2019-04-10 00:00:00'),
(344, 'PK514031EN', 12, 3, 1, '2019-04-10 00:00:00'),
(345, 'CTN# 78754', 12, 3, 1, '2019-04-10 00:00:00'),
(346, 'MAY69320303', 1, 3, 1, '2019-04-10 00:00:00'),
(347, '100026(ALP 1A)', 33, 3, 1, '2019-04-10 00:00:00'),
(348, 'RASTAFRI -50', 10, 3, 1, '2019-04-10 00:00:00'),
(349, '76-599040-0AT2KC', 35, 3, 1, '2019-04-10 00:00:00'),
(350, 'SVS76-6068200AT2CC', 35, 3, 1, '2019-04-10 00:00:00'),
(351, 'PK518248ML', 12, 3, 1, '2019-04-10 00:00:00'),
(352, 'MAY68728605', 1, 3, 1, '2019-04-10 00:00:00'),
(353, 'MAY68728612', 1, 3, 1, '2019-04-10 00:00:00'),
(354, '100033(ALP2)', 33, 3, 1, '2019-04-10 00:00:00'),
(355, 'CTN160865', 12, 3, 1, '2019-04-10 00:00:00'),
(356, 'PK520078ML', 12, 3, 1, '2019-04-10 00:00:00'),
(357, 'CLP0011051I', 12, 3, 1, '2019-04-10 00:00:00'),
(358, 'PK517084ML', 12, 3, 1, '2019-04-10 00:00:00'),
(359, 'OHD-0163A', 26, 3, 1, '2019-04-10 00:00:00'),
(360, 'MAY69307901', 1, 3, 1, '2019-04-10 00:00:00'),
(361, 'MAY69353101', 1, 3, 1, '2019-04-10 00:00:00'),
(362, 'MAY67897101', 1, 3, 1, '2019-04-10 00:00:00'),
(363, 'MAY67897701', 2, 3, 1, '2019-04-10 00:00:00'),
(364, 'JVC43', 11, 3, 1, '2019-04-10 00:00:00'),
(366, 'MAY67434201', 1, 3, 1, '2019-04-10 00:00:00'),
(367, 'MAY67434201', 24, 3, 1, '2019-04-10 00:00:00'),
(368, 'OHD-0086Z', 28, 3, 1, '2019-04-10 00:00:00'),
(369, 'OHD-0086Z', 26, 3, 1, '2019-04-10 00:00:00'),
(370, 'MAY67897701', 1, 3, 1, '2019-04-10 00:00:00'),
(371, '200-SI32J-02G-JVC', 16, 3, 1, '2019-04-10 00:00:00'),
(372, '32-0004-0495-097', 7, 3, 1, '2019-04-10 00:00:00'),
(373, '32-0004-0495-097', 6, 3, 1, '2019-04-10 00:00:00'),
(374, '200-32CT-002G-ATV', 16, 3, 1, '2019-04-10 00:00:00'),
(375, 'JVC-24', 14, 3, 1, '2019-04-10 00:00:00'),
(376, 'JVC-24', 16, 3, 1, '2019-04-10 00:00:00'),
(378, 'MAY67713001', 3, 3, 1, '2019-04-10 00:00:00'),
(379, 'SEPARADOR', 32, 3, 1, '2019-04-10 00:00:00'),
(380, 'SEPARADOR', 10, 3, 1, '2019-04-10 00:00:00'),
(381, 'MAY67713001', 1, 3, 1, '2019-04-10 00:00:00'),
(382, '200-32CT-002G-ATV', 34, 3, 1, '2019-04-10 00:00:00'),
(383, '200-SI32J-02G-JVC', 34, 3, 1, '2019-04-10 00:00:00'),
(384, '7501020670370', 1, 3, 1, '2019-06-20 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parteposicionbodega`
--

DROP TABLE IF EXISTS `parteposicionbodega`;
CREATE TABLE IF NOT EXISTS `parteposicionbodega` (
  `idparteposicionbodega` int(11) NOT NULL AUTO_INCREMENT,
  `idpalletcajas` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `idposicion` int(11) NOT NULL,
  `ordensalida` tinyint(1) NOT NULL,
  `salida` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idparteposicionbodega`),
  KEY `iddetalleparte` (`idpalletcajas`),
  KEY `idposicion` (`idposicion`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `uri`, `description`) VALUES
(14, 'permiso/*', 'Permiso - Todos'),
(21, 'client/*', 'Cliente - Todos'),
(22, 'parte/*', 'Modulo Packing - Todos'),
(24, 'rol/*', 'Rol - Todos'),
(25, 'user/*', 'Usuario - Todos'),
(26, 'turno/*', 'Turno - Todos'),
(27, 'reporte/*', 'Modulo Reporte - Todos'),
(28, 'calidad/*', 'Modulo Calidad - Todos'),
(29, 'bodega/*', 'Modulo Almacen - Todos'),
(30, 'salida/*', 'Modulo Salida - Todos'),
(31, 'inventario/*', 'Modulo Inventario - Todos'),
(32, 'orden/*', 'Ordenes de Salidas - Todos'),
(33, 'parte/index', 'Modulo de Packing - Inicio'),
(34, 'parte/verEnviados', 'Modulo de Packing - Enviados'),
(35, 'parte/detalleenvio', 'Modulo de Packing - ver detalle'),
(36, 'parte/packing', 'Modulo de Packing - Agregar'),
(37, 'parte/addPart', 'Parte - Agregar numero de parte'),
(38, 'parte/updateParte', 'Parte - Modificar numero de parte'),
(39, 'calidad/index', 'Modulo Calidad - Inicio'),
(40, 'calidad/detalleenvio', 'Modulo Calidad - detalle envio'),
(41, 'calidad/enviarBodegaNew', 'Modulo Calidad - enviar a almacen'),
(42, 'calidad/rechazarAPackingNew', 'Modulo Calidad - rechazar a packing'),
(43, 'calidad/ponerEnHold', 'Modulo Calidad - mover a Hold'),
(44, 'bodega/index', 'Modulo Almacen - Inicio'),
(45, 'bodega/verDetalle', 'Modulo Almacen - detalle envio'),
(46, 'bodega/rechazarACalidad', 'Modulo Almacen - rechazar a calidad'),
(47, 'bodega/agregarAUbicacion', 'Modulo Almacen - asignar ubicacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_rol`
--

DROP TABLE IF EXISTS `permission_rol`;
CREATE TABLE IF NOT EXISTS `permission_rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) NOT NULL,
  `rol_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_id` (`permission_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permission_rol`
--

INSERT INTO `permission_rol` (`id`, `permission_id`, `rol_id`) VALUES
(40, 30, 5),
(41, 14, 1),
(42, 21, 1),
(43, 22, 1),
(44, 24, 1),
(45, 25, 1),
(46, 26, 1),
(47, 27, 1),
(48, 28, 1),
(49, 29, 1),
(50, 30, 1),
(51, 31, 1),
(52, 32, 1),
(58, 29, 4),
(59, 33, 4),
(60, 34, 4),
(61, 39, 4),
(62, 22, 3),
(63, 39, 3),
(64, 44, 3),
(65, 28, 2),
(66, 33, 2),
(67, 34, 2),
(68, 44, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicionbodega`
--

DROP TABLE IF EXISTS `posicionbodega`;
CREATE TABLE IF NOT EXISTS `posicionbodega` (
  `idposicion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreposicion` varchar(150) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idposicion`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posicionbodega`
--

INSERT INTO `posicionbodega` (`idposicion`, `nombreposicion`, `activo`) VALUES
(1, 'A1', 1),
(2, 'A2', 1),
(3, 'A3', 1),
(4, 'A4', 1),
(5, 'A5', 1),
(6, 'A6', 1),
(7, 'A7', 1),
(8, 'A8', 1),
(9, 'A9', 1),
(10, 'A10', 1),
(11, 'A11', 1),
(12, 'A12', 1),
(13, 'A13', 1),
(14, 'A14', 1),
(15, 'A15', 1),
(16, 'A18', 1),
(17, 'B1', 1),
(18, 'B2', 1),
(19, 'B3', 1),
(20, 'B4', 1),
(21, 'B5', 1),
(22, 'B6', 1),
(23, 'B7', 1),
(24, 'B8', 1),
(25, 'B9', 1),
(26, 'B10', 1),
(27, 'B11', 1),
(28, 'B12', 1),
(29, 'B13', 1),
(30, 'B14', 1),
(31, 'B15', 1),
(32, 'B16', 1),
(33, 'B17', 1),
(34, 'B18', 1),
(35, 'C1', 1),
(36, 'C2', 1),
(37, 'C3', 1),
(38, 'C4', 1),
(39, 'C5', 1),
(40, 'C6', 1),
(41, 'C7', 1),
(42, 'C8', 1),
(43, 'C9', 1),
(44, 'C10', 1),
(45, 'C11', 1),
(46, 'C12', 1),
(47, 'C13', 1),
(48, 'C14', 1),
(49, 'C15', 1),
(50, 'C16', 1),
(51, 'C17', 1),
(52, 'C18', 1),
(53, 'C19', 1),
(54, 'C20', 1),
(55, 'C21', 1),
(56, 'C22', 1),
(57, 'C23', 1),
(58, 'C24', 1),
(59, 'C25', 1),
(60, 'C26', 1),
(61, 'C27', 1),
(62, 'C28', 1),
(63, 'C29', 1),
(64, 'C30', 1),
(65, 'C31', 1),
(66, 'C32', 1),
(67, 'C33', 1),
(68, 'C34', 1),
(69, 'C35', 1),
(70, 'C36', 1),
(71, 'D1', 1),
(72, 'D2', 1),
(73, 'D3', 1),
(74, 'D4', 1),
(75, 'D5', 1),
(76, 'D6', 1),
(77, 'D7', 1),
(78, 'D8', 1),
(79, 'D9', 1),
(80, 'D10', 1),
(81, 'D11', 1),
(82, 'D12', 1),
(83, 'D13', 1),
(84, 'D14', 1),
(85, 'D15', 1),
(86, 'D16', 1),
(87, 'D17', 1),
(88, 'D18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

DROP TABLE IF EXISTS `proceso`;
CREATE TABLE IF NOT EXISTS `proceso` (
  `idproceso` int(11) NOT NULL AUTO_INCREMENT,
  `nombreproceso` varchar(200) NOT NULL,
  PRIMARY KEY (`idproceso`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`idproceso`, `nombreproceso`) VALUES
(1, 'PACKING'),
(2, 'CALIDAD'),
(3, 'BODEGA'),
(4, 'SALIDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rol` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Calidad'),
(3, 'Packing'),
(4, 'Bodega'),
(5, 'Salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

DROP TABLE IF EXISTS `salida`;
CREATE TABLE IF NOT EXISTS `salida` (
  `idsalida` int(11) NOT NULL AUTO_INCREMENT,
  `numerosalida` varchar(50) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `orden` tinyint(1) NOT NULL,
  `finalizado` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idsalida`),
  KEY `idcliente` (`idcliente`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`idsalida`, `numerosalida`, `idcliente`, `orden`, `finalizado`, `idusuario`, `fecharegistro`) VALUES
(2, 'LG-20190330-2', 1, 0, 1, 3, '2019-04-05 12:22:58'),
(3, 'LG-20190408-3', 1, 0, 0, 3, '2019-04-08 10:20:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `idestatus` int(11) NOT NULL AUTO_INCREMENT,
  `nombrestatus` varchar(200) NOT NULL,
  `idproceso` int(11) NOT NULL,
  PRIMARY KEY (`idestatus`),
  KEY `idproceso` (`idproceso`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`idestatus`, `nombrestatus`, `idproceso`) VALUES
(1, 'ENVIADO A CALIDAD', 1),
(2, 'TERMINADO', 1),
(3, 'RECHAZADO A PACKING', 1),
(4, 'ENVIADO A ALMACEN', 2),
(5, 'TERMINADO', 2),
(6, 'RECHAZADO A CALIDAD', 2),
(7, 'ENVIADO', 3),
(8, 'EN BODEGA', 3),
(9, 'RECHAZADO', 3),
(12, 'EN HOLD', 2),
(13, 'SCRAP', 2),
(14, 'EN ESPERA', 1),
(15, 'EN ESPERA', 2),
(16, 'EN ESPERA', 3),
(17, 'ELIMINADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcantidad`
--

DROP TABLE IF EXISTS `tblcantidad`;
CREATE TABLE IF NOT EXISTS `tblcantidad` (
  `idcantidad` int(11) NOT NULL AUTO_INCREMENT,
  `idrevision` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` int(11) NOT NULL,
  PRIMARY KEY (`idcantidad`),
  KEY `idusuario` (`idusuario`),
  KEY `idrevision` (`idrevision`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcantidad`
--

INSERT INTO `tblcantidad` (`idcantidad`, `idrevision`, `cantidad`, `idusuario`, `fecharegistro`) VALUES
(1, 1, 122, 3, 2019),
(2, 1, 80, 3, 2019),
(3, 3, 120, 3, 2019),
(4, 4, 12, 3, 2019);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmodelo`
--

DROP TABLE IF EXISTS `tblmodelo`;
CREATE TABLE IF NOT EXISTS `tblmodelo` (
  `idmodelo` int(11) NOT NULL AUTO_INCREMENT,
  `idparte` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idmodelo`),
  KEY `idparte` (`idparte`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblmodelo`
--

INSERT INTO `tblmodelo` (`idmodelo`, `idparte`, `descripcion`, `idusuario`, `fecharegistro`) VALUES
(1, 3, 'Modelo 13', 3, '2019-06-19 13:07:43'),
(2, 3, 'Modelo 2', 3, '2019-06-19 12:12:12'),
(3, 3, 'sdf', 3, '2019-06-19 12:13:06'),
(4, 3, 'asmm', 3, '2019-06-19 13:07:32'),
(5, 3, 'asas', 3, '2019-06-19 12:13:23'),
(6, 3, 'asd', 3, '2019-06-19 12:13:51'),
(7, 3, 'asdss', 3, '2019-06-19 12:13:57'),
(8, 3, 'asdssddd', 3, '2019-06-19 12:14:01'),
(9, 3, 'dsw', 3, '2019-06-19 12:14:26'),
(10, 3, 'we', 3, '2019-06-19 12:15:02'),
(11, 3, 'asdssddd2', 3, '2019-06-19 12:15:27'),
(12, 3, 'wewe', 3, '2019-06-19 12:16:28'),
(13, 3, 'w3', 3, '2019-06-19 12:17:12'),
(14, 3, 'qw', 3, '2019-06-19 12:17:42'),
(15, 3, 'er', 3, '2019-06-19 12:17:48'),
(16, 3, 'wcc', 3, '2019-06-19 12:18:21'),
(17, 3, 'sdff', 3, '2019-06-19 12:20:20'),
(18, 3, 'tg', 3, '2019-06-19 12:20:49'),
(19, 3, 'Modelo 2re', 3, '2019-06-19 12:21:06'),
(20, 3, 'Modelo 22', 3, '2019-06-19 12:21:49'),
(21, 3, 'Modelo 596', 3, '2019-06-19 12:22:33'),
(22, 3, 'Modelo 5', 3, '2019-06-19 12:23:12'),
(23, 7, 'Modelo 8', 3, '2019-06-19 15:29:00'),
(24, 4, 'as', 3, '2019-06-19 15:43:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrevision`
--

DROP TABLE IF EXISTS `tblrevision`;
CREATE TABLE IF NOT EXISTS `tblrevision` (
  `idrevision` int(11) NOT NULL AUTO_INCREMENT,
  `idmodelo` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idrevision`),
  KEY `idmodelo` (`idmodelo`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblrevision`
--

INSERT INTO `tblrevision` (`idrevision`, `idmodelo`, `descripcion`, `idusuario`, `fecharegistro`) VALUES
(1, 1, 'Revision 1', 3, '2019-06-19 00:00:00'),
(2, 1, 'asd', 3, '2019-06-19 13:31:37'),
(3, 23, '1.1', 3, '2019-06-19 15:29:12'),
(4, 24, 'as', 3, '2019-06-19 15:43:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltransferencia`
--

DROP TABLE IF EXISTS `tbltransferencia`;
CREATE TABLE IF NOT EXISTS `tbltransferencia` (
  `idtransferancia` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  PRIMARY KEY (`idtransferancia`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbltransferencia`
--

INSERT INTO `tbltransferencia` (`idtransferancia`, `folio`, `idusuario`, `fecharegistro`) VALUES
(1, 1, 3, '2019-06-19 00:00:00'),
(6, 3, 3, '2019-06-20 15:24:39'),
(8, 4, 3, '2019-06-20 15:40:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `nombreturno` varchar(200) NOT NULL,
  `horainicial` time NOT NULL,
  `horafinal` time NOT NULL,
  `siguientedia` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idturno`),
  KEY `idusuario` (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`idturno`, `nombreturno`, `horainicial`, `horafinal`, `siguientedia`, `activo`, `idusuario`, `fecha`) VALUES
(1, 'Matutino', '06:00:00', '16:59:59', 0, 1, 3, '2019-01-16 05:08:17'),
(2, 'Vespertino', '17:00:00', '05:59:59', 1, 1, 3, '2019-01-16 05:08:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idturno` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idturno` (`idturno`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `idturno`, `usuario`, `name`, `password`, `activo`, `fecha`) VALUES
(3, 1, 'pvelasco', 'PRUDENCIO VELASCO', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-08-18 00:00:00'),
(4, 1, 'calidad', 'Usuario Calidad', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-10-28 05:37:27'),
(5, 1, 'bodega', 'Usuario Bodega', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-01-08 06:23:24'),
(6, 1, 'packing', 'Usuario Packing', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-01-29 03:53:39'),
(7, 1, 'salida', 'Usuario salida', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-02-19 19:51:11'),
(8, 1, 'almacen', 'Usuario General Almacen', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-03-27 20:22:17'),
(9, 1, 'calidadroot', 'Usuario General de Calidad', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-03-29 20:30:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_rol`
--

DROP TABLE IF EXISTS `users_rol`;
CREATE TABLE IF NOT EXISTS `users_rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_rol` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_rol`
--

INSERT INTO `users_rol` (`id`, `id_rol`, `id_user`) VALUES
(1, 1, 3),
(2, 2, 4),
(3, 4, 5),
(4, 3, 6),
(5, 5, 7),
(6, 4, 8),
(7, 2, 9);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detalleparte`
--
ALTER TABLE `detalleparte`
  ADD CONSTRAINT `detalleparte_ibfk_1` FOREIGN KEY (`idestatus`) REFERENCES `status` (`idestatus`),
  ADD CONSTRAINT `detalleparte_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `detalleparte_ibfk_4` FOREIGN KEY (`idlinea`) REFERENCES `linea` (`idlinea`);

--
-- Filtros para la tabla `detallestatus`
--
ALTER TABLE `detallestatus`
  ADD CONSTRAINT `detallestatus_ibfk_1` FOREIGN KEY (`iddetalleparte`) REFERENCES `detalleparte` (`iddetalleparte`),
  ADD CONSTRAINT `detallestatus_ibfk_2` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idestatus`),
  ADD CONSTRAINT `detallestatus_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `motivorechazo`
--
ALTER TABLE `motivorechazo`
  ADD CONSTRAINT `motivorechazo_ibfk_1` FOREIGN KEY (`idproceso`) REFERENCES `proceso` (`idproceso`);

--
-- Filtros para la tabla `ordensalida`
--
ALTER TABLE `ordensalida`
  ADD CONSTRAINT `ordensalida_ibfk_1` FOREIGN KEY (`idpalletcajas`) REFERENCES `palletcajas` (`idpalletcajas`),
  ADD CONSTRAINT `ordensalida_ibfk_2` FOREIGN KEY (`idsalida`) REFERENCES `salida` (`idsalida`),
  ADD CONSTRAINT `ordensalida_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `palletcajas`
--
ALTER TABLE `palletcajas`
  ADD CONSTRAINT `palletcajas_ibfk_2` FOREIGN KEY (`idestatus`) REFERENCES `status` (`idestatus`),
  ADD CONSTRAINT `palletcajas_ibfk_4` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `palletcajas_ibfk_5` FOREIGN KEY (`idtransferancia`) REFERENCES `tbltransferencia` (`idtransferancia`),
  ADD CONSTRAINT `palletcajas_ibfk_6` FOREIGN KEY (`idcajas`) REFERENCES `tblcantidad` (`idcantidad`);

--
-- Filtros para la tabla `palletcajasestatus`
--
ALTER TABLE `palletcajasestatus`
  ADD CONSTRAINT `palletcajasestatus_ibfk_1` FOREIGN KEY (`idmotivorechazo`) REFERENCES `motivorechazo` (`idmotivorechazo`),
  ADD CONSTRAINT `palletcajasestatus_ibfk_2` FOREIGN KEY (`idpalletcajas`) REFERENCES `palletcajas` (`idpalletcajas`),
  ADD CONSTRAINT `palletcajasestatus_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `palletcajasproceso`
--
ALTER TABLE `palletcajasproceso`
  ADD CONSTRAINT `palletcajasproceso_ibfk_1` FOREIGN KEY (`idestatus`) REFERENCES `status` (`idestatus`),
  ADD CONSTRAINT `palletcajasproceso_ibfk_2` FOREIGN KEY (`idpalletcajas`) REFERENCES `palletcajas` (`idpalletcajas`),
  ADD CONSTRAINT `palletcajasproceso_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `parte`
--
ALTER TABLE `parte`
  ADD CONSTRAINT `parte_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `parte_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `parteposicionbodega`
--
ALTER TABLE `parteposicionbodega`
  ADD CONSTRAINT `parteposicionbodega_ibfk_2` FOREIGN KEY (`idposicion`) REFERENCES `posicionbodega` (`idposicion`),
  ADD CONSTRAINT `parteposicionbodega_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parteposicionbodega_ibfk_4` FOREIGN KEY (`idpalletcajas`) REFERENCES `palletcajas` (`idpalletcajas`);

--
-- Filtros para la tabla `permission_rol`
--
ALTER TABLE `permission_rol`
  ADD CONSTRAINT `permission_rol_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `permission_rol_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `salida_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);

--
-- Filtros para la tabla `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`idproceso`) REFERENCES `proceso` (`idproceso`);

--
-- Filtros para la tabla `tblmodelo`
--
ALTER TABLE `tblmodelo`
  ADD CONSTRAINT `tblmodelo_ibfk_1` FOREIGN KEY (`idparte`) REFERENCES `parte` (`idparte`),
  ADD CONSTRAINT `tblmodelo_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tblrevision`
--
ALTER TABLE `tblrevision`
  ADD CONSTRAINT `tblrevision_ibfk_1` FOREIGN KEY (`idmodelo`) REFERENCES `tblmodelo` (`idmodelo`),
  ADD CONSTRAINT `tblrevision_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tbltransferencia`
--
ALTER TABLE `tbltransferencia`
  ADD CONSTRAINT `tbltransferencia_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users_rol`
--
ALTER TABLE `users_rol`
  ADD CONSTRAINT `users_rol_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `users_rol_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
