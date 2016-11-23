-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2016 a las 17:01:28
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mhmproperties`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL COMMENT 'Email-mail',
  `password` varchar(255) DEFAULT NULL COMMENT 'Password-text',
  `id_rol` int(11) NOT NULL COMMENT 'Rol',
  `nombre` varchar(255) NOT NULL COMMENT 'Nombre-text'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `id_rol`, `nombre`) VALUES
(31, 'admin@efphp.com', '21232f297a57a5a743894a0e4a801fc3', 12, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amenitie`
--

CREATE TABLE IF NOT EXISTS `amenitie` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `amenitie`
--

INSERT INTO `amenitie` (`id`, `nombre`) VALUES
(1, 'Elevator'),
(2, '1 Room'),
(3, '2 Rooms');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `building`
--

CREATE TABLE IF NOT EXISTS `building` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `building`
--

INSERT INTO `building` (`id`, `nombre`, `address`, `video`) VALUES
(1, 'Building 1', 'example address', 'no video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL COMMENT 'Título-text',
  `tag` varchar(255) NOT NULL COMMENT 'Tag-text',
  `cms_contenido` text NOT NULL COMMENT 'Contenido CMS-text'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cms`
--

INSERT INTO `cms` (`id`, `nombre`, `tag`, `cms_contenido`) VALUES
(31, 'Home', 'home', '<div>Home, contenido de base de datos</div>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_building`
--

CREATE TABLE IF NOT EXISTS `gallery_building` (
`id` int(11) NOT NULL,
  `id_building` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_place`
--

CREATE TABLE IF NOT EXISTS `gallery_place` (
`id` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  `img_place` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `metodo` varchar(255) DEFAULT NULL,
  `data` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `id_admin`, `nombre`, `metodo`, `data`, `created_at`) VALUES
(50, 31, 'Administrador - amenitie', 'insertRow', 'a:1:{s:6:"nombre";s:8:"Elevator";}', '2016-11-23 09:52:11'),
(51, 31, 'Administrador - amenitie', 'insertRow', 'a:1:{s:6:"nombre";s:6:"1 Room";}', '2016-11-23 09:55:05'),
(52, 31, 'Administrador - amenitie', 'insertRow', 'a:1:{s:6:"nombre";s:7:"2 Rooms";}', '2016-11-23 09:55:11'),
(53, 31, 'Administrador - building', 'insertRow', 'a:3:{s:6:"nombre";s:10:"Building 1";s:7:"address";s:15:"example address";s:5:"video";s:8:"no video";}', '2016-11-23 10:00:16'),
(54, 31, 'Administrador - place', 'insertRow', 'a:3:{s:11:"id_building";s:1:"1";s:22:"id_serialized_amenitie";a:2:{i:0;s:1:"1";i:1;s:1:"2";}s:6:"nombre";s:11:"Room type 1";}', '2016-11-23 10:00:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `id_menu`, `nombre`, `url`, `posicion`) VALUES
(7, NULL, 'Main_Category', '#', 1),
(8, 7, 'Home', 'home', 1),
(9, 7, 'Documentación', 'documentacion', 1),
(10, 7, 'Descarga', 'descarga', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `place`
--

CREATE TABLE IF NOT EXISTS `place` (
`id` int(11) NOT NULL,
  `id_building` int(11) NOT NULL,
  `id_serialized_amenitie` varchar(500) DEFAULT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `place`
--

INSERT INTO `place` (`id`, `id_building`, `id_serialized_amenitie`, `nombre`) VALUES
(1, 1, 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(12, 'ADMINISTRADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_id_rol` (`id_rol`);

--
-- Indices de la tabla `amenitie`
--
ALTER TABLE `amenitie`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `building`
--
ALTER TABLE `building`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cms`
--
ALTER TABLE `cms`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gallery_building`
--
ALTER TABLE `gallery_building`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gallery_place`
--
ALTER TABLE `gallery_place`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`), ADD KEY `id_men` (`id_menu`);

--
-- Indices de la tabla `place`
--
ALTER TABLE `place`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `amenitie`
--
ALTER TABLE `amenitie`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `building`
--
ALTER TABLE `building`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cms`
--
ALTER TABLE `cms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `gallery_building`
--
ALTER TABLE `gallery_building`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gallery_place`
--
ALTER TABLE `gallery_place`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `place`
--
ALTER TABLE `place`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
