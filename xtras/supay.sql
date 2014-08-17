-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-08-2014 a las 01:41:52
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `supay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `creaction_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BB861B1F6B3CA4B` (`id_user`),
  KEY `IDX_BB861B1F166D1F9C` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collaborator_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `access` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E04992AA30098C8C` (`collaborator_id`),
  KEY `IDX_E04992AA166D1F9C` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `permission`
--

INSERT INTO `permission` (`id`, `collaborator_id`, `project_id`, `access`) VALUES
(1, 1, 1, ''),
(2, 1, 2, 'all'),
(3, 1, 3, 'all'),
(4, 1, 4, 'all'),
(5, 1, 5, 'all'),
(6, 1, 6, 'all');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `id_git` int(11) DEFAULT NULL,
  `access_type` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `path_file` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2FB3D0EEA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `project`
--

INSERT INTO `project` (`id`, `user_id`, `id_git`, `access_type`, `description`, `name`, `path_file`) VALUES
(1, 2, 12, 'qwsdad', 'asdasd', 'asdasd', 'adsasdasd'),
(2, 1, NULL, NULL, 'qwe', 'qwe', NULL),
(3, 1, NULL, NULL, 'weqe', '123', NULL),
(4, 1, NULL, NULL, 'weqe', '123', NULL),
(5, 1, NULL, NULL, 'weqe', '123', NULL),
(6, 1, NULL, NULL, 'weqw', 'asd', NULL),
(7, 1, NULL, NULL, 'weqw', 'asd', NULL),
(8, 1, NULL, NULL, 'qwe', 'qwe', NULL),
(9, 1, NULL, NULL, 'wer', 'wer', NULL),
(10, 1, NULL, NULL, 'sdf', 'sdf', NULL),
(11, 1, NULL, NULL, 'sdf', 'dsf', NULL),
(12, 1, NULL, NULL, 'asd', 'sdf', NULL),
(13, 1, NULL, NULL, 'qwe', 'qwe', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`) VALUES
(1, 'jose', 'jose', 'jose', 'pepe@gmail.com'),
(2, 'rolando', 'rolando', 'rolndo', 'rolo@gmail.com'),
(3, 'jona', 'jona', 'jona', 'jona@gmail.com'),
(4, 'rosa', 'rosa', 'rosa', 'rosa@gmail.com'),
(5, 'jose1', 'jose1', 'jose123', 'jose123@gmail.com');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `FK_BB861B1F166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_BB861B1F6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `FK_E04992AA166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_E04992AA30098C8C` FOREIGN KEY (`collaborator_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_2FB3D0EEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
