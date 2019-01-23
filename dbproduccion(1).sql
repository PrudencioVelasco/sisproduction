-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-01-2019 a las 06:46:18
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
-- Base de datos: `dbproduccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CRETAE DATABASE dbproduccion;
USE dbproduccion;

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `activo`, `idusuario`, `fecha`) VALUES
(1, 'LG', 1, 3, '2018-10-25 04:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleparte`
--

CREATE TABLE `detalleparte` (
  `iddetalleparte` int(11) NOT NULL,
  `idparte` int(11) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `revision` varchar(120) NOT NULL,
  `pallet` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `linea` varchar(140) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idoperador` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleparte`
--

INSERT INTO `detalleparte` (`iddetalleparte`, `idparte`, `modelo`, `revision`, `pallet`, `cantidad`, `linea`, `idestatus`, `idoperador`, `idusuario`, `fecharegistro`) VALUES
(11, 1, '12', '12', 122, 2322, '12', 1, 4, 3, '2019-01-23 05:46:11'),
(12, 2, 'jh', '76', 67, 9877, '87', 1, 4, 3, '2019-01-23 06:23:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallestatus`
--

CREATE TABLE `detallestatus` (
  `iddetallestatus` int(11) NOT NULL,
  `iddetalleparte` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `comentariosrechazo` text NOT NULL,
  `idoperador` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallestatus`
--

INSERT INTO `detallestatus` (`iddetallestatus`, `iddetalleparte`, `idstatus`, `comentariosrechazo`, `idoperador`, `idusuario`, `fecharegistro`) VALUES
(3, 11, 1, '', 4, 3, '2019-01-23 05:46:11'),
(4, 12, 1, '', 4, 3, '2019-01-23 06:23:18');

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
(1, 'NOS', 1, 3, 1, '2018-10-25 00:00:00'),
(2, 'uhk', 1, 3, 1, '2019-01-23 06:22:44');

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
(22, 'article/*', 'Articulo'),
(24, 'rol/*', 'Rol'),
(25, 'user/*', 'Usuario'),
(26, 'turno/*', 'Turnos'),
(27, 'reporte/*', 'Reporte');

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
(14, 21, 2),
(15, 22, 2),
(17, 14, 1),
(18, 21, 1),
(19, 22, 1),
(20, 24, 1),
(21, 25, 1),
(22, 26, 1),
(23, 27, 1),
(24, 21, 3),
(25, 22, 3);

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
(4, 'SALIDA');

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
(3, 'Prueba');

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
(1, 'ENVIADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `idusuario`, `usuario`, `name`, `password`, `activo`, `fecha`) VALUES
(3, 207, 'pvelasco', 'PRUDENCIO VELASCO', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-08-18 00:00:00'),
(4, 0, 'normal', 'Usuario normal', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-10-28 05:37:27'),
(5, 0, 'John', 'Mayer', 'e10adc3949ba59abbe56e057f20f883e', 0, '2019-01-08 06:23:24');

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
(3, 2, 5);

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
  ADD KEY `idoperador` (`idoperador`);

--
-- Indices de la tabla `detallestatus`
--
ALTER TABLE `detallestatus`
  ADD PRIMARY KEY (`iddetallestatus`),
  ADD KEY `iddetalleparte` (`iddetalleparte`),
  ADD KEY `idstatus` (`idstatus`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idoperador` (`idoperador`);

--
-- Indices de la tabla `parte`
--
ALTER TABLE `parte`
  ADD PRIMARY KEY (`idparte`),
  ADD KEY `idcliente` (`idcliente`),
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
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idestatus`),
  ADD KEY `idproceso` (`idproceso`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `iddetalleparte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detallestatus`
--
ALTER TABLE `detallestatus`
  MODIFY `iddetallestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `parte`
--
ALTER TABLE `parte`
  MODIFY `idparte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `permission_rol`
--
ALTER TABLE `permission_rol`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `idestatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users_rol`
--
ALTER TABLE `users_rol`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `detalleparte_ibfk_3` FOREIGN KEY (`idoperador`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detallestatus`
--
ALTER TABLE `detallestatus`
  ADD CONSTRAINT `detallestatus_ibfk_1` FOREIGN KEY (`iddetalleparte`) REFERENCES `detalleparte` (`iddetalleparte`),
  ADD CONSTRAINT `detallestatus_ibfk_2` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idestatus`),
  ADD CONSTRAINT `detallestatus_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `detallestatus_ibfk_4` FOREIGN KEY (`idoperador`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `parte`
--
ALTER TABLE `parte`
  ADD CONSTRAINT `parte_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `parte_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `permission_rol`
--
ALTER TABLE `permission_rol`
  ADD CONSTRAINT `permission_rol_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `permission_rol_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

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
