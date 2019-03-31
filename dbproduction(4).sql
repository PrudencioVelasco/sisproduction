-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-03-2019 a las 04:21:38
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

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

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `rfc`, `nombre`, `abreviatura`, `direccion`, `activo`, `idusuario`, `fecha`) VALUES
(1, 'VEPP9004288D4', 'LG MXLI', 'LG', 'Calle Órbita 36, Parque Industrial Mexicali II, 21397, Pimsa II, Mexicali, B.C.', 1, 6, '2019-02-19 18:12:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleparte`
--

CREATE TABLE `detalleparte` (
  `iddetalleparte` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `idparte` int(11) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `revision` varchar(120) NOT NULL,
  `pallet` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleparte`
--

INSERT INTO `detalleparte` (`iddetalleparte`, `folio`, `idparte`, `modelo`, `revision`, `pallet`, `cantidad`, `idlinea`, `idestatus`, `idusuario`, `fecharegistro`) VALUES
(81, 81, 3, 'Mode 1', '1', 0, 0, 3, 1, 6, '2019-03-30 18:40:52'),
(82, 82, 5, 'Mode 94', '1', 0, 0, 1, 1, 6, '2019-03-30 18:45:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallestatus`
--

CREATE TABLE `detallestatus` (
  `iddetallestatus` int(11) NOT NULL,
  `iddetalleparte` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `comentariosrechazo` text NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `idlinea` int(11) NOT NULL,
  `nombrelinea` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `motivorechazo` (
  `idmotivorechazo` int(11) NOT NULL,
  `motivo` varchar(250) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `ordensalida` (
  `idordensalida` int(11) NOT NULL,
  `idsalida` int(11) NOT NULL,
  `idpalletcajas` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `pallet` int(11) NOT NULL,
  `caja` int(11) NOT NULL,
  `revision` varchar(20) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palletcajas`
--

CREATE TABLE `palletcajas` (
  `idpalletcajas` int(11) NOT NULL,
  `iddetalleparte` int(11) NOT NULL,
  `pallet` int(11) NOT NULL,
  `cajas` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palletcajas`
--

INSERT INTO `palletcajas` (`idpalletcajas`, `iddetalleparte`, `pallet`, `cajas`, `idestatus`, `idusuario`, `fecharegistro`) VALUES
(125, 81, 1, 100, 8, 4, '2019-03-30 18:41:32'),
(126, 81, 1, 100, 8, 4, '2019-03-30 18:41:32'),
(127, 81, 1, 100, 8, 4, '2019-03-30 18:41:32'),
(128, 81, 1, 100, 8, 4, '2019-03-30 18:41:32'),
(129, 82, 1, 100, 8, 4, '2019-03-30 18:43:50'),
(130, 82, 1, 100, 8, 4, '2019-03-30 18:43:50'),
(131, 82, 1, 200, 8, 4, '2019-03-30 18:46:08'),
(132, 82, 1, 200, 8, 4, '2019-03-30 18:46:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palletcajasestatus`
--

CREATE TABLE `palletcajasestatus` (
  `idpalletcajasestatus` int(11) NOT NULL,
  `idpalletcajas` int(11) NOT NULL,
  `idmotivorechazo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palletcajasestatus`
--

INSERT INTO `palletcajasestatus` (`idpalletcajasestatus`, `idpalletcajas`, `idmotivorechazo`, `idusuario`, `fecharegistro`) VALUES
(1, 131, 5, 4, '2019-03-30 18:44:01'),
(2, 132, 5, 4, '2019-03-30 18:44:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palletcajasproceso`
--

CREATE TABLE `palletcajasproceso` (
  `idpalletcajasproceso` int(11) NOT NULL,
  `idpalletcajas` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palletcajasproceso`
--

INSERT INTO `palletcajasproceso` (`idpalletcajasproceso`, `idpalletcajas`, `idestatus`, `idusuario`, `fecharegistro`) VALUES
(7, 125, 1, 6, '2019-03-30 18:40:52'),
(8, 126, 1, 6, '2019-03-30 18:40:52'),
(9, 127, 1, 6, '2019-03-30 18:40:52'),
(10, 128, 1, 6, '2019-03-30 18:40:52'),
(11, 125, 4, 4, '2019-03-30 18:41:32'),
(12, 126, 4, 4, '2019-03-30 18:41:32'),
(13, 127, 4, 4, '2019-03-30 18:41:32'),
(14, 128, 4, 4, '2019-03-30 18:41:32'),
(15, 125, 8, 5, '2019-03-30 18:42:02'),
(16, 126, 8, 5, '2019-03-30 18:42:02'),
(17, 127, 8, 5, '2019-03-30 18:42:02'),
(18, 128, 8, 5, '2019-03-30 18:42:02'),
(19, 129, 1, 6, '2019-03-30 18:43:07'),
(20, 130, 1, 6, '2019-03-30 18:43:07'),
(21, 131, 1, 6, '2019-03-30 18:43:07'),
(22, 132, 1, 6, '2019-03-30 18:43:07'),
(23, 129, 4, 4, '2019-03-30 18:43:50'),
(24, 130, 4, 4, '2019-03-30 18:43:50'),
(25, 131, 3, 4, '2019-03-30 18:44:01'),
(26, 132, 3, 4, '2019-03-30 18:44:01'),
(27, 129, 8, 5, '2019-03-30 18:45:08'),
(28, 130, 8, 5, '2019-03-30 18:45:08'),
(29, 131, 1, 6, '2019-03-30 18:45:43'),
(30, 132, 1, 6, '2019-03-30 18:45:43'),
(31, 131, 4, 4, '2019-03-30 18:46:08'),
(32, 132, 4, 4, '2019-03-30 18:46:08'),
(33, 131, 8, 5, '2019-03-30 18:46:35'),
(34, 132, 8, 5, '2019-03-30 18:46:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parte`
--

CREATE TABLE `parte` (
  `idparte` int(11) NOT NULL,
  `numeroparte` varchar(200) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parte`
--

INSERT INTO `parte` (`idparte`, `numeroparte`, `idcliente`, `idusuario`, `activo`, `fecharegistro`) VALUES
(3, 'EC-CD-8100', 1, 3, 1, '2019-01-24 08:10:44'),
(4, 'MOD-TEST-28', 1, 6, 1, '2019-02-19 20:08:06'),
(5, 'TEST-MOD-1', 1, 3, 1, '2019-02-20 08:04:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parteposicionbodega`
--

CREATE TABLE `parteposicionbodega` (
  `idparteposicionbodega` int(11) NOT NULL,
  `idpalletcajas` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `idposicion` int(11) NOT NULL,
  `ordensalida` tinyint(1) NOT NULL,
  `salida` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parteposicionbodega`
--

INSERT INTO `parteposicionbodega` (`idparteposicionbodega`, `idpalletcajas`, `numero`, `idposicion`, `ordensalida`, `salida`, `idusuario`, `fecharegistro`) VALUES
(32, 125, 1, 9, 0, 0, 5, '2019-03-30 18:42:02'),
(33, 126, 1, 9, 0, 0, 5, '2019-03-30 18:42:02'),
(34, 127, 1, 9, 0, 0, 5, '2019-03-30 18:42:02'),
(35, 128, 1, 9, 0, 0, 5, '2019-03-30 18:42:02'),
(36, 129, 1, 12, 0, 0, 5, '2019-03-30 18:45:08'),
(37, 130, 1, 12, 0, 0, 5, '2019-03-30 18:45:08'),
(38, 131, 1, 12, 0, 0, 5, '2019-03-30 18:46:35'),
(39, 132, 1, 12, 0, 0, 5, '2019-03-30 18:46:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `uri`, `description`) VALUES
(14, 'permiso/*', 'Permiso'),
(21, 'client/*', 'Cliente'),
(22, 'parte/*', 'Modulo Packing'),
(24, 'rol/*', 'Rol'),
(25, 'user/*', 'Usuario'),
(26, 'turno/*', 'Turnos'),
(27, 'reporte/*', 'Modulo Reporte'),
(28, 'calidad/*', 'Modulo Calidad'),
(29, 'bodega/*', 'Modulo Almacen'),
(30, 'salida/*', 'Modulo Salida'),
(31, 'inventario/*', 'Modulo inventario'),
(32, 'orden/*', 'Ordenes de salidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_rol`
--

CREATE TABLE `permission_rol` (
  `id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL,
  `rol_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permission_rol`
--

INSERT INTO `permission_rol` (`id`, `permission_id`, `rol_id`) VALUES
(37, 28, 2),
(38, 22, 3),
(39, 29, 4),
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
(52, 32, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicionbodega`
--

CREATE TABLE `posicionbodega` (
  `idposicion` int(11) NOT NULL,
  `nombreposicion` varchar(150) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `proceso` (
  `idproceso` int(11) NOT NULL,
  `nombreproceso` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`idproceso`, `nombreproceso`) VALUES
(1, 'PACKING'),
(2, 'CALIDAD'),
(3, 'BODEGA'),
(4, 'SALIDA'),
(5, 'GENERAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(10) NOT NULL,
  `rol` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `salida` (
  `idsalida` int(11) NOT NULL,
  `numerosalida` varchar(50) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `orden` tinyint(1) NOT NULL,
  `finalizado` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`idsalida`, `numerosalida`, `idcliente`, `orden`, `finalizado`, `idusuario`, `fecharegistro`) VALUES
(2, 'LG-20190330-2', 1, 0, 0, 3, '2019-03-30 18:47:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `idestatus` int(11) NOT NULL,
  `nombrestatus` varchar(200) NOT NULL,
  `idproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`idestatus`, `nombrestatus`, `idproceso`) VALUES
(1, 'ENVIADO', 1),
(2, 'TERMINADO', 1),
(3, 'RECHAZADO', 1),
(4, 'ENVIADO', 2),
(5, 'TERMINADO', 2),
(6, 'RECHAZADO', 2),
(7, 'ENVIADO', 3),
(8, 'EN BODEGA', 3),
(9, 'RECHAZADO', 3),
(10, 'SIN REVISAR', 5),
(11, 'EN REVISION', 5),
(12, 'EN HOLD', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL,
  `nombreturno` varchar(200) NOT NULL,
  `horainicial` time NOT NULL,
  `horafinal` time NOT NULL,
  `siguientedia` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `idturno` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `users_rol` (
  `id` int(10) NOT NULL,
  `id_rol` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `detalleparte`
--
ALTER TABLE `detalleparte`
  ADD PRIMARY KEY (`iddetalleparte`),
  ADD KEY `idestatus` (`idestatus`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idparte` (`idparte`),
  ADD KEY `idlinea` (`idlinea`);

--
-- Indices de la tabla `detallestatus`
--
ALTER TABLE `detallestatus`
  ADD PRIMARY KEY (`iddetallestatus`),
  ADD KEY `iddetalleparte` (`iddetalleparte`),
  ADD KEY `idstatus` (`idstatus`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`idlinea`);

--
-- Indices de la tabla `motivorechazo`
--
ALTER TABLE `motivorechazo`
  ADD PRIMARY KEY (`idmotivorechazo`),
  ADD KEY `idproceso` (`idproceso`);

--
-- Indices de la tabla `ordensalida`
--
ALTER TABLE `ordensalida`
  ADD PRIMARY KEY (`idordensalida`),
  ADD KEY `idsalida` (`idsalida`),
  ADD KEY `idparte` (`idpalletcajas`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `palletcajas`
--
ALTER TABLE `palletcajas`
  ADD PRIMARY KEY (`idpalletcajas`),
  ADD KEY `iddetalleparte` (`iddetalleparte`),
  ADD KEY `idestatus` (`idestatus`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `palletcajasestatus`
--
ALTER TABLE `palletcajasestatus`
  ADD KEY `idpalletcajasestatus` (`idpalletcajasestatus`),
  ADD KEY `idmotivorechazo` (`idmotivorechazo`),
  ADD KEY `idpalletcajas` (`idpalletcajas`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `palletcajasproceso`
--
ALTER TABLE `palletcajasproceso`
  ADD PRIMARY KEY (`idpalletcajasproceso`),
  ADD KEY `idestatus` (`idestatus`),
  ADD KEY `idpalletcajas` (`idpalletcajas`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `parte`
--
ALTER TABLE `parte`
  ADD PRIMARY KEY (`idparte`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `parteposicionbodega`
--
ALTER TABLE `parteposicionbodega`
  ADD PRIMARY KEY (`idparteposicionbodega`),
  ADD KEY `iddetalleparte` (`idpalletcajas`),
  ADD KEY `idposicion` (`idposicion`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permission_rol`
--
ALTER TABLE `permission_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `posicionbodega`
--
ALTER TABLE `posicionbodega`
  ADD PRIMARY KEY (`idposicion`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`idsalida`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idestatus`),
  ADD KEY `idproceso` (`idproceso`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`idturno`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idturno` (`idturno`);

--
-- Indices de la tabla `users_rol`
--
ALTER TABLE `users_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalleparte`
--
ALTER TABLE `detalleparte`
  MODIFY `iddetalleparte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `detallestatus`
--
ALTER TABLE `detallestatus`
  MODIFY `iddetallestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `motivorechazo`
--
ALTER TABLE `motivorechazo`
  MODIFY `idmotivorechazo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ordensalida`
--
ALTER TABLE `ordensalida`
  MODIFY `idordensalida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `palletcajas`
--
ALTER TABLE `palletcajas`
  MODIFY `idpalletcajas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `palletcajasestatus`
--
ALTER TABLE `palletcajasestatus`
  MODIFY `idpalletcajasestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `palletcajasproceso`
--
ALTER TABLE `palletcajasproceso`
  MODIFY `idpalletcajasproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `parte`
--
ALTER TABLE `parte`
  MODIFY `idparte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `parteposicionbodega`
--
ALTER TABLE `parteposicionbodega`
  MODIFY `idparteposicionbodega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `permission_rol`
--
ALTER TABLE `permission_rol`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `posicionbodega`
--
ALTER TABLE `posicionbodega`
  MODIFY `idposicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `idsalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `idestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `idturno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users_rol`
--
ALTER TABLE `users_rol`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `palletcajas_ibfk_1` FOREIGN KEY (`iddetalleparte`) REFERENCES `detalleparte` (`iddetalleparte`),
  ADD CONSTRAINT `palletcajas_ibfk_2` FOREIGN KEY (`idestatus`) REFERENCES `status` (`idestatus`),
  ADD CONSTRAINT `palletcajas_ibfk_4` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

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
-- Filtros para la tabla `users_rol`
--
ALTER TABLE `users_rol`
  ADD CONSTRAINT `users_rol_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `users_rol_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
