-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2015 a las 12:45:39
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_intranet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoinfo`
--

CREATE TABLE IF NOT EXISTS `estadoinfo` (
  `idEstado` int(255) NOT NULL,
  `nomEstado` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `estadoinfo`
--

INSERT INTO `estadoinfo` (`idEstado`, `nomEstado`) VALUES
(1, 'Disponible'),
(2, 'No disponible'),
(3, 'En reparacion'),
(4, 'Todos los estados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hours`
--

CREATE TABLE IF NOT EXISTS `hours` (
  `idFranja` int(255) NOT NULL,
  `franja` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hours`
--

INSERT INTO `hours` (`idFranja`, `franja`) VALUES
(1, '07:00 a 07:59'),
(2, '08:00 a 08:59'),
(3, '09:00 a 09:59'),
(4, '10:00 a 10:59'),
(5, '11:00 a 11:59'),
(6, '12:00 a 12:59'),
(7, '13:00 a 13:59'),
(8, '15:00 a 15:59'),
(9, '16:00 a 16:59'),
(10, '17:00 a 17:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registers`
--

CREATE TABLE IF NOT EXISTS `registers` (
  `idRegister` int(255) NOT NULL,
  `data_ini` date NOT NULL,
  `data_fin` date NOT NULL,
  `idResource` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idFranja` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `registers`
--

INSERT INTO `registers` (`idRegister`, `data_ini`, `data_fin`, `idResource`, `idUser`, `idFranja`) VALUES
(1, '2015-11-20', '2015-11-20', 1, 1, 1),
(2, '2015-11-20', '2015-11-20', 11, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `idResource` int(255) NOT NULL,
  `nomR` varchar(50) COLLATE utf8_bin NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idRType` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`idResource`, `nomR`, `idEstado`, `idRType`) VALUES
(1, 'Aula de teoria 1', 1, 4),
(2, 'Aula de teoria 2', 1, 4),
(3, 'Aula de teoria 3', 1, 4),
(4, 'Aula de teoria 4', 1, 4),
(5, 'Aula de informatica 1', 1, 11),
(6, 'Aula de informatica 2', 1, 11),
(7, 'Despacho entrevistas 1', 1, 5),
(8, 'Despacho entrevistas 2', 1, 5),
(9, 'Sala de reuniones 1', 1, 8),
(10, 'Proyector 1', 1, 9),
(11, 'Carro portatiles 1', 1, 1),
(12, 'Portatil 1', 1, 10),
(13, 'Portatil 2', 1, 10),
(14, 'Portatil 3', 1, 10),
(15, 'Movil 1', 1, 2),
(16, 'Movil 2', 1, 2),
(18, 'Todos los recursos', 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resourcestype`
--

CREATE TABLE IF NOT EXISTS `resourcestype` (
  `idRType` int(255) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `resourcestype`
--

INSERT INTO `resourcestype` (`idRType`, `tipo`) VALUES
(1, 'Accesorios'),
(2, 'Moviles'),
(4, 'Aulas de teoria'),
(5, 'Despachos entrevista'),
(8, 'Salas de reuniones'),
(9, 'Proyectores'),
(10, 'Portatiles'),
(11, 'Aulas de informatica'),
(12, 'Todos los tipos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(255) NOT NULL,
  `nomUser` varchar(50) COLLATE utf8_bin NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `telf` int(9) NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `privilegios` varchar(25) COLLATE utf8_bin NOT NULL,
  `estat` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUser`, `nomUser`, `mail`, `telf`, `password`, `privilegios`, `estat`) VALUES
(1, 'Carlos', 'carlos@intranet.es', 555555555, 'carsan', 'admin', 1),
(2, 'Oscar', 'oscar@intranet.es', 999887733, 'oscort', 'admin', 1),
(3, 'Jose', 'joseluis@intranet.es', 777332211, 'josmas', 'admin', 1),
(4, 'Enric', 'enric@intranet.es', 888775544, 'enrgor', 'member', 1),
(5, 'Alejandro', 'alejandro@intranet.es', 444553366, 'alemor', 'member', 1),
(6, 'David', 'david@intranet.es', 222222222, 'davmar', 'admin', 0),
(7, 'Agnes', 'agnes@intranet.es', 666666666, 'agnpla', 'member', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estadoinfo`
--
ALTER TABLE `estadoinfo`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`idFranja`),
  ADD KEY `idFranja` (`idFranja`),
  ADD KEY `idFranja_2` (`idFranja`),
  ADD KEY `idFranja_3` (`idFranja`),
  ADD KEY `franja` (`franja`);

--
-- Indices de la tabla `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`idRegister`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idResource` (`idResource`),
  ADD KEY `idRegister` (`idRegister`),
  ADD KEY `idFranja` (`idFranja`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`idResource`),
  ADD KEY `idResource` (`idResource`),
  ADD KEY `idRType` (`idRType`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `resourcestype`
--
ALTER TABLE `resourcestype`
  ADD PRIMARY KEY (`idRType`),
  ADD KEY `idRType` (`idRType`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idUser_2` (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estadoinfo`
--
ALTER TABLE `estadoinfo`
  MODIFY `idEstado` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `hours`
--
ALTER TABLE `hours`
  MODIFY `idFranja` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `registers`
--
ALTER TABLE `registers`
  MODIFY `idRegister` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `idResource` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `resourcestype`
--
ALTER TABLE `resourcestype`
  MODIFY `idRType` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `registers`
--
ALTER TABLE `registers`
  ADD CONSTRAINT `idResource` FOREIGN KEY (`idResource`) REFERENCES `resources` (`idResource`),
  ADD CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `registers_ibfk_1` FOREIGN KEY (`idFranja`) REFERENCES `hours` (`idFranja`);

--
-- Filtros para la tabla `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `idEstado` FOREIGN KEY (`idEstado`) REFERENCES `estadoinfo` (`idEstado`),
  ADD CONSTRAINT `idRType` FOREIGN KEY (`idRType`) REFERENCES `resourcestype` (`idRType`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
